<?php

namespace Serbinario\Bundle\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Serbinario\Bundle\SecurityBundle\Form\FotoUserType;

class UserType extends AbstractType
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
                    )
            ))
            ->add('username', 'text', array(
                'label' => 'Login: ',                
                'attr'  => array(
                    'placeholder' => 'Login',
                    'widget_col'=> '4',
            )))
            ->add('password', 'text', array(
                'label' => 'Senha: ',
                'required'     => false,                
                'attr'  => array(
                    'placeholder' => 'Senha',
                    'widget_col'=> '4',
            )))
            ->add('email', 'text', array(
                'label' => 'Email: ',                
                'attr'  => array(
                    'placeholder' => 'Email',
                    'widget_col'=> '4',
            )))
            ->add('foto', new FotoUserType(), array(   
                'label'        => "Foto",
                'required'     => false,
            ))
            ->add('psfPsf', 'entity', array(
                'label'        => 'Psf: ',
                'required'     => false,
                'empty_value' => "Selecione uma PSF:",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Psf',
                'attr' => array(
                     'widget_col'=> '4',
                    )
            ))
            ->add('isActive', 'checkbox', array( 
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
            'data_class' => 'Serbinario\Bundle\SecurityBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'serbinario_securitybundle_user';
    }
}
