<?php
namespace Serbinario\Bundle\SaudeBundle\RN;

use Serbinario\Bundle\SaudeBundle\DAO\CalendarioDAO;
use Serbinario\Bundle\SaudeBundle\Entity\Calendario;

/**
 * Description of CalendarioRN
 *
 * @author serbinario
 */
class CalendarioRN 
{
    /**
     *
     * @var type 
     */
    private $calendarioDAO;
    
    /**
     * 
     * @param CalendarioDAO $calendarioDAO
     */
    public function __construct(CalendarioDAO $calendarioDAO) 
    {
        $this->calendarioDAO = $calendarioDAO;
    }
    
    /**
     * 
     * @param Calendario $calendario
     * @return type
     */
    public function save(Calendario $calendario)
    {
        $result = $this->calendarioDAO->save($calendario);
        
        return $result;
    }
    
    /**
     * 
     * @param Calendario $calendario
     * @return type
     */
    public function remove(Calendario $calendario)
    {
        $result = $this->calendarioDAO->remove($calendario);
        
        return $result;
    }
    
    /**
     * 
     * @param Calendario $calendario
     * @return type
     */
    public function update(Calendario $calendario)
    {
        $result = $this->calendarioDAO->update($calendario);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->calendarioDAO->all();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findId($id)
    {
        $result = $this->calendarioDAO->findId($id);
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findByMedico($id)
    {
         $result = $this->calendarioDAO->findByMedico($id);
        
        return $result;
    }
    
    /**
     * 
     * @param type $date
     * @return type
     */
    public function findByDate($date)
    {
         $result = $this->calendarioDAO->findByDate($date);
        
        return $result;
    }
    
    /**
     * 
     * @param type $date
     * @return type
     */
    public function findByDateAndIdMedico($date, $idMedico)
    {
         $result = $this->calendarioDAO->findByDateAndIdMedico($date, $idMedico);
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @param type $data
     * @return type
     */
    public function validarDiaMedico($id, $data)
    {
         $result = $this->calendarioDAO->validarDiaMedico($id, $data);
        
        return $result;
    }
   
}
