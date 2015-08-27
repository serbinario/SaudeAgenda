<?php
namespace Serbinario\Bundle\SaudeBundle\RN;

use Serbinario\Bundle\SaudeBundle\DAO\MedicoDAO;
use Serbinario\Bundle\SaudeBundle\Entity\Medico;
/**
 * Description of MedicoRN
 *
 * @author andrey
 */
class MedicoRN 
{
    /**
     *
     * @var type 
     */
    private $medicoDAO;
    
    /**
     * 
     * @param MedicoDAO $medicoDAO
     */
    public function __construct(MedicoDAO $medicoDAO) 
    {
        $this->medicoDAO = $medicoDAO;
    }
    
    /**
     * 
     * @param Medico $medico
     * @return type
     */
    public function save(Medico $medico)
    {
        $result = $this->medicoDAO->save($medico);
        
        return $result;
    }
    
    /**
     * 
     * @param Medico $medico
     * @return type
     */
    public function remove(Medico $medico)
    {
        $result = $this->medicoDAO->remove($medico);
        
        return $result;
    }
    
    /**
     * 
     * @param Medico $medico
     * @return type
     */
    public function update(Medico $medico)
    {
        $result = $this->medicoDAO->update($medico);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->medicoDAO->all();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findId($id)
    {
        $result = $this->medicoDAO->findId($id);
        
        return $result;
    }
}
