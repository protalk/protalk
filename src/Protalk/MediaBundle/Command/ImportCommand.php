<?php

namespace ProTalk\MediaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;

use Protalk\MediaBundle\Entity\Feed;
use Doctrine\ORM\EntityManager;

/**
 * Command for the console
 *
 * This imports the rss feeds which locations are stored in the database
 *
 * @author Lineke Kerckhoffs-Willems and Kim Rowan
 */
class ImportCommand extends ContainerAwareCommand
{
    /**
     * Set the configuration for the command syntax and description
     */
    protected function configure()
    {
        $this->setName('protalk:content:import')
             ->setDescription('Imports new content from the RSS feeds stored in the database.')
             ->setHelp(
                 <<<EOT
The <info>protalk:content:import</info> command uses RSS feeds stored in the database to
automatically gather and import new content.
EOT
             );
    }

    /**
     * Execution of command to import media items from Feeds
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Importing content, please wait...');

        $em = $this->getContainer()->get('doctrine')->getManager();
        $rss = $this->getContainer()->get('fkr_simple_pie.rss');

        $feeds = $this->getFeeds($em);

        foreach ($feeds as $feed) {
            $rss->set_feed_url($feed->getUrl());
            $rss->init();
            $rss->handle_content_type();

            if ($rss->error()) {
                $output->writeln($feed->getName() . ' had an error: '. $rss->error());
                continue;
            }
            $output->writeln('Processing: '.$feed->getName());
            $this->processFeedItems($rss->get_items(), $feed, $output);
            $output->writeln('...');
            $output->writeln('...moving on...');
            $output->writeln('...');
        }

        $output->writeln('Done importing. Sending confirmation email...');

        $this->sendImportConfirmationEmail();
        $output->writeln('Confirmation email sent');
    }

    /**
     * Process items within a feed
     *
     * @param $items
     * @param $feed
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function processFeedItems($items, $feed, OutputInterface $output)
    {
        foreach ($items as $item) {

            $contentImport = $this->getContainer()->get('protalk_media.'.$feed->getFeedType()->getClassName());
            $itemTitle = $item->get_title();

            $output->writeln("Checking $itemTitle...");
            if( ! $contentImport->handleImport($item, $feed)) {
                $output->writeln("Skipping $itemTitle...");
                continue;
            }

            $output->writeln("Imported $itemTitle...");
        }

        $this->setFeedImportDate($feed);
    }

    /**
     * Get the feeds from the database that have automatic import enabled
     *
     * @param \Doctrine\ORM\EntityManager $em
     *
     * @return array of objects
     */
    private function getFeeds($em)
    {
        $qb = $em->createQueryBuilder();
        $qb->select("f")
           ->from("ProtalkMediaBundle:Feed", "f")
           ->where("f.automaticImport = 1");

        return $qb->getQuery()->getResult();
    }

    /**
     * Set the date of current import in Feed entity
     *
     * @param \Protalk\MediaBundle\Entity\Feed $feed
     */
    private function setFeedImportDate(Feed $feed)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $feed->setLastImportedDate(new \DateTime('now'));

        $em->persist($feed);
        $em->flush();
    }

    /**
     * Send import confirmation email to info@protalk.me
     */
    private function sendImportConfirmationEmail()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Feed Import - Confirmation Email')
            ->setFrom('no-reply@protalk.me')
            ->setTo('info@protalk.me')
            ->setCharset('UTF-8')
            ->setContentType('text/html')
            ->setBody(
                $this->getContainer()
                    ->get('templating')
                    ->render('ProtalkMediaBundle:Import:confirmationEmail.html.twig')
            );

        $this->getContainer()->get('mailer')->send($message);

        return;
    }
}
