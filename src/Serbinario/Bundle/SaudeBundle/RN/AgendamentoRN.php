<?php
namespace Serbinario\Bundle\SaudeBundle\RN;

use Serbinario\Bundle\SaudeBundle\DAO\AgendamentoDAO;
use Serbinario\Bundle\SaudeBundle\Entity\Agendamento;
/**
 * Description of AgendamentoRN
 *
 * @author andrey
 */
class AgendamentoRN 
{
    /**
     *
     * @var type 
     */
    private $agendamentoDAO;
    
    /**
     * 
     * @param AgendamentoDAO $agendamentoDAO
     */
    public function __construct(AgendamentoDAO $agendamentoDAO) 
    {
        $this->agendamentoDAO = $agendamentoDAO;
    }
    
    /**
     * 
     * @param Agendamento $agendamento
     * @return type
     */
    public function save(Agendamento $agendamento)
    {
        $result = $this->agendamentoDAO->save($agendamento);
        
        return $result;
    }
    
    /**
     * 
     * @param Agendamento $agendamento
     * @return type
     */
    public function remove(Agendamento $agendamento)
    {
        $result = $this->agendamentoDAO->remove($agendamento);
        
        return $result;
    }
    
    /**
     * 
     * @param Agendamento $agendamento
     * @return type
     */
    public function update(Agendamento $agendamento)
    {
        $result = $this->agendamentoDAO->update($agendamento);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->agendamentoDAO->all();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findId($id)
    {
        $result = $this->agendamentoDAO->findId($id);
        
        return $result;
    }
    
    /**
     * 
     * @param type $date
     * @param type $idMedico
     * @param type $idPaciente
     * @return type
     */
    public function findByDateAndMedicoAndPaciente($date, $idMedico, $idPaciente)
    {
        $result = $this->agendamentoDAO->findByDateAndMedicoAndPaciente($date, $idMedico, $idPaciente);
        
        return $result;
    }
    
    /**
     * 
     * @param type $date
     * @param type $idMedico
     * @param type $idPsf
     * @return type
     */
    public function findByDateAndMedicoAndPsf($date, $idMedico, $idPsf)
    {
        $result = $this->agendamentoDAO->findByDateAndMedicoAndPsf($date, $idMedico, $idPsf);
        
        return $result;
    }
}
