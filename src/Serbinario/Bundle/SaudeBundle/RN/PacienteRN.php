<?php
namespace Serbinario\Bundle\SaudeBundle\RN;

use Serbinario\Bundle\SaudeBundle\DAO\PacienteDAO;
use Serbinario\Bundle\SaudeBundle\Entity\Paciente;
/**
 * Description of PacienteRN
 *
 * @author andrey
 */
class PacienteRN 
{
    /**
     *
     * @var type 
     */
    private $pacienteDAO;
    
    /**
     * 
     * @param PacienteDAO $pacienteDAO
     */
    public function __construct(PacienteDAO $pacienteDAO) 
    {
        $this->pacienteDAO = $pacienteDAO;
    }
    
    /**
     * 
     * @param Paciente $paciente
     * @return type
     */
    public function save(Paciente $paciente)
    {
        $result = $this->pacienteDAO->save($paciente);
        
        return $result;
    }
    
    /**
     * 
     * @param Paciente $paciente
     * @return type
     */
    public function remove(Paciente $paciente)
    {
        $result = $this->pacienteDAO->remove($paciente);
        
        return $result;
    }
    
    /**
     * 
     * @param Paciente $paciente
     * @return type
     */
    public function update(Paciente $paciente)
    {
        $result = $this->pacienteDAO->update($paciente);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->pacienteDAO->all();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findId($id)
    {
        $result = $this->pacienteDAO->findId($id);
        
        return $result;
    }
}
