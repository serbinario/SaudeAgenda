<?php

namespace Serbinario\Bundle\SecurityBundle\RN;

use Serbinario\Bundle\SecurityBundle\DAO\ProjetoDAO;
use Serbinario\Bundle\SecurityBundle\Entity\Projeto;

/**
 * Description of ProjetoRN
 *
 * @author serbinario
 */
class ProjetoRN 
{
    /**
     *
     * @var type 
     */
    private $cbo;
    
    /**
     * 
     * @param ProjetoDAO $cbo
     */
    public function __construct(ProjetoDAO $cbo) 
    {
        $this->cbo = $cbo;
    }
    
    /**
     * 
     * @param Projeto $entity
     * @return type
     */
    public function save(Projeto $entity)
    {
        $result = $this->cbo->save($entity);
        
        return $result;
    }
    
    /**
     * 
     * @param Projeto $entity
     * @return type
     */
    public function update(Projeto $entity)
    {
        $result = $this->cbo->update($entity);
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function find($id)
    {        
        $result = $this->cbo->find($id);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->cbo->all();
        
        return $result;
    } 
}
