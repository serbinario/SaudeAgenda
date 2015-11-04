<?php
namespace Serbinario\Bundle\SaudeBundle\DAO;

use Doctrine\ORM\EntityManager;
use Serbinario\Bundle\SaudeBundle\Entity\Psf;
/**
 * Description of PsfDAO
 *
 * @author fabio
 */
class PsfDAO
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
     * @param Psf $entity
     * @return Psf|boolean
     */
    public function save(Psf $entity)
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
     * @param Psf $entity
     * @return Psf|boolean
     */
    public function update(Psf $entity)
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
     * @param Psf $entity
     * @return Psf|boolean
     */
    public function remove(Psf $entity)
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
            $arrayObj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Psf')->findAll();
            
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
            $obj = $this->manager->getRepository('Serbinario\Bundle\SaudeBundle\Entity\Psf')->find($id);
            
            return $obj;
        } catch (Exception $ex) {
            return null;
        } 
    }
    
    /**
     * 
     * @param type $id
     */
    public function deleleNotId($idPsf, $id = array())
    {
        try {
            $qb = $this-> manager->createQueryBuilder();
            $qb->select('a');
            $qb->from('SaudeBundle:QtdDefault', 'a');
            $qb->join("a.psf", "b");
            
            if($id) {
               $qb->where($qb->expr()->notIn("a.idQtdDefault", $id)); 
            }
            
            $qb->andWhere($qb->expr()->eq("b.idPsf", $idPsf));
            
            $arrayResult = $qb->getQuery()->getResult();
            
            $this->manager->beginTransaction();
            foreach($arrayResult as $result) {
                $this->manager->remove($result);
                $this->manager->flush();
            }            
            $this->manager->commit();
            
            return true;
        } catch (Exception $ex) {
            $this->manager->rollback();
            return false;
        }
    }
}
