<?php

/*
 * This overrides the equivalent class in the Sonata package.
 */

namespace Protalk\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\UserBundle\Model\UserInterface;

class ProfileType extends AbstractType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->add('website', 'url', array('required' => false))
            ->add('biography', 'textarea', array('required' => false))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sonata_user_profile';
    }
}
