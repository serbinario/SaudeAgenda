<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CalendarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('qtdTotalCalendario', 'text', array(
                'label' => 'Quantidade Total: ',           
                'attr'  => array(
                    'placeholder' => 'Quantidade Total',
                    'widget_col'=> '4',
            )))
            ->add('qtdReservaCalendario', 'text', array(
                'label' => 'Quantidade Reserva: ',           
                'attr'  => array(
                    'placeholder' => 'Quantidade Reserva: ',
                    'widget_col'=> '4',
            )))
            ->add('diaCalendario', 'date', array(
                'widget' => 'single_text',
                'required'     => true,
                'read_only' => true,
                'format' => 'dd/MM/yyyy',
                'label' => 'Dia: ',                
                'attr' => array(                    
                    'placeholder' => 'Dia da marcação',
                    'widget_col'=> '3',                    
                )
            ))           
            ->add('horarioCalendario', 'time', array(                
                'required'   => true,                  
                'label' => 'Hora: ',                
                'attr' => array(                    
                    'widget_col'=> '2'                    
                )
            ))      
            ->add('localidadeLocalidade', 'entity', array(
                'label'        => 'Local da marcação: ',
                'required'     => true,
                'empty_value' => false,
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Localidade',
                'query_builder'=>   
                    function(EntityRepository $er ) use ( $options ) {
                        return $er->createQueryBuilder('a')
                                ->join("a.medico", "b")
                                ->where("b.idMedico = :id")
                                ->setParameter("id", $options['idMedico']);                          
                    },
                'attr' => array(
                     'widget_col'=> '4',
                    'class' => 'select2'
                    )
                ))
             ->add('statusCalendario', 'checkbox', array( 
                'label' => 'Ativo',
                'required' => false,
                'attr'    => array(
                    'inline' => true,
                    'align_with_widget'=> true 
                    )
                ))
//            ->add('actions', 'form_actions', [
//                'buttons' => [
//                    'save'   => ['type' => 'submit', 'options' => ['label' => 'Salvar']],
//                    'edit'   => ['type' => 'submit', 'options' => ['label' => 'Alterar']],
//                    'delete' => ['type' => 'submit', 'options' => ['label' => 'Excluir']],
//                    'block'  => ['type' => 'submit', 'options' => ['label' => 'Bloquear']],
//                    'cancel' => ['type' => 'reset', 'options'  => ['label' => 'Cancelar']]
//                ]
//            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Serbinario\Bundle\SaudeBundle\Entity\Calendario',
            'idMedico' => '',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'serbinario_bundle_saudebundle_calendario';
    }
}
