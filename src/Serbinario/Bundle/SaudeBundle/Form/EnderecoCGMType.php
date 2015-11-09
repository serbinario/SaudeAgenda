<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnderecoCGMType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logradouro', 'text', array(
                'label' => 'Logradouro *',   
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Logradouro',
                    'widget_col'=> '8',
                )))
            ->add('numero', 'text', array(
                'label' => 'Número *',
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Número',
                    'widget_col'=> '4',
                    "class"    => " mask_numero"
                )))
            ->add('comp', 'text', array(
                'label' => 'Complemento',
                'required'     => false,
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Complemento',
                    'widget_col'=> '4',
                )))
            ->add('cep', 'text', array(
                'label' => 'CEP *',
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'CEP',
                    'widget_col'=> '4',
                    "class"    => " mask_cep"
                )))
            ->add('bairro', 'entity', array(
                'label'        => 'Bairro *',
                'required'     => false,
                'empty_value' => "Selecione o bairro",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Bairro',
                'attr' => array(
                     'widget_col'=> '3',
                    'class' => 'select2'
                    )
                ))
            ->add('cidade', 'entity', array(
                'label'        => 'Cidade *',
                'required'     => false,
                'empty_value' => "Selecione a cidade",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Cidade',
                'attr' => array(
                     'widget_col'=> '3',
                    'class' => 'select2'
                    )
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Serbinario\Bundle\SaudeBundle\Entity\EnderecoCGM'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'escolabundle_enderecocgm';
    }
}
