<?php

namespace Serbinario\Bundle\SaudeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Serbinario\Bundle\SaudeBundle\Form\MedicoType;
use Serbinario\Bundle\SaudeBundle\Form\EspecialidadeType;
use Serbinario\Bundle\SaudeBundle\UTIL\GridClass;
use Serbinario\Bundle\SaudeBundle\Form\CalendarioType;

/**
 * @Route("/agenda")
 */
class AgendaController extends Controller {

    /**
     * @Route("/agendamento", name="agendamento")
     * @Template()
     */
    public function agendamentoAction() {
        
        $especializacoesRN = $this->get('especialidade_rn');
        $especializacoes   = $especializacoesRN->all();
        
        return array('especializacoes' => $especializacoes);
    }
    
    /**
     * @Route("/agendaMedico/id/{id}", name="agendaMedico")
     * @Template()
     */
    public function agendaMedicoAction(Request $request, $id)
    {
        #Criando o formulário
        $form = $this->createForm(new CalendarioType(), null, array("idMedico"=>""));

        #Recuperando o serviço do container
        //$calendarioRN = $this->get('_rn');

        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);

            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $calendario = $form->getData();
               
                #Executando e recuperando o resultado
                //$result = $calendarioRN->save($calendario);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }

                #Criando o formulário
                $form = $this->createForm(new CalendarioType());

                #Retorno
                return array("form" => $form->createView());
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }
        }

        #Retorno
        return array("form" => $form->createView());
    }
    
    /**
     * @Route("/gridAgendaMedico", name="gridAgendaMedico")
     * @Template()
     */
    public function gridAgendaMedicoAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.idMedico",
                "a.nomeMedico",
                "a.emailMedico",
                "b.nomeEspecialidade"
                );

            $entityJOIN           = array("especialidadeEspecialidade");             
            $radiosArray          = array();
            $parametros           = $request->request->all();            
            
            $entity               = "Serbinario\Bundle\SaudeBundle\Entity\Medico"; 
            $columnWhereMain      = "";
            $whereValueMain       = "";
            $whereFull            = "";
            
            $gridClass = new GridClass($this->getDoctrine()->getManager(), 
                    $parametros,
                    $columns,
                    $entity,
                    $entityJOIN,           
                    $columnWhereMain,
                    $whereValueMain,
                    $whereFull);

            $resultRadios   = $gridClass->builderQuery();    
            $countTotal     = $gridClass->getCount();
            $countRadios    = count($resultRadios);

            for($i=0;$i < $countRadios; $i++)
            {
                $radiosArray[$i]['DT_RowId']        = "row_".$resultRadios[$i]->getIdMedico();
                $radiosArray[$i]['id']              = $resultRadios[$i]->getIdMedico();
                $radiosArray[$i]['nome']            = $resultRadios[$i]->getNomeMedico();
                $radiosArray[$i]['email']           = $resultRadios[$i]->getEmailMedico();
                $radiosArray[$i]['especialidade']   = $resultRadios[$i]->getEspecialidadeEspecialidade()->getNomeEspecialidade();

            }

            //Se a variável $sqlFilter estiver vazio
            if(!$gridClass->isFilter()){
                $countRadios = $countTotal;
            }

            $columns = array(               
                'draw'              => $parametros['draw'],
                'recordsTotal'      => "{$countTotal}",
                'recordsFiltered'   => "{$countRadios}",
                'data'              => $radiosArray               
            );

            return new JsonResponse($columns);
        }else{            
            return array();            
        }
    }
}
