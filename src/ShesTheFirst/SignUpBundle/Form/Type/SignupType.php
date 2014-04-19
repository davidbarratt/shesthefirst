<?php

namespace ShesTheFirst\SignUpBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('first_name', 'text');
        
        $builder->add('last_name', 'text');
        
        $builder->add('email', 'email');
        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShesTheFirst\SignUpBundle\Form\Model\Signup'
        ));
    }

    public function getName()
    {
        return 'respond';
    }
}