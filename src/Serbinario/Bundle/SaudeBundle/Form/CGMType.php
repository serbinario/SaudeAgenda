<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CGMType extends AbstractType
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
                'label' => 'CPF *',           
                'attr' => array(
                    'placeholder' => 'CPF',
                    'widget_col'=> '2',
                    "class"    => " mask_cpf"
                )))
            ->add('rg', 'text', array(
                'label' => 'RG *',           
                'attr' => array(
                    'placeholder' => 'RG',
                    'widget_col'=> '2',
                    "class"    => " mask_numero"
                )))
            ->add('orgaoEmissor', 'text', array(
                'label' => 'Orgão Emissor *',           
                'attr' => array(
                    'placeholder' => 'Orgão Emissor',
                    'widget_col'=> '2',
                )))
            ->add('dataExpedicao', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'label' => 'Data de expedição *',                
                'attr' => array(
                    'placeholder' => 'Data de expedição',
                    'widget_col'=> '3',
                    'class' => 'datenottime'
                )
            ))
            ->add('nome', 'text', array(
                'label' => 'Nome *',           
                'attr' => array(
                    'placeholder' => 'Nome',
                    'widget_col'=> '8',
                )))
            ->add('pai', 'text', array(
                'label' => 'Pai',  
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'pai',
                    'widget_col'=> '8',
                )))
            ->add('mae', 'text', array(
                'label' => 'Mãe',  
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Mãe',
                    'widget_col'=> '8',
                )))
            ->add('naturalidade', 'text', array(
                'label' => 'Naturalidade',
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Naturalidade',
                    'widget_col'=> '4',
                )))
            ->add('inscricaoEstadual', 'text', array(
                'label' => 'Inscrição Estadual',
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Inscrição Estadual',
                    'widget_col'=> '4',
                    'help_text'    => 'Número de inscrição estadual'
                )))
            ->add('dataNascimento', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'label' => 'Data de nascimento *',                
                'attr' => array(
                    'placeholder' => 'Data de nascimento',
                    'widget_col'=> '3',
                    'class' => 'datenottime'
                )
            ))
            ->add('dataFalecimento', 'date', array(
                'widget' => 'single_text',
                'required'     => false,
                'format' => 'dd/MM/yyyy',
                'label' => 'Data de falecimento',                
                'attr' => array(
                    'placeholder' => 'Data de falecimento',
                    'widget_col'=> '3',
                    'class' => 'datenottime hint',
                    'data-toggle'  => 'tooltip',
                    'data-placement' => 'top',
                    'title'          => 'Este campo deve ser preenchido caso a pessoa venha a falecer'
                )
            ))
            ->add('email', 'text', array(
                'label' => 'E-mail', 
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'E-mail',
                    'widget_col'=> '8',
                )))
            ->add('numCNH', 'text', array(
                'label' => 'Número CNH',
                'required'     => false,
                'attr' => array(
                    'placeholder' => 'Número CNH',
                    'widget_col'=> '3',
                )))
            ->add('vencimentoCNH', 'date', array(
                'widget' => 'single_text',
                'required'     => false,
                'format' => 'dd/MM/yyyy',
                'label' => 'Data de vencimento CNH',                
                'attr' => array(
                    'placeholder' => 'Data de vencimento CNH',
                    'widget_col'=> '3',
                    'class' => 'datenottime'
                )
            ))
            ->add('ctgCNH', 'entity', array(
                'label'        => 'Categoria CNH',
                'required'     => false,
                'empty_value' => "Selecione a categoria",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\CategoriaCNH',
                'attr' => array(
                     'widget_col'=> '3',
                    'class' => 'select2'
                    )
                ))
            ->add('estadoCivil', 'entity', array(
                'label'        => 'Estado Civil *',
                'required'     => false,
                'empty_value' => "Selecione o estado civil",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\EstadoCivil',
                'attr' => array(
                     'widget_col'=> '4',
                    'class' => 'select2'
                    )
                ))
            ->add('sexoSexo', 'entity', array(
                'label'        => 'Sexo *',
                'required'     => false,
                'empty_value' => "Selecione o sexo",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Sexo',
                'attr' => array(
                     'widget_col'=> '4',
                    'class' => 'select2'
                    )
                ))
            ->add('nacionalidade', 'entity', array(
                'label'        => 'Nacionalidade *',
                'required'     => false,
                'empty_value' => "Selecione a nacionalidade",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Nacionalidade',
                'attr' => array(
                     'widget_col'=> '4',
                    'class' => 'select2'
                    )
                ))
            ->add('CGMMunicipio', 'entity', array(
                'label'        => 'CGM do município *',
                'required'     => false,
                'empty_value' => "Selecione",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\CGMMunicipio',
                'attr' => array(
                     'widget_col'=> '4',
                     'help_text'    => 'Se é uma pessoa que reside no município ou não',
                    'class' => 'select2'
                    )
                ))
            ->add('escolaridade', 'entity', array(
                'label'        => 'Escolaridade *',
                'required'     => false,
                'empty_value' => "Selecione",
                'class' => 'Serbinario\Bundle\SaudeBundle\Entity\Escolaridade',
                'attr' => array(
                     'widget_col'=> '4',
                    'class' => 'select2'
                    )
                ))
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
            ->add('foto', new FotoCGMType, array(   
                'label'        => "Foto",
                'required'     => false,
                ))
            ->add('endereco', new EnderecoCGMType())
            ->add('actions', 'form_actions', [
                'buttons' => [
                    'save' => ['type' => 'submit', 'options' => ['label' => 'Salvar']],
                    'cancel' => [ 'type' => 'button', 'options' => ['label' => 'Voltar']],
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
