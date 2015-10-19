<?php

namespace Serbinario\Bundle\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Serbinario\Bundle\SecurityBundle\UTIL\GridClass;
use Serbinario\Bundle\SecurityBundle\Form\PermissaoType;

class PermissaoController extends Controller
{
    /**
     * @Route("savePermissao", name="savePermissao")
     * @Template()
     */
    public function saveAction(Request $request)
    {
        #Criando o formulário
        $form = $this->createForm(new PermissaoType());

        #Recuperando o serviço do container
        $permissaoRN = $this->get('rn_permissao');
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição            
            $form->handleRequest($request);           

            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $permissao = $form->getData();
                            
                #Executando e recuperando o resultado
                $result = $permissaoRN->save($permissao);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }

                #Retorno
                return $this->redirectToRoute("gridPermissao");
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
     * @Route("updatePermissao/{id}", name="updatePermissao")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        #Recuperando o serviço do container        
        $permissaoRN = $this->get('rn_permissao'); 
        
        #recuperando o permissao 
        $permissao = $permissaoRN->find($id);
               
        #Criando o formulário
        $form = $this->createForm(new PermissaoType(), $permissao);
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);

            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $permissao = $form->getData();            
               
                #Executando e recuperando o resultado
                $result = $permissaoRN->update($permissao);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }
                
                #Retorno
                return $this->redirectToRoute("gridPermissao");
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
     * @Route("gridPermissao", name="gridPermissao")
     * @Template()
     */
    public function gridAction(Request $request)
    {
         if(GridClass::isAjax()) {
            
            $columns = array("a.nomePermissao",
                "b.nomeAplicacao"
                );

            $entityJOIN           = array("aplicacao");             
            $permissoesArray      = array();
            $parametros           = $request->request->all();            
            
            $entity               = "Serbinario\Bundle\SecurityBundle\Entity\Permissao"; 
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

            $resultPermissoes = $gridClass->builderQuery();
            $countTotal       = $gridClass->getCount();
            $countPermissoes  = count($resultPermissoes);

            for($i=0;$i < $countPermissoes; $i++)
            {
                $permissoesArray[$i]['DT_RowId']  = "row_".$resultPermissoes[$i]->getId();
                $permissoesArray[$i]['id']        = $resultPermissoes[$i]->getId();
                $permissoesArray[$i]['nome']      = $resultPermissoes[$i]->getNomePermissao();  
                $permissoesArray[$i]['aplicacao'] = $resultPermissoes[$i]->getAplicacao()->getNomeAplicacao();
            }

            //Se a variável $sqlFilter estiver vazio
            if(!$gridClass->isFilter()){
                $countPermissoes = $countTotal;
            }

            $columns = array(               
                'draw'              => $parametros['draw'],
                'recordsTotal'      => "{$countTotal}",
                'recordsFiltered'   => "{$countPermissoes}",
                'data'              => $permissoesArray               
            );

            return new JsonResponse($columns);
        }else{            
            return array();            
        } 
    }

}