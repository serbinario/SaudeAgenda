<?php
namespace Serbinario\Bundle\SaudeBundle\DAO;

use Doctrine\ORM\EntityManager;
use Serbinario\Bundle\SaudeBundle\Entity\Especialidade;
/**
 * Description of EspecialidadeDAO
 *
 * @author fabio
 */
class EspecialidadeDAO
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
     * @param Especialidade $entity
     * @return Especialidade|boolean
     */
    public function save(Especialidade $entity)
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
     * @param Especialidade $entity
     * @return Especialidade|boolean
     */
    public function update(Especialidade $entity)
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
     * @param Especialidade $entity
     * @return Especialidade|boolean
     */
    public function remove(Especialidade $entity)
    {
        try {
            $this->manager->remove($entity);
            $this->manager->flush();
            
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        try {
            $arrayObj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Especialidade')->findAll();
            
            return $arrayObj;
        } catch (Exception $ex) {
            return null;
        }
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findId($id)
    {
       try {
            $obj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Especialidade')->find($id);
            
            return $obj;
        } catch (Exception $ex) {
            return null;
        } 
    }
}
