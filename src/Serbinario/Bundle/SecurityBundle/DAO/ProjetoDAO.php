<?php

namespace Serbinario\Bundle\SecurityBundle\DAO;

use Doctrine\ORM\EntityManager;
use Serbinario\Bundle\SecurityBundle\Entity\Projeto;

/**
 * Description of ProjetoDAO
 *
 * @author serbinario
 */
class ProjetoDAO 
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
     * @param Projeto $entity
     * @return Projeto|boolean
     */
    public function save(Projeto $entity)
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
     * @param Projeto $entity
     * @return Projeto|boolean
     */
    public function update(Projeto $entity)
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
           $objResult = $this->manager->getRepository("SerBinarioSecurityBundle:Projeto")->find($id);
           
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
           $arrayResult = $this->manager->getRepository("SerBinarioSecurityBundle:Projeto")->findAll();
           
           return $arrayResult;
        } catch (Exception $ex) {
            return null;
        }
    }
}
