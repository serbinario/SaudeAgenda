<?php

namespace Serbinario\Bundle\SecurityBundle\DAO;

use Serbinario\Bundle\SecurityBundle\Entity\Role;
use Doctrine\ORM\EntityManager;

/**
 * Description of RoleDAO
 *
 * @author serbinario
 */
class RoleDAO 
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
     * @param Role $entity
     * @return Role|boolean
     */
    public function save(Role $entity)
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
     * @param Role $entity
     * @return Role|boolean
     */
    public function update(Role $entity)
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
           $objResult = $this->manager->getRepository("SerBinarioSecurityBundle:Role")->find($id);
           
           return $objResult;
        } catch (Exception $ex) {
            return null;
        }
    }
    
    /**
     * 
     * @param type $role
     * @return type
     */
    public function findByRole($role) 
    {
        try {
           $objResult = $this->manager->getRepository("SerBinarioSecurityBundle:Role")->findBy(array("nomeRole" => $role));
           
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
           $arrayResult = $this->manager->getRepository("Serbinario\BundleSecurityBundle:Role")->findAll();
           
           return $arrayResult;
        } catch (Exception $ex) {
            return null;
        }
    }
}
