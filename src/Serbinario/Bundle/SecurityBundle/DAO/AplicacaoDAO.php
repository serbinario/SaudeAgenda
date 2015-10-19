<?php

namespace Serbinario\Bundle\SecurityBundle\DAO;

use Serbinario\Bundle\SecurityBundle\Entity\Aplicacao;
use Doctrine\ORM\EntityManager;

/**
 * Description of AplicacaoDAO
 *
 * @author serbinario
 */
class AplicacaoDAO 
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
     * @param Aplicacao $entity
     * @return Aplicacao|boolean
     */
    public function save(Aplicacao $entity)
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
     * @param Aplicacao $entity
     * @return Aplicacao|boolean
     */
    public function update(Aplicacao $entity)
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
           $objResult = $this->manager->getRepository("SerBinarioSecurityBundle:Aplicacao")->find($id);
           
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
           $arrayResult = $this->manager->getRepository("SerBinarioSecurityBundle:Aplicacao")->findAll();
           
           return $arrayResult;
        } catch (Exception $ex) {
            return null;
        }
    }
}
