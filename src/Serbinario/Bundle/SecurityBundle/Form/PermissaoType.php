<?php

namespace Serbinario\Bundle\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PermissaoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomePermissao', 'text', array(
                'label' => 'Nome da Permissão: ',                
                'attr'  => array(
                    'placeholder' => 'Nome da Permissão',
                    'widget_col'=> '4',
            )))
            ->add('aplicacao', 'entity', array(
                'label'        => 'Projeto: ',
                'required'     => true,
                'empty_value' => false,
                'class' => 'Serbinario\Bundle\SecurityBundle\Entity\Aplicacao',
                'attr' => array(
                     'widget_col'=> '4',
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
            'data_class' => 'Serbinario\Bundle\SecurityBundle\Entity\Permissao'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'serbinario_securitybundle_permissao';
    }
}
