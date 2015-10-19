<?php

namespace Serbinario\Bundle\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Serbinario\Bundle\SecurityBundle\UTIL\GridClass;
use Serbinario\Bundle\SecurityBundle\Form\PerfilType;

class PerfilController extends Controller
{
    /**
     * @Route("savePerfil", name="savePerfil")
     * @Template()
     */
    public function saveAction(Request $request)
    {
        #Criando o formulário
        $form = $this->createForm(new PerfilType());

        #Recuperando o serviço do container
        $perfilRN = $this->get('rn_perfil');
        $projetoRN = $this->get('rn_projeto');
        $roleRN    = $this->get('rn_role');
        
        #Recuperando os projetos
        $projetos = $projetoRN->all();
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição            
            $form->handleRequest($request);           
            
            #Recuperando os perfís e permissões
            $permissoes    = $request->request->get("permissao");            
            
            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $perfil = $form->getData();
                
                #Permissões
                foreach ($permissoes as $permissao) {
                    $role = $roleRN->findByRole($permissao);
                    
                    if($role) {
                        $perfil->addRole($role[0]);
                    } else {
                        $newRole = new \Serbinario\Bundle\SecurityBundle\Entity\Role();
                        $newRole->setNomeRole($permissao);
                        $perfil->addRole($newRole);
                    }
                }
                            
                #Executando e recuperando o resultado
                $result = $perfilRN->save($perfil);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }

                #Retorno
                return $this->redirectToRoute("gridPerfil");
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }
        }        
        
        #Retorno
        return array(
            "form" => $form->createView(),
            "projetos" => $projetos
        );
    }

    /**
     * @Route("updatePerfil/{id}", name="updatePerfil")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        #Recuperando o serviço do container        
        $perfilRN  = $this->get('rn_perfil'); 
        $projetoRN = $this->get('rn_projeto');
        $roleRN    = $this->get('rn_role');
        
        #recuperando o perfil e os projetos
        $perfil   = $perfilRN->find($id);
        $projetos = $projetoRN->all();
               
        #Criando o formulário
        $form = $this->createForm(new PerfilType(), $perfil);
        
        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Recuperando os perfís e permissões
            $permissoes    = $request->request->get("permissao");

            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $perfil = $form->getData(); 
                $perfil->clearRoles();
                
                #Permissões
                foreach ($permissoes as $permissao) {
                    $role = $roleRN->findByRole($permissao);
                    
                    if($role) {
                        $perfil->addRole($role[0]);
                    } else {
                        $newRole = new \Serbinario\Bundle\SecurityBundle\Entity\Role();
                        $newRole->setNomeRole($permissao);
                        $perfil->addRole($newRole);
                    }
                }
               
                #Executando e recuperando o resultado
                $result = $perfilRN->update($perfil);

                if ($result) {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('success', 'Dados cadastrado com sucesso');
                } else {
                    #Messagem de retorno
                    $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrado Dados');
                }
                
                #Retorno
                return $this->redirectToRoute("gridPerfil");
            } else {
                #Messagem de retorno
                $this->get('session')->getFlashBag()->add('danger', (string) $form->getErrors());
            }
        }    
        
        $rolesDoPerfil  = array();        
        foreach($perfil->getRoles()->toArray() as $role) {
            $rolesDoPerfil[] = $role->getNomeRole();
        }
        
        #Retorno
        return array(
            "form" => $form->createView(),
            "projetos" => $projetos,
            "rolesDoPerfil" => $rolesDoPerfil
        );        
    }

    /**
     * @Route("gridPerfil", name="gridPerfil")
     * @Template()
     */
    public function gridAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.nomePerfil");

            $entityJOIN      = array();             
            $perfisArray     = array();
            $parametros      = $request->request->all();            
            
            $entity          = "Serbinario\Bundle\SecurityBundle\Entity\Perfil"; 
            $columnWhereMain = "";
            $whereValueMain  = "";
            $whereFull       = "";
            
            $gridClass = new GridClass($this->getDoctrine()->getManager(), 
                    $parametros,
                    $columns,
                    $entity,
                    $entityJOIN,           
                    $columnWhereMain,
                    $whereValueMain,
                    $whereFull);

            $resultPerfis = $gridClass->builderQuery();
            $countTotal   = $gridClass->getCount();
            $countPerfil  = count($resultPerfis);

            for($i=0;$i < $countPerfil; $i++)
            {
                $perfisArray[$i]['DT_RowId'] = "row_".$resultPerfis[$i]->getId();
                $perfisArray[$i]['id']       = $resultPerfis[$i]->getId();
                $perfisArray[$i]['nome']     = $resultPerfis[$i]->getNomePerfil();                
            }

            //Se a variável $sqlFilter estiver vazio
            if(!$gridClass->isFilter()){
                $countPerfil = $countTotal;
            }

            $columns = array(               
                'draw'              => $parametros['draw'],
                'recordsTotal'      => "{$countTotal}",
                'recordsFiltered'   => "{$countPerfil}",
                'data'              => $perfisArray               
            );

            return new JsonResponse($columns);
        }else{            
            return array();            
        }
    }    
}