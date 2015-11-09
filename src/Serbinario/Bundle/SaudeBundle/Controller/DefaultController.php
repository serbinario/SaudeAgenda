<?php

namespace Serbinario\Bundle\SaudeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Serbinario\Bundle\SaudeBundle\Form\MedicoType;
use Serbinario\Bundle\SaudeBundle\Form\EspecialidadeType;
use Serbinario\Bundle\SaudeBundle\Form\LocalidadeType;
use Serbinario\Bundle\SaudeBundle\Form\PsfType;
use Serbinario\Bundle\SaudeBundle\UTIL\GridClass;



class DefaultController extends Controller
{    
    /**
     * @Route("/home", name="home")
     * @Template()
     * @Security("has_role('ROLE_USER')")
     */
    public function homeAction()
    {
        return array();
    }
    
    /**
     * @Route("/saveMedico", name="saveMedico")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_MEDICO_CADASTRAR')")
     */
    public function saveMedicoAction(Request $request)
    {        
        #Criando o formulário
        $form    = $this->createForm(new MedicoType());
        
        #Recuperando o serviço do container
        $medicoRN = $this->get('medico_rn');
        
         #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $medico = $form->getData();
                
                if (!is_null($medico->getFoto()) && $medico->getFoto()->getFile() != null) {
                    #Criando um novo nome para o arquivo
                    $originalName = $medico->getFoto()->getFile()->getClientOriginalName();
                    $arrayName = explode(".", $originalName);
                    $newName = md5(uniqid(null, true)) . "." . $arrayName[count($arrayName) - 1];

                    $medico->getFoto()->upload($newName);
                    $medico->getFoto()->setMedico($medico);
                }
                
                #Executando e recuperando o resultado
                $result = $medicoRN->save($medico);
                
                if($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Médico cadastrado com sucesso'); 
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado médico');
                }
                
                #Retorno
                return $this->redirectToRoute("gridMedico");
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }       
            
        }
        
        #Retorno
        return array("form" => $form->createView());
    }
    
    /**
     * @Route("/gridMedico", name="gridMedico")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_MEDICO_CADASTRAR') 
     *  or has_role('ROLE_AGENDAMENTO_MEDICO_VISUALIZAR') 
     *  or has_role('ROLE_AGENDAMENTO_MEDICO_EDITAR')
     *  or has_role('ROLE_AGENDAMENTO_MEDICO_DELETAR')") 
     */
    public function gridMedicoAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.idMedico",
                "c.nome",
                "a.emailMedico",
                "d.descricao"
                );

            $entityJOIN           = array("especialidadeEspecialidade", "cgm", "b.cbo");             
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
                $radiosArray[$i]['nome']            = $resultRadios[$i]->getCgm()->getNome();
                $radiosArray[$i]['email']           = $resultRadios[$i]->getEmailMedico();
                $radiosArray[$i]['especialidade']   = $resultRadios[$i]->getEspecialidadeEspecialidade()->getCbo()->getDescricao();

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
    
    /**
     * @Route("/editMedico/id/{id}", name="editMedico")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_MEDICO_EDITAR')") 
     */
    public function editMedicoAction(Request $request, $id)
    {     
        #Recuperando o serviço do modelo
        $medicoRN = $this->get("medico_rn");
        
        #Criando o formulário
        $form = $this->createForm(new MedicoType());
        
        if($id) {
            #Recupera o candidato selecionado
            $medicoRecuperada = $medicoRN->findId($id);
            
            if($medicoRecuperada->getFoto()) {
                $documentoOld = $medicoRecuperada->getFoto();
                $pathOld      = $documentoOld->getAbsolutePath();
            }
        }
               
        #Preenche o formulário com os dados do candidato
        $form->setData($medicoRecuperada);
        
        #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
                      
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $medico = $form->getData();               
                
                #Fazendo o upload da foto
                if (!is_null($medico->getFoto()) && $medico->getFoto()->getFile() !== null) {
                    
                    if(isset($documentoOld)) {
                        $doctrine = $this->getDoctrine()->getManager();
                        $documentoOld->removeFile($pathOld);
                        $doctrine->remove($documentoOld);
                        $doctrine->flush();
                    }

                    #Criando um novo nome para o arquivo
                    $originalName = $medico->getFoto()->getFile()->getClientOriginalName();
                    $arrayName = explode(".", $originalName);
                    $newName = md5(uniqid(null, true)) . "." . $arrayName[count($arrayName) - 1];

                    $medico->getFoto()->upload($newName);
                    $medico->getFoto()->setMedico($medico);

                    $doctrine = $this->getDoctrine()->getManager();
                    $doctrine->persist($medico->getFoto());
                    $doctrine->flush();
                } else {
                    if(!isset($documentoOld)) {
                         $medico->setFoto(null);
                    }             
                }
                
                #Resultado da operação
                $result =  $medicoRN->update($medico);
                
                if($result) {
                    #Messagem de retorno
                    $this->addFlash('success', 'Médico editado com sucesso!');
                } else {
                    $this->addFlash('danger', 'Houve um erro ao editar o médico, tente novamente!');
                }
               
                #Retorno
                return $this->redirectToRoute("gridMedico");
            } else {
                $this->addFlash('warning', 'Há campos obrigatório que não foram preenchidos');
            }
        }
        
        #Retorno
        return array("form" => $form->createView(), "logo" => $medicoRecuperada->getFoto());
    }
    
    /**
     * @Route("/deleteFotoMedico", name="deleteFotoMedico")
     */
    public function deleteFotoMedicoAction(Request $request)
    {
        #Requisição
        $dados = $request->request->get("idFoto");
        
        $manager   = $this->getDoctrine()->getManager();
        $documento = $manager->getRepository("Serbinario\Bundle\SaudeBundle\Entity\FotoMedico")->find($dados);
        
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
     * @Route("/saveEspecialidade", name="saveEspecialidade")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_ESPECIALIDADE_CADASTRAR')") 
     */
    public function saveEspecialidadeAction(Request $request)
    {    
        #Criando o formulário
        $form    = $this->createForm(new EspecialidadeType());
        
        #Recuperando o serviço do container
        $especialidadeRN = $this->get('especialidade_rn');            
        
         #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $especialidade = $form->getData();
                
                #Executando e recuperando o resultado
                $result = $especialidadeRN->save($especialidade);
                
                if($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Especialidade cadastrado com sucesso'); 
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Especialidade');
                }                
                
                #Criando o formulário
                $form = $this->createForm(new EspecialidadeType());
               
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
     * @Route("/gridEspecialidade", name="gridEspecialidade")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_ESPECIALIDADE_CADASTRAR') 
     *  or has_role('ROLE_AGENDAMENTO_ESPECIALIDADE_VISUALIZAR') 
     *  or has_role('ROLE_AGENDAMENTO_ESPECIALIDADE_EDITAR')
     *  or has_role('ROLE_AGENDAMENTO_ESPECIALIDADE_DELETAR')") 
     */
    public function gridEspecialidadeAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.idEspecialidade",
                "b.descricao",
                );

            $entityJOIN           = array("cbo");             
            $radiosArray          = array();
            $parametros           = $request->request->all();            
            
            $entity               = "Serbinario\Bundle\SaudeBundle\Entity\Especialidade"; 
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
                $radiosArray[$i]['DT_RowId']        = "row_".$resultRadios[$i]->getIdEspecialidade();
                $radiosArray[$i]['id']              = $resultRadios[$i]->getIdEspecialidade();
                $radiosArray[$i]['nome']            = $resultRadios[$i]->getCbo()->getDescricao();

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
    
    /**
     * @Route("/editEspecialidade/id/{id}", name="editEspecialidade")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_ESPECIALIDADE_EDITAR')")
     */
    public function editEspecialidadeAction(Request $request, $id)
    {     
        #Recuperando o serviço do modelo
        $especialidadeRN = $this->get("especialidade_rn");
        
        #Criando o formulário
        $form = $this->createForm(new EspecialidadeType());
        
        if($id) {
            #Recupera o candidato selecionado
            $especialidadeRecuperada = $especialidadeRN->findId($id);
        }
               
        #Preenche o formulário com os dados do candidato
        $form->setData($especialidadeRecuperada);
        
        #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
                      
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $especialidade = $form->getData();               
                                
                #Resultado da operação
                $result =  $especialidadeRN->update($especialidade);
                
                if($result) {
                    #Messagem de retorno
                    $this->addFlash('success', 'Especialidade editada com sucesso!');
                } else {
                    $this->addFlash('danger', 'Houve um erro ao editar a especialidade, tente novamente!');
                }
               
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
     * @Route("/pesquisaMedico", name="pesquisaMedico")
     * @Template()
     */
    public function pesquisaMedicoAction() {
        
        $especialidadeRN = $this->get('especialidade_rn');
        
        $especialidades = $especialidadeRN->all();
        
        return array("especialidades" => $especialidades);        
    }
    
    /**
     * @Route("/medicoByEspecialidade", name="medicoByEspecialidade")
     * @Template()
     */
    public function medicoByEspecialidadeAction(Request $request) {
        
        $dados = $request->request->all();
        
        $medicoRN   = $this->get('medico_rn');
        
        $medicos    = $medicoRN->findByEspecialidade($dados['especialidade']);
        //var_dump($medicos);exit();
        return $this->redirect($this->generateUrl("pesquisaMedico", array("medicos" => $medicos)));
        
    }
    
    /**
     * @Route("/saveLocalidade", name="saveLocalidade")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_LOCALIDADE_CADASTRAR')")
     */
    public function saveLocalidadeAction(Request $request)
    {        
        #Criando o formulário
        $form    = $this->createForm(new LocalidadeType());
        
        #Recuperando o serviço do container
        $localidadeRN = $this->get('localidade_rn');
        
         #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);
           
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $localidade = $form->getData();
                
                #Executando e recuperando o resultado
                $result = $localidadeRN->save($localidade);
                
                if($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Localidade cadastrada com sucesso'); 
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado a localidade');
                }                
                            
                #Retorno
                return $this->redirectToRoute("gridLocalidade");
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }       
            
        }
        
        #Retorno
        return array("form" => $form->createView());
    }
    
    /**
     * @Route("/gridLocalidade", name="gridLocalidade")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_LOCALIDADE_CADASTRAR') 
     *  or has_role('ROLE_AGENDAMENTO_LOCALIDADE_VISUALIZAR') 
     *  or has_role('ROLE_AGENDAMENTO_LOCALIDADE_EDITAR')
     *  or has_role('ROLE_AGENDAMENTO_LOCALIDADE_DELETAR')")
     */
    public function gridLocalidadeAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.idLocalidade",
                "a.nomeLocalidade",
                );

            $entityJOIN           = array();             
            $radiosArray          = array();
            $parametros           = $request->request->all();            
            
            $entity               = "Serbinario\Bundle\SaudeBundle\Entity\Localidade"; 
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
                $radiosArray[$i]['DT_RowId']        = "row_".$resultRadios[$i]->getIdLocalidade();
                $radiosArray[$i]['id']              = $resultRadios[$i]->getIdLocalidade();
                $radiosArray[$i]['nome']            = $resultRadios[$i]->getNomeLocalidade();

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
    
    /**
     * @Route("/editLocalidade/id/{id}", name="editLocalidade")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_LOCALIDADE_EDITAR')")
     */
    public function editLocalidadeAction(Request $request, $id)
    {     
        #Recuperando o serviço do modelo
        $localidadeRN = $this->get("localidade_rn");      
        
        #Criando o formulário
        $form = $this->createForm(new LocalidadeType());
        
        if($id) {
            #Recupera o candidato selecionado
            $localidadeRecuperada = $localidadeRN->findId($id);
        }
               
        #Preenche o formulário com os dados do candidato
        $form->setData($localidadeRecuperada);
        
        #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
                      
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $localidade = $form->getData();               
                                
                #Resultado da operação
                $result =  $localidadeRN->update($localidade);
                
                if($result) {
                    #Messagem de retorno
                    $this->addFlash('success', 'Localidade editada com sucesso!');
                } else {
                    $this->addFlash('danger', 'Houve um erro ao editar a localidade, tente novamente!');
                }
               
                #Retorno
                return $this->redirectToRoute("gridLocalidade");
            } else {
                $this->addFlash('warning', 'Há campos obrigatório que não foram preenchidos');
            }
        }
        
        #Retorno
        return array("form" => $form->createView());
    }
    
    /**
     * @Route("/savePsf", name="savePsf")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_PSF_CADASTRAR')")
     */
    public function savePsfAction(Request $request)
    {        
        #Criando o formulário
        $form = $this->createForm(new PsfType());       
        
        #Recuperando o serviço do container
        $psfRN    = $this->get('psf_rn');        
        
         #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $psf = $form->getData();
                
                #Executando e recuperando o resultado
                $result = $psfRN->save($psf);
                
                if($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Posto cadastrado com sucesso'); 
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado o posto');
                }             
                
                #Retorno
                return $this->redirectToRoute("gridPsf");
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }       
            
        }
        
        #Retorno
        return array("form" => $form->createView());
    }
    
    /**
     * @Route("/gridPsf", name="gridPsf")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_PSF_CADASTRAR') 
     *  or has_role('ROLE_AGENDAMENTO_PSF_VISUALIZAR') 
     *  or has_role('ROLE_AGENDAMENTO_PSF_EDITAR')
     *  or has_role('ROLE_AGENDAMENTO_PSF_DELETAR')")
     */
    public function gridPsfAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.idPsf",
                "a.nomePsf",
                );

            $entityJOIN           = array();             
            $radiosArray          = array();
            $parametros           = $request->request->all();            
            
            $entity               = "Serbinario\Bundle\SaudeBundle\Entity\Psf"; 
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
                $radiosArray[$i]['DT_RowId']        = "row_".$resultRadios[$i]->getIdPsf();
                $radiosArray[$i]['id']              = $resultRadios[$i]->getIdPsf();
                $radiosArray[$i]['nome']            = $resultRadios[$i]->getNomePsf();

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
    
    /**
     * @Route("/editPsf/id/{id}", name="editPsf")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_PSF_EDITAR')")
     */
    public function editPsfAction(Request $request, $id)
    {     
        #Recuperando o serviço do modelo
        $psfRN = $this->get("psf_rn");
        
        #Criando o formulário
        $form = $this->createForm(new PsfType());
        
        if($id) {
            #Recupera o candidato selecionado
            $psfRecuperada = $psfRN->findId($id);
        }
             //var_dump($psfRecuperada);exit; 
        #Preenche o formulário com os dados do candidato
        $form->setData($psfRecuperada);
         
        #Verficando se é uma submissão
        if($request->getMethod() === "POST") {
                      
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if($form->isValid()) {
                #Recuperando os dados
                $psf = $form->getData();   
                
                //Trantando qtdDefaults
                $idQtdDefaults = array();
                foreach ($psf->getQtdDefaults() as $qtdDefault) {
                    $idQtdDefaults[] = $qtdDefault->getIdQtdDefault();
                    $qtdDefault->setPsf($psf);
                }
                $psfRN->deleleNotId($psf->getIdPsf() ,$idQtdDefaults);
                                
                #Resultado da operação
                $result =  $psfRN->update($psf);
                
                if($result) {
                    #Messagem de retorno
                    $this->addFlash('success', 'Posto de saúde editado com sucesso!');
                } else {
                    $this->addFlash('danger', 'Houve um erro ao editar o posto de saúde, tente novamente!');
                }
               
                #Retorno
                return $this->redirectToRoute("gridPsf");
            } else {
                $this->addFlash('warning', 'Há campos obrigatório que não foram preenchidos');
            }
        }
        
        #Retorno
        return array("form" => $form->createView());
    }
    
    /**
     * @Route("/validateNomePsf", name="validateNomePsf")
     */
    public function validateNomePsfAction(Request $request)
    {
        #Manager do Doctrine
        $manager = $this->getDoctrine()->getManager();
        
        #Recuperando os dados da requisição
        $nome    = $request->request->get("nome");        
        $result  = $manager->getRepository("SaudeBundle:Psf")->findBy(array("nomePsf" => $nome));
        
        #Retorno
        return new JsonResponse($result ? true : false);
    }
    
    /**
     * @Route("/validateNomeLocalidade", name="validateNomeLocalidade")
     */
    public function validateNomeLocalidadeAction(Request $request)
    {
        #Manager do Doctrine
        $manager = $this->getDoctrine()->getManager();
        
        #Recuperando os dados da requisição
        $nome    = $request->request->get("nome");        
        $result  = $manager->getRepository("SaudeBundle:Localidade")->findBy(array("nomeLocalidade" => $nome));
        
        #Retorno
        return new JsonResponse($result ? true : false);
    }
    
}