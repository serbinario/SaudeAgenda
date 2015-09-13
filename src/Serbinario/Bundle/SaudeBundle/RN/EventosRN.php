<?php
namespace Serbinario\Bundle\SaudeBundle\RN;

use Serbinario\Bundle\SaudeBundle\DAO\EventosDAO;
use Serbinario\Bundle\SaudeBundle\Entity\Eventos;


/**
 * Description of EventosRN
 *
 * @author serbinario
 */
class EventosRN 
{
    /**
     *
     * @var type 
     */
    private $eventosDAO;
    
    /**
     * 
     * @param EventosDAO $eventosDAO
     */
    public function __construct(EventosDAO $eventosDAO) 
    {
        $this->eventosDAO = $eventosDAO;
    }
    
    /**
     * 
     * @param Eventos $eventos
     * @return type
     */
    public function save(Eventos $eventos)
    {
        $result = $this->eventosDAO->save($eventos);
        
        return $result;
    }
    
    /**
     * 
     * @param Eventos $eventos
     * @return type
     */
    public function remove(Eventos $eventos)
    {
        $result = $this->eventosDAO->remove($eventos);
        
        return $result;
    }
    
    /**
     * 
     * @param Eventos $eventos
     * @return type
     */
    public function update(Eventos $eventos)
    {
        $result = $this->eventosDAO->update($eventos);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->eventosDAO->all();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findId($id)
    {
        $result = $this->eventosDAO->findId($id);
        
        return $result;
    }//put your code here
}
