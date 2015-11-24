<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Serbinario\Bundle\SaudeBundle\Form\QtdDefaultType;
use Doctrine\Common\Persistence\ObjectManager;

class PsfType extends AbstractType
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
            ->add('nomePsf', 'text', array(
                'label' => 'Nome ',           
                'attr'  => array(
                    'placeholder' => 'Nome',
                    'widget_col'=> '6',
            )))
            ->add('qtdDefaults', 'bootstrap_collection', array(
                'label'              => "Especialistas: ",
                'required'           => false,
                'type'               => new QtdDefaultType($this->manager) ,
                //'allow_add'          => true,
                //'allow_delete'       => true,
                //'add_button_text'    => 'Adicionar',
                //'delete_button_text' => 'Remover',
                'sub_widget_col'     => 6,
                'button_col'         => 6           
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
            'data_class' => 'Serbinario\Bundle\SaudeBundle\Entity\Psf'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'saudebundle_psf';
    }
}
