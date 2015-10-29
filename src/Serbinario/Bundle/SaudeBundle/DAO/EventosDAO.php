<?php
namespace Serbinario\Bundle\SaudeBundle\DAO;

use Doctrine\ORM\EntityManager;
use Serbinario\Bundle\SaudeBundle\Entity\Eventos;

/**
 * Description of EventosDAO
 *
 * @author serbinario
 */
class EventosDAO 
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
     * @param Eventos $entity
     * @return Eventos|boolean
     */
    public function save(Eventos $entity)
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
     * @param Eventos $entity
     * @return Eventos|boolean
     */
    public function update(Eventos $entity)
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
     * @param Eventos $entity
     * @return Eventos|boolean
     */
    public function remove(Eventos $entity)
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
            $arrayObj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Eventos')->findAll();
            
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
            $obj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Eventos')->find($id);
            
            return $obj;
        } catch (Exception $ex) {
            return null;
        } 
    }
    
    /**
     * 
     * @param type $idM
     * @param type $idU
     * @return type
     */
    public function eventosAllByMedicos($idM, $idU)
    {
        try {
            $arrayObj = $this->manager->createQuery("SELECT e FROM Serbinario\Bundle\SaudeBundle\Entity\Eventos e "
                    . "JOIN e.idAgendamento a "
                    . "JOIN a.calendarioCalendario c "
                    . "JOIN c.medicoMedico m "
                    . "JOIN a.usuariosUsuarios u "
                    . "WHERE m.idMedico = ?1 AND u.id = ?2")
                    ->setParameter("1", $idM)
                    ->setParameter("2", $idU);
            
            return $arrayObj->getResult();
        } catch (Exception $ex) {
            return null;
        }
    }
}
