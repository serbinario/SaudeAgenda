<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QtdDefaultType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('medico', 'entity', array(
                    'label' => false,
                    'required' => false,
                    'empty_value' => "Selecione o Especialista:",
                    'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Medico',
                    'attr' => array(
                        'widget_col' => '6',
                    ))
                )
                ->add('qtdDefault', 'text', array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Quantidade',
                        'widget_col' => '4',
                        "class" => " mask_numero"
                    ))
                )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Serbinario\Bundle\SaudeBundle\Entity\QtdDefault'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'serbinario_bundle_saudebundle_qtddefault';
    }

}
