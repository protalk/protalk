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

/**
 * Command for the console
 * 
 * This imports the rss feeds which locations are stored in the database 
 * 
 * @author Lineke Kerckhoffs-Willems
 */
class ImportCommand extends ContainerAwareCommand 
{
    /**
     * Set the configuration for the command syntax and description 
     */
    protected function configure() 
    {
        $this->setName('protalk:content:import')
             ->setDescription('Imports new content from the RSS feeds stored in the database.');
    }
    
    /**
     * Execution of the console command
     * 
     * This function checks all source code from the src folder, ignores this bundle's
     * files, and generates documentation HTML with phpDocumentor2.
     * 
     * After a successful operation, it will install assets with app/console assets:install
     * 
     * @param InputInterface $input
     * @param OutputInterface $output 
     */
    protected function execute(InputInterface $input, OutputInterface $output) 
    {
        $output->writeln('Importing content, please wait...');
        
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $feeds = $this->getFeeds($em);
        
        $rss = $this->getContainer()->get('fkr_simple_pie.rss');
        
        foreach ($feeds as $feed) {
            $rss->set_feed_url($feed->getUrl());
            $rss->init();
            $rss->handle_content_type();
            
            foreach ($rss->get_items() as $item) {
                $contentImport = $this->getContainer()->get('protalk_media.'.$feed->getFeedType()->getClassName());
                $contentImport->handleImport($item, $feed, $em);
            }
        }
        
        $output->writeln('Done importing');
    }
    
    /**
     * Get the feeds form the database that have automatic import enabled
     * 
     * @param Doctrine\ORM\EntityManager $em
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
}
