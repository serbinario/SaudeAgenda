<?php

namespace Serbinario\Bundle\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Serbinario\Bundle\SecurityBundle\Form\ProjetoType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Serbinario\Bundle\SecurityBundle\UTIL\GridClass;

class ProjetoController extends Controller
{
    /**
     * @Route("saveProjeto",name="saveProjeto")
     * @Template()
     */
    public function saveAction(Request $request)
    {
        #Criando o formulário
        $form = $this->createForm(new ProjetoType());

        #Recuperando o serviço do container
        $projetoRN = $this->get('rn_projeto');
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição            
            $form->handleRequest($request);           

            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $projeto = $form->getData();
                            
                #Executando e recuperando o resultado
                $result = $projetoRN->save($projeto);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }

                #Retorno
                return $this->redirectToRoute("gridProjetos");
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
     * @Route("updateProjeto/{id}", name="updateProjeto")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        #Recuperando o serviço do container        
        $projetoRN = $this->get('rn_projeto'); 
        
        #recuperando o projeto 
        $projeto = $projetoRN->find($id);
               
        #Criando o formulário
        $form = $this->createForm(new ProjetoType(), $projeto);
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);

            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $projeto = $form->getData();            
               
                #Executando e recuperando o resultado
                $result = $projetoRN->update($projeto);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }
                
                #Retorno
                return $this->redirectToRoute("gridProjetos");
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
     * @Route("gridProjetos", name="gridProjetos")
     * @Template()
     */
    public function gridAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.nomeProjeto");

            $entityJOIN           = array();             
            $projetosArray        = array();
            $parametros           = $request->request->all();            
            
            $entity               = "Serbinario\Bundle\SecurityBundle\Entity\Projeto"; 
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

            $resultProjetos = $gridClass->builderQuery();
            $countTotal     = $gridClass->getCount();
            $countProjetos  = count($resultProjetos);

            for($i=0;$i < $countProjetos; $i++)
            {
                $projetosArray[$i]['DT_RowId'] = "row_".$resultProjetos[$i]->getId();
                $projetosArray[$i]['id']       = $resultProjetos[$i]->getId();
                $projetosArray[$i]['nome']     = $resultProjetos[$i]->getNomeProjeto();                
            }

            //Se a variável $sqlFilter estiver vazio
            if(!$gridClass->isFilter()){
                $countProjetos = $countTotal;
            }

            $columns = array(               
                'draw'              => $parametros['draw'],
                'recordsTotal'      => "{$countTotal}",
                'recordsFiltered'   => "{$countProjetos}",
                'data'              => $projetosArray               
            );

            return new JsonResponse($columns);
        }else{            
            return array();            
        }
    }

}