<?php

namespace Serbinario\Bundle\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Serbinario\Bundle\SecurityBundle\Form\UserType;
use Serbinario\Bundle\SecurityBundle\UTIL\GridClass;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * @Route("/saveUser", name="saveUser")
     * @Template()
     */
    public function saveAction(Request $request)
    {
        #Criando o formulário
        $form = $this->createForm(new UserType());

        #Recuperando o serviço do container
        $userRN    = $this->get('rn_user');
        $projetoRN = $this->get('rn_projeto');
        $perfilRN  = $this->get('rn_perfil');
        $roleRN    = $this->get('rn_role');
        
        $projetos = $projetoRN->all();
        $perfis   = $perfilRN->all();
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição            
            $form->handleRequest($request);
            
            #Recuperando os perfís e permissões
            $permissoes    = $request->request->get("permissao");
            $perfisRequest = $request->request->get("perfil");           
      
            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $user = $form->getData();
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($encoded);
                
                if (!is_null($user->getFoto()) && $user->getFoto()->getFile() != null) {
                    #Criando um novo nome para o arquivo
                    $originalName = $user->getFoto()->getFile()->getClientOriginalName();
                    $arrayName = explode(".", $originalName);
                    $newName = md5(uniqid(null, true)) . "." . $arrayName[count($arrayName) - 1];

                    $user->getFoto()->upload($newName);
                    $user->getFoto()->setUser($user);
                }
                
                #Perfís 
                foreach ($perfisRequest as $perfil) {
                    $objPerfil = $perfilRN->find($perfil);

                    if ($objPerfil) {
                        $user->addPerfi($objPerfil);
                    }
                }

                #Permissões
                foreach ($permissoes as $permissao) {
                    $role = $roleRN->findByRole($permissao);
                    
                    if($role) {
                        $user->addRole($role[0]);
                    } else {
                        $newRole = new \Serbinario\Bundle\SecurityBundle\Entity\Role();
                        $newRole->setNomeRole($permissao);
                        $user->addRole($newRole);
                    }
                }
               
                #Executando e recuperando o resultado
                $result = $userRN->save($user);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }

                #Retorno
                return $this->redirectToRoute("gridUser");
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }
        }

        #Retorno
        return array("form" => $form->createView(), "perfis" => $perfis, "projetos" => $projetos);
        
    }

    /**
     * @Route("/updateUser/{id}", name="updateUser")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        #Recuperando o serviço do container
        $userRN    = $this->get('rn_user');
        $projetoRN = $this->get('rn_projeto');
        $perfilRN  = $this->get('rn_perfil');
        $roleRN    = $this->get('rn_role');
        
        #Recuperando os projetos e perfís
        $projetos = $projetoRN->all();
        $perfis   = $perfilRN->all();
        
        #Recuperando o Usuário
        $user = $userRN->find($id);
        $oldPassword = $user->getPassword();
        $user->setPassword("");
        
        #Criando o formulário
        $form = $this->createForm(new UserType(), $user);     
        
        #Verifica a existência da foto do usuário
        if($user->getFoto()) {
            $documentoOld = $user->getFoto();
            $pathOld      = $documentoOld->getAbsolutePath();
        }       
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);

            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $user = $form->getData();
                $user->clearRoles();
                $user->clearPerfis();
                
                #Trabalhando com a nova senha
                if($user->getPassword() != "") {
                    $encoder = $this->container->get('security.password_encoder');
                    $encoded = $encoder->encodePassword($user, $user->getPassword());
                    $user->setPassword($encoded);
                } else {
                    $user->setPassword($oldPassword);
                }
                
                #Fazendo o upload da foto
                if (!is_null($user->getFoto()) && $user->getFoto()->getFile() !== null) {
                    
                    if(isset($documentoOld)) {
                        $doctrine = $this->getDoctrine()->getManager();
                        $documentoOld->removeFile($pathOld);
                        $doctrine->remove($documentoOld);
                        $doctrine->flush();
                    }

                    #Criando um novo nome para o arquivo
                    $originalName = $user->getFoto()->getFile()->getClientOriginalName();
                    $arrayName = explode(".", $originalName);
                    $newName = md5(uniqid(null, true)) . "." . $arrayName[count($arrayName) - 1];

                    $user->getFoto()->upload($newName);
                    $user->getFoto()->setUser($user);

                    $doctrine = $this->getDoctrine()->getManager();
                    $doctrine->persist($user->getFoto());
                    $doctrine->flush();
                } else {
                    if(!isset($documentoOld)) {
                         $user->setFoto(null);
                    }             
                }
                
                #Recuperando os perfís e permissões
                $permissoes    = $request->request->get("permissao");
                $perfisRequest = $request->request->get("perfil");
                
                #Perfís 
                foreach ($perfisRequest as $perfil) {
                    $objPerfil = $perfilRN->find($perfil);

                    if ($objPerfil) {
                        $user->addPerfi($objPerfil);
                    }
                }

                #Permissões
                foreach ($permissoes as $permissao) {
                    $role = $roleRN->findByRole($permissao);
                    
                    if($role) {
                        $user->addRole($role[0]);
                    } else {
                        $newRole = new \Serbinario\Bundle\SecurityBundle\Entity\Role();
                        $newRole->setNomeRole($permissao);
                        $user->addRole($newRole);
                    }
                }
               
                #Executando e recuperando o resultado
                $result = $userRN->update($user);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }
                
                #Retorno
                return $this->redirectToRoute("gridUser");
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }
        }
        
        $rolesDoUser  = array();        
        foreach($user->listRoles()->toArray() as $role) {
            $rolesDoUser[] = $role->getNomeRole();
        }
        
        $perfisDoUser = array();
        foreach($user->getPerfis()->toArray() as $perfil) {
            $perfisDoUser[] = $perfil->getNomePerfil();
        }

        #Retorno
        return array(
            "form" => $form->createView(),
            "perfis" => $perfis,
            "projetos" => $projetos,
            "perfisDoUser"=> $perfisDoUser,
            "rolesDoUser" => $rolesDoUser,
            "logo" => $user->getFoto()
        );        
    }

    /**
     * @Route("/gridUser", name="gridUser")
     * @Template()
     */
    public function gridAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.username",
                "a.email"
                );

            $entityJOIN           = array();             
            $usersArray           = array();
            $parametros           = $request->request->all();            
            
            $entity               = "Serbinario\Bundle\SecurityBundle\Entity\User"; 
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

            $resultUsers    = $gridClass->builderQuery();    
            $countTotal     = $gridClass->getCount();
            $countUsers     = count($resultUsers);

            for($i=0;$i < $countUsers; $i++)
            {
                $usersArray[$i]['DT_RowId'] = "row_".$resultUsers[$i]->getId();
                $usersArray[$i]['id']       = $resultUsers[$i]->getId();
                $usersArray[$i]['username'] = $resultUsers[$i]->getUsername();
                $usersArray[$i]['email']    = $resultUsers[$i]->getEmail();
            }

            //Se a variável $sqlFilter estiver vazio
            if(!$gridClass->isFilter()){
                $countUsers = $countTotal;
            }

            $columns = array(               
                'draw'              => $parametros['draw'],
                'recordsTotal'      => "{$countTotal}",
                'recordsFiltered'   => "{$countUsers}",
                'data'              => $usersArray               
            );

            return new JsonResponse($columns);
        }else{            
            return array();            
        }
    }

}