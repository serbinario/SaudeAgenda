<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AgendamentoType extends AbstractType
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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('pacientePaciente', 'entity', array(
//                'label'        => 'Paciente *',
//                'required'     => false,
//                'empty_value' => "Selecione o Paciente",
//                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Cgm',
//                'attr' => array(
//                    'widget_col'=> '6',
//                    'class' => 'select2'
//                    )
//                ))
            ->add('pacientePaciente', 'text', array(
                'label'        => 'Paciente *',
                'attr'  => array(
                    'placeholder' => 'Selecione um Paciênte',
                    'widget_col'=> '6',
                    'readonly' => true,
                )
            ))
            ->add('observacaoAgendamento', 'textarea', array(
                'label' => 'Observação *', 
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Observação',
                    'widget_col'=> '6',
                    'class' => 'mask_letras',
                    'onkeyup' => 'mascara( this, alphanum )'
                )))
            ->add('statusAgendamento', 'checkbox', array( 
                'label' => 'Ativo',
                'required' => false,
                'attr'    => array(
                    'inline' => true,
                    'align_with_widget'=> true 
                    )
                )) 
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'save' => ['type' => 'submit', 'options' => ['label' => 'Salvar']],                    
                ]
            ])
                   
        ;
        
        $builder->get('pacientePaciente')
            ->addModelTransformer(new CgmTextToObject($this->manager));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Serbinario\Bundle\SaudeBundle\Entity\Agendamento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'serbinario_bundle_saudebundle_agendamento';
    }
}
