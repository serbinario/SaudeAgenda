<?php

namespace Serbinario\Bundle\SecurityBundle\DAO;

use Serbinario\Bundle\SecurityBundle\Entity\Permissao;
use Doctrine\ORM\EntityManager;

/**
 * Description of PermissaoDAO
 *
 * @author serbinario
 */
class PermissaoDAO 
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
     * @param Permissao $entity
     * @return Permissao|boolean
     */
    public function save(Permissao $entity)
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
     * @param Permissao $entity
     * @return Permissao|boolean
     */
    public function update(Permissao $entity)
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
           $objResult = $this->manager->getRepository("SerBinarioSecurityBundle:Permissao")->find($id);
           
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
           $arrayResult = $this->manager->getRepository("SerBinarioSecurityBundle:Permissao")->findAll();
           
           return $arrayResult;
        } catch (Exception $ex) {
            return null;
        }
    }       
}
