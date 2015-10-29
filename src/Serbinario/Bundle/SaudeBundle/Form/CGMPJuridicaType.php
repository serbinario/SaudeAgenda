<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CGMPJuridicaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dataHoje =  new \DateTime("now");
        
        $builder
            ->add('dataCadastramento', 'datetime', array(
                'label' => false,
                'data'  => $dataHoje,                
                'attr'  => array(
                    'widget_col'=> '2',
                    'hidden' => true
                )
            ))
            ->add('CpfCnpj', 'text', array(
                'label' => 'CNPJ *',           
                'attr' => array(
                    'placeholder' => 'CNPJ',
                    'widget_col'=> '3',
                    "class"    => " mask_cnpj"
                )))
            ->add('nome', 'text', array(
                'label' => 'Nome *',           
                'attr' => array(
                    'placeholder' => 'Nome',
                    'widget_col'=> '8',
                )))
            ->add('nomeComplemento', 'text', array(
                'label' => 'Nome completo*',  
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Nome completo',
                    'widget_col'=> '8',
                )))
            ->add('nomeFantasia', 'text', array(
                'label' => 'Nome fantasia*',  
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Nome fantasia',
                    'widget_col'=> '8',
                )))
            ->add('tipoEmpresa', 'entity', array(
                'label'        => 'Tipo empresa *',
                'required'     => false,
                'empty_value' => "Selecione o tipo",
                'class' => 'Softage\Bundles\EscolaBundle\Entity\TipoEmpresa',
                'attr' => array(
                     'widget_col'=> '5',
                    )
                ))
            ->add('inscricaoEstadual', 'text', array(
                'label' => 'Inscrição Estadual',
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Inscrição Estadual',
                    'widget_col'=> '4',
                )))
            ->add('nire', 'text', array(
                'label' => 'Nire',
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Nire',
                    'widget_col'=> '4',
                )))
            ->add('telefones', 'bootstrap_collection', array(
                'label'              => "Telefones",
                'required'     => false,
                'type'               => new FonesCGMType() ,
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'Adicionar',
                'delete_button_text' => 'Remover',
                'sub_widget_col'     => 5,
                'button_col'         => 3           
                ))
            ->add('email', 'text', array(
                'label' => 'E-mail', 
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'E-mail',
                    'widget_col'=> '8',
                )))
            ->add('CGMMunicipio', 'entity', array(
                'label'        => 'CGM do município *',
                'required'     => false,
                'empty_value' => "Selecione",
                'class' => 'Softage\Bundles\EscolaBundle\Entity\CGMMunicipio',
                'attr' => array(
                     'widget_col'=> '4',
                    )
                ))
            ->add('foto', new FotoCGMType, array(   
                'label'        => "Foto",
                'required'     => false,
                ))
            ->add('endereco', new EnderecoCGMType())
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'save' => ['type' => 'submit', 'options' => ['label' => 'Salvar']],
                    'cancel' => ['type' => 'button', 'options' => ['label' => 'Listar']],
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
            'data_class' => 'Serbinario\Bundle\SaudeBundle\Entity\CGM',
            'csrf_protection'  =>  true , 
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'task_item',
            'cascade_validation' => true,
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'escolabundle_cgm';
    }
}