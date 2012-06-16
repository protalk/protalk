<?php

namespace Protalk\MediaBundle\Form\Media;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContributeMedia extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('email', 'email');
        $builder->add('hostUrl', 'url');
        $builder->add('hostName', 'text');
        $builder->add('title', 'text');
        $builder->add('slidesUrl', 'url', array('required' => false));
        $builder->add('speaker', 'text', array('required' => false));
        $builder->add('tags', 'text', array('required' => false));
        $builder->add('description','textarea', array('required' => false));
        $builder->add('category', 'entity', array('class' => 'ProtalkMediaBundle:Category',
                                                     'property' => 'name',
                                                     'empty_value' => 'Choose a category'
                                                    ));
        $builder->add('recaptcha', 'ewz_recaptcha', array(
        'attr' => array(
            'options' => array(
                'theme' => 'clean'
            )
        )
    ));
    }


    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Protalk\MediaBundle\Entity\Contribution',
        );
    }



    public function getName()
    {
        return 'contribution';
    }
}
