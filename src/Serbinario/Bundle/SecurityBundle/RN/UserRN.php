<?php

namespace Serbinario\Bundle\SecurityBundle\RN;

use Serbinario\Bundle\SecurityBundle\Entity\User;
use Serbinario\Bundle\SecurityBundle\DAO\UserDAO;

/**
 * Description of UserRN
 *
 * @author serbinario
 */
class UserRN 
{
    /**
     *
     * @var type 
     */
    private $cbo;
    
    /**
     * 
     * @param UserDAO $cbo
     */
    public function __construct(UserDAO $cbo) 
    {
        $this->cbo = $cbo;
    }
    
    /**
     * 
     * @param User $entity
     * @return type
     */
    public function save(User $entity)
    {
        $result = $this->cbo->save($entity);
        
        return $result;
    }
    
    /**
     * 
     * @param User $entity
     * @return type
     */
    public function update(User $entity)
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
