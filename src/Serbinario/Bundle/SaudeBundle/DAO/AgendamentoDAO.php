<?php
namespace Serbinario\Bundle\SaudeBundle\DAO;

use Doctrine\ORM\EntityManager;
use Serbinario\Bundle\SaudeBundle\Entity\Agendamento;
/**
 * Description of AgendamentoDAO
 *
 * @author fabio
 */
class AgendamentoDAO
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
     * @param Agendamento $entity
     * @return Agendamento|boolean
     */
    public function save(Agendamento $entity)
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
     * @param Agendamento $entity
     * @return Agendamento|boolean
     */
    public function update(Agendamento $entity)
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
     * @param Agendamento $entity
     * @return Agendamento|boolean
     */
    public function remove(Agendamento $entity)
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
            $arrayObj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Agendamento')->findAll();
            
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
            $obj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Agendamento')->find($id);
            
            return $obj;
        } catch (Exception $ex) {
            return null;
        } 
    }
    
     /**
      * 
      * @param type $date
      * @param type $idMedico
      * @param type $idPaciente
      * @return type
      */
    public function findByDateAndMedicoAndPaciente($date, $idMedico, $idPaciente)
    {
       try {
           $qb     = $this->manager->createQueryBuilder();
           $result = $qb->select("a")
                    ->from("Serbinario\Bundle\SaudeBundle\Entity\Agendamento", "a")
                    ->join("a.calendarioCalendario", "b")
                    ->join("b.medicoMedico", "c")
                    ->join("a.pacientePaciente", "d")
                    ->where("c.idMedico = :id")
                    ->andWhere("b.diaCalendario = :date")
                    ->andWhere("d.idCGM =:idPaciente ")
                    ->setParameter("id", $idMedico)
                    ->setParameter("date", $date->format("Y-m-d"))
                    ->setParameter("idPaciente", $idPaciente)
                    ->getQuery()
                    ->getResult();
        
            return $result ? $result[0] : null;     
        } catch (Exception $ex) {
            return null;
        } 
    }
    
    /**
     * 
     * @param type $date
     * @param type $idMedico
     * @param type $idPsf
     * @return type
     */
    public function findByDateAndMedicoAndPsf($date, $idMedico, $idPsf)
    {
       try {
           $qb     = $this->manager->createQueryBuilder();
           $result = $qb->select("count(a)")
                    ->from("Serbinario\Bundle\SaudeBundle\Entity\Agendamento", "a")
                    ->join("a.calendarioCalendario", "b")
                    ->join("b.medicoMedico", "c")
                    ->join("a.usuariosUsuarios", "d")
                    ->join("d.psfPsf", "e")
                    ->where("c.idMedico = :id")
                    ->andWhere("b.diaCalendario = :date")
                    ->andWhere("e.idPsf =:idPsf ")
                    ->andWhere("a.statusAgendamento = true")
                    ->setParameter("id", $idMedico)
                    ->setParameter("date", $date)
                    ->setParameter("idPsf", $idPsf)
                    ->getQuery()
                    ->getOneOrNullResult();
        
            return $result;     
        } catch (Exception $ex) {
            return null;
        } 
    }
    
    /**
     * 
     * @param type $date
     * @return type
     */
    public function findByDateOfCalendar($date)
    {
       try {
           $qb     = $this->manager->createQueryBuilder();
           $result = $qb->select("a")
                    ->from("Serbinario\Bundle\SaudeBundle\Entity\Agendamento", "a")
                    ->join("a.calendarioCalendario", "b")                    
                    ->where("b.diaCalendario = :date")             
                    ->setParameter("date", $date->format("Y-m-d"))                    
                    ->getQuery()
                    ->getResult();
        
            return $result ? $result[0] : null;     
        } catch (Exception $ex) {
            return null;
        } 
    }
}
