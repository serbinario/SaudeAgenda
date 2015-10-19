<?php

namespace Serbinario\Bundle\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Serbinario\Bundle\SecurityBundle\UTIL\GridClass;
use Serbinario\Bundle\SecurityBundle\Form\AplicacaoType;

class AplicacaoController extends Controller
{
    /**
     * @Route("saveAplicacao", name="saveAplicacao")
     * @Template()
     */
    public function saveAction(Request $request)
    {
        #Criando o formulário
        $form = $this->createForm(new AplicacaoType());

        #Recuperando o serviço do container
        $aplicacaoRN = $this->get('rn_aplicacao');
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição            
            $form->handleRequest($request);           

            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $aplicacao = $form->getData();
                            
                #Executando e recuperando o resultado
                $result = $aplicacaoRN->save($aplicacao);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }

                #Retorno
                return $this->redirectToRoute("gridAplicacao");
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }
        }        
        
        #Retorno
        return array(
            "form" => $form->createView()           
        );
    }

    /**
     * @Route("updateAplicacao/{id}", name="updateAplicacao")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        #Recuperando o serviço do container        
        $aplicacaoRN = $this->get('rn_aplicacao'); 
        
        #recuperando o aplicacao 
        $aplicacao = $aplicacaoRN->find($id);
               
        #Criando o formulário
        $form = $this->createForm(new AplicacaoType(), $aplicacao);
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);

            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $aplicacao = $form->getData();            
               
                #Executando e recuperando o resultado
                $result = $aplicacaoRN->update($aplicacao);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }
                
                #Retorno
                return $this->redirectToRoute("gridAplicacao");
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }
        }    

        #Retorno
        return array(
            "form" => $form->createView()           
        );        
    }

    /**
     * @Route("gridAplicacao", name="gridAplicacao")
     * @Template()
     */
    public function gridAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.nomeAplicacao");

            $entityJOIN           = array();             
            $aplicacoesArray      = array();
            $parametros           = $request->request->all();            
            
            $entity               = "Serbinario\Bundle\SecurityBundle\Entity\Aplicacao"; 
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

            $resultAplicacoes = $gridClass->builderQuery();
            $countTotal       = $gridClass->getCount();
            $countAplicacoes  = count($resultAplicacoes);

            for($i=0;$i < $countAplicacoes; $i++)
            {
                $aplicacoesArray[$i]['DT_RowId'] = "row_".$resultAplicacoes[$i]->getId();
                $aplicacoesArray[$i]['id']       = $resultAplicacoes[$i]->getId();
                $aplicacoesArray[$i]['nome']     = $resultAplicacoes[$i]->getNomeAplicacao();                
            }

            //Se a variável $sqlFilter estiver vazio
            if(!$gridClass->isFilter()){
                $countAplicacoes = $countTotal;
            }

            $columns = array(               
                'draw'              => $parametros['draw'],
                'recordsTotal'      => "{$countTotal}",
                'recordsFiltered'   => "{$countAplicacoes}",
                'data'              => $aplicacoesArray               
            );

            return new JsonResponse($columns);
        }else{            
            return array();            
        }
    }

}
