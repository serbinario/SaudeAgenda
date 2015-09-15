<?php
namespace Serbinario\Bundle\SaudeBundle\DAO;

use Doctrine\ORM\EntityManager;
use Serbinario\Bundle\SaudeBundle\Entity\Calendario;

/**
 * Description of CalendarioDAO
 *
 * @author serbinario
 */
class CalendarioDAO 
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
     * @param Calendario $entity
     * @return Calendario|boolean
     */
    public function save(Calendario $entity)
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
     * @param Calendario $entity
     * @return Calendario|boolean
     */
    public function update(Calendario $entity)
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
     * @param Calendario $entity
     * @return Calendario|boolean
     */
    public function remove(Calendario $entity)
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
            $arrayObj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Calendario')->findAll();
            
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
            $obj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Calendario')->find($id);
            
            return $obj;
        } catch (Exception $ex) {
            return null;
        } 
    }
    
   /**
    * 
    * @param type $date
    * @return type
    */
    public function findByDate($date)
    {
       try {
            $obj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Calendario')->findBy(array("diaCalendario" => $date));
            
            return $obj;
        } catch (Exception $ex) {
            return null;
        } 
    }
    
    /**
    * 
    * @param type $date
    * @return type
    */
    public function findByDateAndIdMedico($date, $idMedico)
    {
       try {
           $qb     = $this->manager->createQueryBuilder();
           $result = $qb->select("a")
                    ->from("Serbinario\Bundle\SaudeBundle\Entity\Calendario", "a")
                    ->join("a.medicoMedico", "b")
                    ->where("b.idMedico = :id")
                    ->andWhere("a.diaCalendario = :date")
                    ->setParameter("id", $idMedico)
                    ->setParameter("date", $date->format("Y-m-d"))
                    ->getQuery()
                    ->getResult();
        
            return $result ? $result[0] : null;     
        } catch (Exception $ex) {
            return null;
        } 
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findByMedico($id)
    {
        $qb     = $this->manager->createQueryBuilder();
        $result = $qb->select("a")
                    ->from("Serbinario\Bundle\SaudeBundle\Entity\Calendario", "a")
                    ->join("a.medicoMedico", "b")
                    ->where("b.idMedico = :id")                   
                    ->setParameter("id", $id)                    
                    ->getQuery()
                    ->getResult();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @param type $data
     * @return type
     */
    public function validarDiaMedico($id, $data)
    {
        $qb     = $this->manager->createQueryBuilder();
        $result = $qb->select("a")
                    ->from("Serbinario\Bundle\SaudeBundle\Entity\Calendario", "a")
                    ->join("a.medicoMedico", "b")
                    ->where("b.idMedico = :id AND a.diaCalendario = :data")                   
                    ->setParameter("id", $id)
                    ->setParameter("data", $data)
                    ->getQuery()
                    ->getResult();
        
        return $result;
    }
}
