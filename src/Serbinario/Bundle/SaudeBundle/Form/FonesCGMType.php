<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FonesCGMType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('foneCGM', 'text', array(
                'label' => 'Telefone',           
                'attr' => array(
                    'placeholder' => 'Telefone',
                    "class"    => " telefoneCollection"
                )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Serbinario\Bundle\SaudeBundle\Entity\FonesCGM'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'escolabundle_fonescgm';
    }
}
