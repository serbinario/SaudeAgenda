<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Serbinario\Bundle\SaudeBundle\Form\MedicoTextToObject;

class QtdDefaultType extends AbstractType 
{
    
    /**
     * 
     * @param \Serbinario\Bundle\SaudeBundle\Form\ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('medico', 'entity', array(
//                    'label' => false,
//                    'required' => false,
//                    'empty_value' => "Selecione o Especialista:",
//                    'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Medico',
//                    'attr' => array(
//                        'widget_col' => '6',
//                    ))
//                )
                ->add('medico', 'text', array(
                    'label' => false,          
                    'attr' => array(
                        'widget_col' => '10',
                        'readonly' => true,
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
        
        $builder->get('medico')
            ->addModelTransformer(new MedicoTextToObject($this->manager));
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
