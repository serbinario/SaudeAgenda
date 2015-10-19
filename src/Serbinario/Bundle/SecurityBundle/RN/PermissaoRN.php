<?php

namespace Serbinario\Bundle\SecurityBundle\RN;

use Serbinario\Bundle\SecurityBundle\DAO\PermissaoDAO;
use Serbinario\Bundle\SecurityBundle\Entity\Permissao;
/**
 * Description of PermissaoRN
 *
 * @author serbinario
 */
class PermissaoRN 
{
    /**
     *
     * @var type 
     */
    private $cbo;
    
    /**
     * 
     * @param PermissaoDAO $cbo
     */
    public function __construct(PermissaoDAO $cbo) 
    {
        $this->cbo = $cbo;
    }
    
    /**
     * 
     * @param Permissao $entity
     * @return type
     */
    public function save(Permissao $entity)
    {
        $result = $this->cbo->save($entity);
        
        return $result;
    }
    
    /**
     * 
     * @param Permissao $entity
     * @return type
     */
    public function update(Permissao $entity)
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
