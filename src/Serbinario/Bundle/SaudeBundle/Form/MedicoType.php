<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MedicoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cgm', 'entity', array(
                'label'        => 'CGM: ',
                'required'     => false,
                'empty_value' => "Cadastro Geral Municipal:",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\CGM',
                'attr' => array(
                     'widget_col'=> '4',
                    'class' => 'select2'
                    )
            ))            
            ->add('emailMedico', 'text', array(
                'label' => 'E-mail ', 
                'required'     => false,
                'attr'  => array(
                    'placeholder' => 'E-mail',
                    'widget_col'=> '8',
            )))
            ->add('especialidadeEspecialidade', 'entity', array(
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Especialidade',
                'label' => 'Especialidade ',  
                'multiple' => false,
                'expanded' => false,
                'attr' => array(
                    'widget_col'=> '3',
                    'inline' => true,
                    'class' => 'select2'
                    )
            ))
            ->add('localidade','entity', array(
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Localidade',
                'label' => 'Localidades',  
                'required'     => false,
                'multiple' => true,
                'expanded' => true,
                'attr' => array(
                    'widget_col'=> '3',
                    'class' => 'i-checks'
                    )
                ))
            ->add('quantidadeVagas', 'text', array(
                'label' => 'Quantidade de Vagas ', 
                'required'     => false,
                'attr'  => array(
                    'placeholder' => 'Quantidade de Vagas',
                    'widget_col'=> '2',
            )))
            ->add('horarioInicio', 'time', array(
                'label' => 'Horário Incicial ',  
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Horário Incicial',
                    'widget_col'=> '2',
                    'data-provide' => 'typeahead',
                    'class' => 'select2'
                ))) 
            ->add('horarioFim', 'time', array(
                'label' => 'Horário Final ',
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Horário Final',
                    'widget_col'=> '2',
                    'inline' => true,
                    'class' => 'select2'
                )))
            ->add('foto', new FotoMedicoType(), array(   
                'label'        => "Foto",
                'required'     => false,
                ))
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'save' => ['type' => 'submit', 'options' => ['label' => 'Salvar']],
                    'voltar' => ['type' => 'button', 'options' => ['label' => 'Voltar']],
                ]
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Serbinario\Bundle\SaudeBundle\Entity\Medico'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'saudebundle_medico';
    }
}
