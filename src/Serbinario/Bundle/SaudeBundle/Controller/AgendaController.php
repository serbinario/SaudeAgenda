<?php

namespace Serbinario\Bundle\SaudeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Serbinario\Bundle\SaudeBundle\UTIL\GridClass;
use Serbinario\Bundle\SaudeBundle\Form\CalendarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/agenda")
 */
class AgendaController extends Controller {

    /**
     * @Route("/agendamento", defaults={"id" = 0},name="agendamento")
     * @Route("/agendamento/id/{id}", name="agendamentoByMedico")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_AGENDAMENTO_CADASTRAR') or has_role('ROLE_AGENDAMENTO_AGENDAMENTO_VISUALIZAR')")
     */
    public function agendamentoAction($id) {
        
        $especializacoesRN = $this->get('especialidade_rn');
        $especializacoes   = $especializacoesRN->all();
        
        $medicosRN = $this->get('medico_rn');
        $medicos   = $medicosRN->all();
        
        return array('especializacoes' => $especializacoes, 'medicos' => $medicos, 'id' => $id);
    }
    
    /**
     * @Route("/agendaMedico/{id}", name="agendaMedico")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_AGENDAMEDICO_CADASTRAR')  or has_role('ROLE_AGENDAMENTO_AGENDAMEDICO_VISUALIZAR')")
     */
    public function agendaMedicoAction(Request $request, $id)
    {          
        #Recuperando o serviço do container
        $calendarioRN = $this->get('calendario_rn');
        $medicoRN     = $this->get("medico_rn");
        
        #Data atual        
        $dataAtual    = new \DateTime("now");    
        
        #Preenchimento do obj Calendário
        $calendario = new \Serbinario\Bundle\SaudeBundle\Entity\Calendario();
        $medico     = $medicoRN->findId($id);
        $nomeMedico = $medico->getCgm()->getNome();
        $calendario->setQtdTotalCalendario($medico->getQuantidadeVagas());
               
        #Criando o formulário
        $form = $this->createForm(new CalendarioType(), $calendario, array("idMedico"=> $id)); 

        #Verficando se é uma submissão
        if ($request->getMethod() === "POST") {
            #Repasando a requisição
            $form->handleRequest($request);
            
            #Verifica se os dados são válidos
            if ($form->isValid()) {
                #Recuperando os dados
                $calendario = $form->getData();                
                
                #Set o médico do calendário
                $calendario->setMedicoMedico($medico);
               
                #Recuperando o calendário
                $objCalendario = $calendarioRN->findByDateAndIdMedico($calendario->getDiaCalendario(), $id);          
                $result        = "";
                $qtdCaledarios = array();
                
                #Persistindo o calendário
                if($objCalendario) {
                    $objCalendario->setDiaCalendario($calendario->getDiaCalendario());
                    $objCalendario->setHorarioCalendario($calendario->getHorarioCalendario());
                    $objCalendario->setQtdTotalCalendario($calendario->getQtdTotalCalendario());
                    $objCalendario->setQtdReservaCalendario($calendario->getQtdReservaCalendario());
                    $objCalendario->setStatusCalendario($calendario->getStatusCalendario());
                    $objCalendario->setLocalidadeLocalidade($calendario->getLocalidadeLocalidade());
                    
                    $qtdCaledarios = $objCalendario->getQtdCalendarios()->toArray();                    
                    $result        = $calendarioRN->update($objCalendario);
                } else {
                    
                    foreach ($medico->getQtdDefualts()->toArray() as $qtdDefault)
                    {
                        $qtdCalendario = new \Serbinario\Bundle\SaudeBundle\Entity\QtdCalendario();
                        $qtdCalendario->setCalendario($calendario);
                        $qtdCalendario->setPsf($qtdDefault->getPsf());
                        $qtdCalendario->setQtdCalendario($qtdDefault->getQtdDefault());
                        
                        $result = $calendario->addQtdCalendario($qtdCalendario);
                    }
                    
                    $qtdCaledarios = $calendario->getQtdCalendarios()->toArray();
                    $result        = $calendarioRN->save($calendario);                    
                }
                
                #Tratamento da mensagem de retorno
                if (!$result) {
                    #retorno
                    return new JsonResponse(false); 
                } 
               
                $arrayQtdCalendarios = array();
                $count = 0;
                foreach ($qtdCaledarios as $qtd) {                    
                    $arrayQtdCalendarios[$count]['nomePsf'] = $qtd->getPsf()->getNomePsf();
                    $arrayQtdCalendarios[$count]['qtd']     = $qtd->getQtdCalendario(); 
                    $arrayQtdCalendarios[$count]['id']      = $qtd->getCalendario()->getIdCalendario(); 
                    
                    $count++;
                }
               
                #retorno
                return new JsonResponse($arrayQtdCalendarios);
            } else {
               return new JsonResponse(false); 
            }
        }      
       
        #Retorno
        return array(
            "form" => $form->createView(), 
            "id" => $id, 
            "qtdTotal" => $calendario->getQtdTotalCalendario(),
            "nomeMedico" => $nomeMedico
        );
    }
    
