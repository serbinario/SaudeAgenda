<?php

namespace Serbinario\Bundle\SecurityBundle\RN;

use Symfony\Component\Security\Core\Role\Role;
use Serbinario\Bundle\SecurityBundle\DAO\RoleDAO;

/**
 * Description of RoleRN
 *
 * @author serbinario
 */
class RoleRN 
{
    /**
     *
     * @var type 
     */
    private $cbo;
    
    /**
     * 
     * @param RoleDAO $cbo
     */
    public function __construct(RoleDAO $cbo) 
    {
        $this->cbo = $cbo;
    }
    
    /**
     * 
     * @param Role $entity
     * @return type
     */
    public function save(Role $entity)
    {
        $result = $this->cbo->save($entity);
        
        return $result;
    }
    
    /**
     * 
     * @param Role $entity
     * @return type
     */
    public function update(Role $entity)
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
     * @param type $role
     * @return type
     */
    public function findByRole($role) 
    {
        $result = $this->cbo->findByRole($role);
        
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
