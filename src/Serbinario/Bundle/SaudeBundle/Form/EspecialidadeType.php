<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Serbinario\Bundle\SaudeBundle\Form\CBOTextToObject;

class EspecialidadeType extends AbstractType
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
//            ->add('cbo', 'entity', array(
//                'label'        => 'CBO: ',
//                'required'     => false,
//                'empty_value' => "Selecione o CBO",
//                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\CBO',
//                'attr' => array(
//                     'widget_col'=> '3',
//                    'class' => 'select2'
//                    )
//                ))
            ->add('cbo', 'text', array(
                'attr'  => array(
                    'placeholder' => 'Selecione um código brasileiro de operações',
                    'widget_col'=> '6',
                    'readonly' => true,
                )
            ))
            ->add('descricaoEspecialidade', 'text', array(
                'label' => 'Descrição: ',           
                'attr'  => array(
                    'placeholder' => 'Descrição da especialidade',
                    'widget_col'=> '6',
                    
            )))
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'save' => ['type' => 'submit', 'options' => ['label' => 'Salvar']],
                    'voltar' => ['type' => 'button', 'options' => ['label' => 'Voltar']],
                ]
            ])
        ;
        
        $builder->get('cbo')
            ->addModelTransformer(new CBOTextToObject($this->manager));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Serbinario\Bundle\SaudeBundle\Entity\Especialidade'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'saudebundle_especialidade';
    }
}