    /**
     * @Route("/gridAgendaMedico", name="gridAgendaMedico")
     * @Template()
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_AGENDAMENTO_AGENDAMEDICO_CADASTRAR') or has_role('ROLE_AGENDAMENTO_AGENDAMEDICO_VISUALIZAR')")
     */
    public function gridAgendaMedicoAction(Request $request)
    {
        if(GridClass::isAjax()) {
            
            $columns = array("a.idMedico",
                "c.nome",
                "a.emailMedico",
                "b.nomeEspecialidade"
                );

            $entityJOIN           = array("especialidadeEspecialidade", "cgm");             
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
     * @Route("/getCalendario", name="getCalendario")
     * @Template()
     */
    public function getCalendarioAction(Request $request)
    {
        #Recuperando o id do médico
        $idMedico     = $request->request->get("id");
        
        #Recuperando o serviço do container
        $calendarioRN = $this->get('calendario_rn');
        
        #Recuperando o calendário do médico
        $calendario   = $calendarioRN->findByMedico($idMedico);
        
        #Array de resposta
        $arrayResult  = array();
        $count        = 0;
        
        foreach($calendario as $dia) {
            $classname = "";
            
            if (count($dia->getAgendamento()->toArray()) > 0) {
               $classname = "red";
            } else {
               $classname = $dia->getStatusCalendario() ? "blue" : "gray";
            }
            
            $arrayResult[$count]['date']      = $dia->getDiaCalendario()->format("Y-m-d");
            $arrayResult[$count]['badge']     = false;
            $arrayResult[$count]['classname'] = $classname;
            $arrayResult[$count]['title']     = $dia->getMedicoMedico()->getCgm()->getNome();
            
            $count++;
        }
        
        #Responsta Json
        return new JsonResponse($arrayResult);      
    }
    
    /**
     * @Route("/getCalendarioBig", name="getCalendarioBig")
     * @Template()
     */
    public function getCalendarioBigAction(Request $request)
    {
        #Recuperando o id do médico
        $idMedico     = $request->request->all();
        
        #Recuperando o serviço do container
        $eventosRN = $this->get('eventos_rn');
        $calendarioRN = $this->get('calendario_rn');
        
        #Recuperando o eventos
        $eventos   = $eventosRN->eventosAllByMedicos($idMedico['data'], "1");
        #Recuperando o calendário do médico
        $calendario   = $calendarioRN->findByMedico($idMedico['data']);
        
        #Array de resposta
        $arrayResult  = array();
        $count        = 0;
        
        foreach($eventos as $evento) {
            $arrayResult[$count]['title']  = $evento->getTitle();
            $arrayResult[$count]['date_start']  = $evento->getStart()->format("Y-m-d");
            $arrayResult[$count]['id']          = $evento->getIdAgendamento()->getCalendarioCalendario()->getIdCalendario();
            $count++;
        }
        
        foreach($calendario as $dia) {
            $arrayResult[$count]['date_start']  = $dia->getDiaCalendario()->format("Y-m-d");
            $arrayResult[$count]['overlap']     = false;
            $arrayResult[$count]['rendering']   = "background";
            $arrayResult[$count]['color']       = "#ff9f89";
            $arrayResult[$count]['id']          = $dia->getIdCalendario();
            $count++;
        }        
        
        #Responsta Json
        return new JsonResponse($arrayResult);      
    }
    
    /**
     * @Route("/validarDiaMedico", name="validarDiaMedico")
     */
    public function validarDiaMedicoAction(Request $request) {
        
        $idMedico   = $request->request->get('idMedico');
        $data       = $request->request->get('data');
        $msg     = "";
        
        $calendarioRN       = $this->get("calendario_rn");
        $result             = $calendarioRN->validarDiaMedico($idMedico, $data);
        //var_dump($result);exit();
        
        if ($result) {
            $msg = 'sucesso';
        } else {
            $msg = 'erro';
        }
        
        $dados = array (
            'msg'    => $msg
        );
        
        return new JsonResponse($dados);
    }
    
    /**
     * @Route("/getCalendarioByDate", name="getCalendarioByDate")
     * @Template()
     */
    public function getCalendarioByDateAction(Request $request)
    {
        #Array de reposta
        $arrayResult = new \ArrayObject();
        
        #Recuperando a data e o id do médico do parametro
        $date     = $request->request->get("date");
        $idMedico = $request->request->get("idMedico");
        
        #Recuperando o serviço do container
        $calendarioRN = $this->get('calendario_rn');
        
        #Transformado em um DateTime
        $newDate = \DateTime::createFromFormat("Y-m-d", $date);
        
        #Recuperando o calendário
        $result = $calendarioRN->findByDateAndIdMedico($newDate, $idMedico);
        
        #Verifica o resultado e retorna
        if($result) {
            $arrayResult->offsetSet("qtdTotalCalendario", $result->getQtdTotalCalendario());
            $arrayResult->offsetSet("qtdReservaCalendario", $result->getQtdReservaCalendario());
            $arrayResult->offsetSet("diaCalendario", $result->getDiaCalendario()->format("d/m/Y"));
            $arrayResult->offsetSet("hour", $result->getHorarioCalendario()->format("H"));
            $arrayResult->offsetSet("minute", $result->getHorarioCalendario()->format("i"));
            $arrayResult->offsetSet("localidade", $result->getLocalidadeLocalidade()->getNomeLocalidade());
            $arrayResult->offsetSet("statusCalendar", $result->getStatusCalendario());
              
        }
        
        #Retorno
        return new JsonResponse($arrayResult->getArrayCopy());
    }
    
//    /**
//     * 
//     * @param type $idMedico
//     * @param \Serbinario\Bundle\SaudeBundle\Entity\Calendario $calendario
//     * @return type
//     */
//    private function editCalendar($idMedico, \Serbinario\Bundle\SaudeBundle\Entity\Calendario $calendario)
//    {
//        #Recuperando o serviço do container
//        $calendarioRN = $this->get('calendario_rn');
//        
//        #Recuperando o calendário do banco
//        $objCalendario = $calendarioRN->findByDateAndIdMedico($calendario->getDiaCalendario(), $idMedico);
//        $objCalendario->setDiaCalendario($calendario->getDiaCalendario());
//        $objCalendario->setHorarioCalendario($calendario->getHorarioCalendario());
//        $objCalendario->setLocalidadeLocalidade($calendario->getLocalidadeLocalidade());
//        $objCalendario->setQtdTotalCalendario($calendario->getQtdTotalCalendario());
//        $objCalendario->setQtdReservaCalendario($calendario->getQtdReservaCalendario());        
//        
//        #Alterando
//        $result     = $calendarioRN->update($objCalendario);
//        
//        #Retorno
//        return $result;
//    }
//    
    /**
     * @Route("/deleteCalendar/{date}/{idMedico}", name="deleteCalendar")
     * @Template()
     */
    public function deleteCalendarAction($date, $idMedico)
    {
        #Recuperando o serviço do container
        $calendarioRN  = $this->get('calendario_rn');
        
        #transformando a data em um objeto DateTime
        $objDateTime   = \DateTime::createFromFormat("Y-m-d", $date);
        #Recuperando o calendário do banco
        $objCalendario = $calendarioRN->findByDateAndIdMedico($objDateTime, $idMedico);
        
        #Excluindo
        $result        = $calendarioRN->remove($objCalendario);
      
        #Mensagem de retorno
        if($result) {
            #Messagem de retorno
            $this->get('session')->getFlashBag()->add('success', 'Calendário deletado com sucesso.'); 
        } else {
            #Messagem de retorno
            $this->get('session')->getFlashBag()->add('danger', 'Erro ao deletar calendário');
        }
        
        #Retorno
        return $this->redirectToRoute("agendaMedico", array("id" => $idMedico));
    }
    
    /**
     * @Route("/editQtdCalendarios/{id}", name="editQtdCalendarios")
     * @Template()
     */
    public function editQtdCalendariosAction(Request $request, $id)
    {
        $valores = $request->request->get("valores");
        
        $calendarioRN = $this->get('calendario_rn');
        $calendario   = $calendarioRN->findId($id);       
        
        $count = 0;
        foreach ($calendario->getQtdCalendarios() as $qtd) {
            $qtd->setQtdCalendario($valores[$count]);
            
            $count++;
        }
        
        $result = $calendarioRN->update($calendario);
        
        if($result) {
            #Messagem de retorno
            $this->get('session')->getFlashBag()->add('success', 'Dados cadastrados com sucesso'); 
        } else {
            #Messagem de retorno
            $this->get('session')->getFlashBag()->add('danger', 'Erro ao cadastrar dados');
        }
        
        #Retorno
        return new JsonResponse(true);
    }
    
//    /**
//     * 
//     * @param type $idMedico
//     * @param \Serbinario\Bundle\SaudeBundle\Entity\Calendario $calendario
//     * @return type
//     */
//    private function blockCalendar($idMedico, \Serbinario\Bundle\SaudeBundle\Entity\Calendario $calendario)
//    {
//        #Recuperando o serviço do container
//        $calendarioRN = $this->get('calendario_rn');
//        
//        #Recuperando o calendário do banco
//        $objCalendario = $calendarioRN->findByDateAndIdMedico($calendario->getDiaCalendario(), $idMedico);
//        $objCalendario->setStatusCalendario($objCalendario->getStatusCalendario() ? false : true);        
//        
//        #Alterando
//        $result = $calendarioRN->update($objCalendario);
//        
//        #Retorno
//        return $result;
//    }
//    
    /**
     * @Route("/savePaciente", name="savePaciente")
     * @Template("SaudeBundle:Agenda:agendamento.html.twig")
     */
    public function salvarPacienteAction(Request $request)
    {
        $dados = $request->request->all();
        
        $nome       = isset($dados['nome']) ? $dados['nome'] : "";
        $idMedico   = isset($dados['idMedico']) ? $dados['idMedico'] : "";
        $dataString = isset($dados['data']) ? $dados['data'] : "";
        
        if(!$nome || !$idMedico || !$dataString) {
            $this->addFlash("warning", "Deve ser informado o nome do paciente para agendamento");
            return  $this->redirect($this->generateUrl("agendamentoByMedico", array("id" => $idMedico)));
        }
        
        //Convertendo data para um objeto DateTime
        $data = \DateTime::createFromFormat('Y-m-d', $dataString);
        
        //Serviços RN
        $pacienteRN     = $this->get('paciente_rn');
        $calendarioRN   = $this->get('calendario_rn');
        $eventosRN      = $this->get('eventos_rn');
        $agendamentoRN  = $this->get('agendamento_rn');
        
        //Recuperando o dia do calendário do médico para agendamento
        $calendario = $calendarioRN->validarDiaMedico($idMedico, $dados['data']);
        
        //Recuperando o usuário
        $maneger = $this->getDoctrine()->getManager();
        $user    = $this->get('security.token_storage')->getToken()->getUser();
        //$usuario = $maneger->getRepository("\Serbinario\Bundle\SaudeBundle\Entity\Usuarios")->find($user->getId());
       
        //Persistindo paciente
        $paciente       = new \Serbinario\Bundle\SaudeBundle\Entity\Paciente();
        $paciente->setNomePaciente($nome);
        $pacienteObj    = $pacienteRN->save($paciente);
        
        //Persistindo agendamento
        $agendamento = new \Serbinario\Bundle\SaudeBundle\Entity\Agendamento();
        $agendamento->setCalendarioCalendario($calendario[0]);
        $agendamento->setPacientePaciente($pacienteObj);
        $agendamento->setUsuariosUsuarios($user);
        $agendamento->setObservacaoAgendamento("nenhuma");
        $agendamentoObj = $agendamentoRN->save($agendamento);
        
        //Persistindo evento
        $evento = new \Serbinario\Bundle\SaudeBundle\Entity\Eventos();
        $evento->setIdAgendamento($agendamentoObj);
        $evento->setStart($data);
        $evento->setTitle($nome);
        $eventoObj = $eventosRN->save($evento);
        
        if($pacienteObj && $agendamentoObj && $eventoObj) {
            $this->addFlash("success", "Consulta agendada com sucesso para o paciente: {$nome}!");
        } else {
            $this->addFlash("danger", "Erro ao realizar o agendamento, tente novamente!");
        }
        
        return  $this->redirect($this->generateUrl("agendamentoByMedico", array("id" => $idMedico)));
    }
}