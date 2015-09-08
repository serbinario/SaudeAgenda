<?php
namespace Serbinario\Bundle\SaudeBundle\DAO;

use Doctrine\ORM\EntityManager;
use Serbinario\Bundle\SaudeBundle\Entity\Medico;
/**
 * Description of MedicoDAO
 *
 * @author fabio
 */
class MedicoDAO
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
     * @param Medico $entity
     * @return Medico|boolean
     */
    public function save(Medico $entity)
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
     * @param Medico $entity
     * @return Medico|boolean
     */
    public function update(Medico $entity)
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
     * @param Medico $entity
     * @return Medico|boolean
     */
    public function remove(Medico $entity)
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
            $arrayObj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Medico')->findAll();
            
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
            $obj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Medico')->find($id);
            
            return $obj;
        } catch (Exception $ex) {
            return null;
        } 
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findByEspecialidade($id)
    {
       try {
            $obj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Medico')->findBy(array('especialidadeEspecialidade' => $id));
            
            return $obj;
        } catch (Exception $ex) {
            return null;
        } 
    }
}
