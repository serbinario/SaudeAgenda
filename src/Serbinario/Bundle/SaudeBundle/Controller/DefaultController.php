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
use Serbinario\Bundle\SaudeBundle\Form\LocalidadeType;
use Serbinario\Bundle\SaudeBundle\Form\PsfType;
use Serbinario\Bundle\SaudeBundle\UTIL\GridClass;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    
    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $dados = $request->request->all();
        
        if($dados['_username'] == "agenda" && $dados['_password'] == "agenda") {
           return $this->redirect($this->generateUrl("home"));
        } else {
           $this->addFlash("danger", "Login ou senha inválidos");
        }
        
        return $this->redirect($this->generateUrl("index"));
    }
    
    /**
     * @Route("/home", name="home")
     * @Template()
     */
    public function homeAction()
    {
        return array();
    }
    
    /**
     * @Route("/saveMedico", name="saveMedico")
     * @Template()
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
                
                #Executando e recuperando o resultado
                $result = $medicoRN->save($medico);
                
                if($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Médico cadastrado com sucesso'); 
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado médico');
                }                
                
                #Criando o formulário
                $form = $this->createForm(new MedicoType());
               
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
     * @Route("/gridMedico", name="gridMedico")
     * @Template()
     */
    public function gridMedicoAction(Request $request)
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
    
    /**
     * @Route("/editMedico/id/{id}", name="editMedico")
     * @Template()
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
                
                #Resultado da operação
                $result =  $medicoRN->update($medico);
                
                if($result) {
                    #Messagem de retorno
                    $this->addFlash('success', 'Médico editado com sucesso!');
                } else {
                    $this->addFlash('danger', 'Houve um erro ao editar o médico, tente novamente!');
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
     * @Route("/saveEspecialidade", name="saveEspecialidade")
     * @Template()
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
     */
    public function gridEspecialidadeAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.idEspecialidade",
                "a.nomeEspecialidade",
                );

            $entityJOIN           = array();             
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
                $radiosArray[$i]['nome']            = $resultRadios[$i]->getNomeEspecialidade();

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
                
                #Criando o formulário
                $form = $this->createForm(new LocalidadeType());
               
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
     * @Route("/gridLocalidade", name="gridLocalidade")
     * @Template()
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
     * @Route("/savePsf", name="savePsf")
     * @Template()
     */
    public function savePsfAction(Request $request)
    {        
        #Criando o formulário
        $form    = $this->createForm(new PsfType());
        
        #Recuperando o serviço do container
        $psfRN = $this->get('psf_rn');
        
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
                
                #Criando o formulário
                $form = $this->createForm(new PsfType());
               
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
     * @Route("/gridPsf", name="gridPsf")
     * @Template()
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
    
}
