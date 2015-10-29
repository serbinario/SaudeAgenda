<?php

namespace Serbinario\Bundle\SaudeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Serbinario\Bundle\SaudeBundle\UTIL\GridClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Serbinario\Bundle\SaudeBundle\Form\CGMType;
use Serbinario\Bundle\SaudeBundle\Form\CGMPJuridicaType;

class CGMController extends Controller
{
    /**
     * @Route("/saveCGM", name="saveCGM")
     * @Template()
     */
    public function saveCGMAction(Request $request)
    {
        #Recuperando o serviço do modelo
        $cgmRN = $this->get("cgm_rn");
        
        #Criando o formulário
        $form = $this->createForm(new CGMType());
        
        #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);

            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $cgm = $form->getData();
                
                $ultimoRegistro = $cgmRN->ultimoRegistroNumCGM();
                $codigo = $ultimoRegistro ? $ultimoRegistro[0][1] + 1 : "1";
                $cgm->setNumCGM($codigo);
                $cgm->setTipoCadastro('1');
                
                if (!is_null($cgm->getFoto()) && $cgm->getFoto()->getFile() != null) {
                    #Criando um novo nome para o arquivo
                    $originalName = $cgm->getFoto()->getFile()->getClientOriginalName();
                    $arrayName = explode(".", $originalName);
                    $newName = md5(uniqid(null, true)) . "." . $arrayName[count($arrayName) - 1];

                    $cgm->getFoto()->upload($newName);
                    $cgm->getFoto()->setCgm($cgm);
                }
                
                #Resultado da operação
                $result =  $cgmRN->save($cgm);
                
                if($result) {
                    #Messagem de retorno
                    $this->addFlash('success', 'Pessoa Física cadastrada com sucesso!');
                } else {
                    $this->addFlash('danger', 'Houve um erro ao cadastrar a pessoa, tente novamente!');
                }
                     
                #Criando o formulário
                $form = $this->createForm(new CGMType());
               
                #Retorno
                return array("form" => $form->createView());
            } else {
                $this->addFlash('warning', 'Há campos obrigatório que não foram preenchidos');
            }
        }
        
        #Retorno
        return array("form" => $form->createView());
    }
    
    /**
     * @Route("/saveCGMPJuridica", name="saveCGMPJuridica")
     * @Template()
     */
    public function saveCGMPJuridicaAction(Request $request)
    {
        #Recuperando o serviço do modelo
        $cgmRN = $this->get("cgm_rn");
        
        #Criando o formulário
        $form = $this->createForm(new CGMPJuridicaType());
        
        #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);

            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $cgm = $form->getData();
                
                $ultimoRegistro = $cgmRN->ultimoRegistroNumCGM();
                $codigo = $ultimoRegistro ? $ultimoRegistro[0][1] + 1 : "1";
                $cgm->setNumCGM($codigo);
                $cgm->setTipoCadastro('2');
                
                if (!is_null($cgm->getFoto()) && $cgm->getFoto()->getFile() != null) {
                    #Criando um novo nome para o arquivo
                    $originalName = $cgm->getFoto()->getFile()->getClientOriginalName();
                    $arrayName = explode(".", $originalName);
                    $newName = md5(uniqid(null, true)) . "." . $arrayName[count($arrayName) - 1];

                    $cgm->getFoto()->upload($newName);
                    $cgm->getFoto()->setCgm($cgm);
                }
                
                #Resultado da operação
                $result =  $cgmRN->save($cgm);
                
                if($result) {
                    #Messagem de retorno
                    $this->addFlash('success', 'Pessoa Júridica cadastrada com sucesso!');
                } else {
                    $this->addFlash('danger', 'Houve um erro ao cadastrar a pessoa, tente novamente!');
                }
                     
                #Criando o formulário
                $form = $this->createForm(new CGMPJuridicaType());
               
                #Retorno
                return array("form" => $form->createView());
            } else {
                $this->addFlash('warning', 'Há campos obrigatório que não foram preenchidos');
            }
        }
        
        #Retorno
        return array("form" => $form->createView());
    }
    
    /**
     * *************************************************************************
     * Rotas para grid de consultas
     * *************************************************************************
     */
    
    /**
     * @Route("/consultaCGM", name="consultaCGM")
     * @Template()
     */
    public function consultaCGMAction(Request $request) {
        
        if(GridClass::isAjax()) {
            
            $columns = array("a.idCGM",
                "a.numCGM",
                "a.nome",
                "a.CpfCnpj",
                "a.rg",
                "b.CGMMunicipio"
                );

            $entityJOIN = array("CGMMunicipio");             
            $eventosArray         = array();
            $parametros           = $request->request->all();
            $entity               = "Serbinario\Bundle\SaudeBundle\Entity\CGM"; 
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

            $resultCliente  = $gridClass->builderQuery();    
            $countTotal     = $gridClass->getCount();
            $countEventos   = count($resultCliente);

            for($i=0;$i < $countEventos; $i++)
            {
                $eventosArray[$i]['DT_RowId']           =  "row_".$resultCliente[$i]->getIdCGM();
                $eventosArray[$i]['id']                 =  $resultCliente[$i]->getIdCGM();
                $eventosArray[$i]['num']                =  $resultCliente[$i]->getNumCGM();
                $eventosArray[$i]['nome']               =  $resultCliente[$i]->getNome();
                $eventosArray[$i]['cpf']                =  $resultCliente[$i]->getCpf();
                $eventosArray[$i]['rg']                 =  $resultCliente[$i]->getRg();
                $eventosArray[$i]['CGMMunicipio']       =  $resultCliente[$i]->getCGMMunicipio()->getCGMMunicipio();
                $eventosArray[$i]['tipoCadastro']       =  $resultCliente[$i]->getTipoCadastro();
                
                
            }

            //Se a variável $sqlFilter estiver vazio
            if(!$gridClass->isFilter()){
                $countEventos = $countTotal;
            }

            $columns = array(               
                'draw'              => $parametros['draw'],
                'recordsTotal'      => "{$countTotal}",
                'recordsFiltered'   => "{$countEventos}",
                'data'              => $eventosArray               
            );

            return new JsonResponse($columns);
        }else{            
            return array();            
        }
        
    }
    
    /**
     * *************************************************************************
     * Rotas para edição
     * *************************************************************************
     */
    
    /**
     * @Route("/editCGM/id/{id}", name="editCGM")
     * @Template()
     */
    public function editCGMAction(Request $request, $id)
    {     
        #Recuperando o serviço do modelo
        $cgmRN = $this->get("cgm_rn");
        
        #Criando o formulário
        $form = $this->createForm(new CGMType());
        
        if($id) {
            #Recupera o aluno selecionado
            $cgmRecuperado = $cgmRN->findById($id);
            
            if($cgmRecuperado->getFoto()) {
                $documentoOld = $cgmRecuperado->getFoto();
                $pathOld      = $documentoOld->getAbsolutePath();
            }
        }
               
        #Preenche o formulário com os dados do candidato
        $form->setData($cgmRecuperado);
        
        #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
                      
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $cgm = $form->getData();            
                
                //Adicionando deficiências
                $idTelefones = array();
                foreach ($cgm->getTelefones() as $telefone) {
                    $idTelefones[] = $telefone->getIdFonesCGM();
                    $telefone->setCgm($cgm);
                }
                
                #Fazendo o upload da foto
                if (!is_null($cgm->getFoto()) && $cgm->getFoto()->getFile() !== null) {
                    
                    if(isset($documentoOld)) {
                        $doctrine = $this->getDoctrine()->getManager();
                        $documentoOld->removeFile($pathOld);
                        $doctrine->remove($documentoOld);
                        $doctrine->flush();
                    }

                    #Criando um novo nome para o arquivo
                    $originalName = $cgm->getFoto()->getFile()->getClientOriginalName();
                    $arrayName = explode(".", $originalName);
                    $newName = md5(uniqid(null, true)) . "." . $arrayName[count($arrayName) - 1];

                    $cgm->getFoto()->upload($newName);
                    $cgm->getFoto()->setCgm($cgm);

                    $doctrine = $this->getDoctrine()->getManager();
                    $doctrine->persist($cgm->getFoto());
                    $doctrine->flush();
                } else {
                    if(!isset($documentoOld)) {
                         $cgm->setFoto(null);
                    }             
                }
                
                #Resultado da operação
                $result =  $cgmRN->edit($cgm);
                
                if($result) {
                    #Messagem de retorno
                    $this->addFlash('success', 'Pessoa Física editada com sucesso!');
                } else {
                    $this->addFlash('danger', 'Houve um erro ao editar a pessoa, tente novamente!');
                }
               
                $aluno = $cgmRN->findById($id);
                
                #Retorno
                return array("form" => $form->createView(), "logo" => $aluno->getFoto());
            } else {
                $this->addFlash('warning', 'Há campos obrigatório que não foram preenchidos');
            }
        }
        
        #Retorno
        return array("form" => $form->createView(), "logo" => $cgmRecuperado->getFoto());
    }
    
    /**
     * @Route("/editCGMPJuridica/id/{id}", name="editCGMPJuridica")
     * @Template()
     */
    public function editCGMPJuridicaAction(Request $request, $id)
    {     
        #Recuperando o serviço do modelo
        $cgmRN = $this->get("cgm_rn");
        
        #Criando o formulário
        $form = $this->createForm(new CGMPJuridicaType());
        
        if($id) {
            #Recupera o aluno selecionado
            $cgmRecuperado = $cgmRN->findById($id);
            
            if($cgmRecuperado->getFoto()) {
                $documentoOld = $cgmRecuperado->getFoto();
                $pathOld      = $documentoOld->getAbsolutePath();
            }
        }
               
        #Preenche o formulário com os dados do candidato
        $form->setData($cgmRecuperado);
        
        #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
                      
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $cgm = $form->getData();            
                
                //Adicionando deficiências
                $idTelefones = array();
                foreach ($cgm->getTelefones() as $telefone) {
                    $idTelefones[] = $telefone->getIdFonesCGM();
                    $telefone->setCgm($cgm);
                }
                
                #Fazendo o upload da foto
                if (!is_null($cgm->getFoto()) && $cgm->getFoto()->getFile() !== null) {
                    
                    if(isset($documentoOld)) {
                        $doctrine = $this->getDoctrine()->getManager();
                        $documentoOld->removeFile($pathOld);
                        $doctrine->remove($documentoOld);
                        $doctrine->flush();
                    }

                    #Criando um novo nome para o arquivo
                    $originalName = $cgm->getFoto()->getFile()->getClientOriginalName();
                    $arrayName = explode(".", $originalName);
                    $newName = md5(uniqid(null, true)) . "." . $arrayName[count($arrayName) - 1];

                    $cgm->getFoto()->upload($newName);
                    $cgm->getFoto()->setCgm($cgm);

                    $doctrine = $this->getDoctrine()->getManager();
                    $doctrine->persist($cgm->getFoto());
                    $doctrine->flush();
                } else {
                    if(!isset($documentoOld)) {
                         $cgm->setFoto(null);
                    }             
                }
                
                #Resultado da operação
                $result =  $cgmRN->edit($cgm);
                
                if($result) {
                    #Messagem de retorno
                    $this->addFlash('success', 'Pessoa Júridica editada com sucesso!');
                } else {
                    $this->addFlash('danger', 'Houve um erro ao editar a pessoa, tente novamente!');
                }
               
                $aluno = $cgmRN->findById($id);
                
                #Retorno
                return array("form" => $form->createView(), "logo" => $aluno->getFoto());
            } else {
                $this->addFlash('warning', 'Há campos obrigatório que não foram preenchidos');
            }
        }
        
        #Retorno
        return array("form" => $form->createView(), "logo" => $cgmRecuperado->getFoto());
    }
    
    /**
     * *************************************************************************
     * Rotas para deletar
     * *************************************************************************
     */
    
    /**
     * @Route("/deleteFotoCGM", name="deleteFotoCGM")
     */
    public function deleteFotoCGMAction(Request $request)
    {
        #Requisição
        $dados = $request->request->get("idFoto");
        
        $manager   = $this->getDoctrine()->getManager();
        $documento = $manager->getRepository("Serbinario\Bundle\SaudeBundle\Entity\FotoCGM")->find($dados);
        
        try {
            $documento->removeFile($documento->getAbsolutePath());
        
            $manager->remove($documento);
            $manager->flush();
            
            return new JsonResponse(true);
        } catch (Exception $ex) {
            return new JsonResponse(false);
        }
    }
    
    /**
     * *************************************************************************
     * Rotas para visualização
     * *************************************************************************
     */
    
    /**
     * @Route("/visualizarCGM/id/{id}", name="visualizarCGM")
     * @Template()
     */
    public function visualizarCGMAction($id) {
        
        $cgmRN   = $this->get("cgm_rn");
        $cgm     = $cgmRN->findById($id);
        
        return array("cgm" => $cgm);
    }
    
    /**
     * @Route("/visualizarCGMJuridica/id/{id}", name="visualizarCGMJuridica")
     * @Template()
     */
    public function visualizarCGMJuridicaAction($id) {
        
        $cgmRN   = $this->get("cgm_rn");
        $cgm     = $cgmRN->findById($id);
        
        return array("cgm" => $cgm);
    }
    
    /**
     * *************************************************************************
     * Rotas para requisição ajax
     * *************************************************************************
     */
    
    /**
     * @Route("/searchCGM", name="searchCGM")
     */
    public function searchCGMAction(Request $request) {
        
        $cpf    = $request->request->get('cpf');
        $nome   = $request->request->get('nome');
        $tipo   = $request->request->get('tipo');
        $msg    = "";
        
        $cgmRN = $this->get("cgm_rn");
        $cgm   = $cgmRN->searchCGMCpfNome($cpf, $nome, $tipo);

        if ($cgm) {
            $msg = 'sucesso';
        } else {
            $msg = 'erro';
        }
        
        $dados = array (
            'cgms' => $cgm,
            'msg'  => $msg
        );
        
        return new JsonResponse($dados);
    }
}
