<?php

namespace Serbinario\Bundle\SecurityBundle\DAO;

use Serbinario\Bundle\SecurityBundle\Entity\User;
use Doctrine\ORM\EntityManager;

/**
 * Description of UserDAO
 *
 * @author serbinario
 */
class UserDAO 
{
    /**
     *
     * @var type 
     */
    private $manager;
    
    /**
     * 
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager) 
    {
        $this->manager = $manager;
    }
    
    /**
     * 
     * @param User $entity
     * @return User|boolean
     */
    public function save(User $entity)
    {
        try {
            $this->manager->persist($entity);
            $this->manager->flush();
            
            return $entity;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    /**
     * 
     * @param User $entity
     * @return User|boolean
     */
    public function update(User $entity)
    {
        try {
            $this->manager->merge($entity);
            $this->manager->flush();
            
            return $entity;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function find($id)
    {
        try {
           $objResult = $this->manager->getRepository("SerBinarioSecurityBundle:User")->find($id);
           
           return $objResult;
        } catch (Exception $ex) {
            return null;
        }
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        try {
           $arrayResult = $this->manager->getRepository("SerBinarioSecurityBundle:User")->findAll();
           
           return $arrayResult;
        } catch (Exception $ex) {
            return null;
        }
    }
}
