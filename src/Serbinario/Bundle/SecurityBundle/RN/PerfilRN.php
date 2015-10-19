<?php

namespace Serbinario\Bundle\SecurityBundle\RN;

use Serbinario\Bundle\SecurityBundle\DAO\PerfilDAO;
use Serbinario\Bundle\SecurityBundle\Entity\Perfil;

/**
 * Description of PerfilRN
 *
 * @author serbinario
 */
class PerfilRN 
{
   /**
     *
     * @var type 
     */
    private $cbo;
    
    /**
     * 
     * @param PerfilDAO $cbo
     */
    public function __construct(PerfilDAO $cbo) 
    {
        $this->cbo = $cbo;
    }
    
    /**
     * 
     * @param Perfil $entity
     * @return type
     */
    public function save(Perfil $entity)
    {
        $result = $this->cbo->save($entity);
        
        return $result;
    }
    
    /**
     * 
     * @param Perfil $entity
     * @return type
     */
    public function update(Perfil $entity)
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
