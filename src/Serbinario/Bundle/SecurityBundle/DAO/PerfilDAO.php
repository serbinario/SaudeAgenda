<?php

namespace Serbinario\Bundle\SecurityBundle\DAO;

use Doctrine\ORM\EntityManager;
use Serbinario\Bundle\SecurityBundle\Entity\Perfil;

/**
 * Description of PerfilDAO
 *
 * @author serbinario
 */
class PerfilDAO 
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
     * @param Perfil $entity
     * @return Perfil|boolean
     */
    public function save(Perfil $entity)
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
     * @param Perfil $entity
     * @return Perfil|boolean
     */
    public function update(Perfil $entity)
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
           $objResult = $this->manager->getRepository("SerBinarioSecurityBundle:Perfil")->find($id);
           
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
           $arrayResult = $this->manager->getRepository("SerBinarioSecurityBundle:Perfil")->findAll();
           
           return $arrayResult;
        } catch (Exception $ex) {
            return null;
        }
    }       
}