<?php
namespace Serbinario\Bundle\SaudeBundle\DAO;

use Doctrine\ORM\EntityManager;
use Serbinario\Bundle\SaudeBundle\Entity\CGM;

/**
 * Description of CGMDAO
 *
 * @author fabio
 */
class CGMDAO
{
   /**
    *
    * @var type 
    */
   private $maneger;
   
   /**
    * 
    * @param EntityManager $maneger
    */
   public function __construct(EntityManager $maneger) 
   {
       $this->maneger = $maneger;
   }
   
   /**
    * 
    * @param CGM $cgm
    * @return boolean|CGM
    */
   public function save(CGM $cgm)
   {
       try {
           $this->maneger->persist($cgm);
           $this->maneger->flush();
           
           return $cgm;
       } catch (Exception $ex) {
           return false;
       }
   }
   
   /**
    * 
    * @param CGM $cgm
    * @return boolean|CGM
    */
   public function update(CGM $cgm)
   {
       try {
           $this->maneger->merge($cgm);
           $this->maneger->flush();
           
           return $cgm;
       } catch (Exception $ex) {
           return false;
       }
   }
   
   /**
    * 
    * @param CGM $cgm
    * @return boolean|CGM
    */
   public function remove(CGM $cgm)
   {
       try {
           $this->maneger->remove($cgm);
           $this->maneger->flush();
           
           return $cgm;
       } catch (Exception $ex) {
           return false;
       }
   }
   
   /**
    * 
    * @param type $id
    * @return type
    */
   public function findById($id)
   {
       try {
           $obj = $this->maneger->getRepository("Serbinario\Bundle\SaudeBundle\Entity\CGM")->find($id);
           
           return $obj;
       } catch (Exception $ex) {
           return null;
       }
   }
   
   /**
    * 
    * @return type
    */
   public function findAll()
   {
       try {
           $arrayObj = $this->maneger->getRepository("Serbinario\Bundle\SaudeBundle\Entity\CGM")->findAll();
           
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
    public function ultimoRegistroNumCGM()
    {
        try {
            $obj =  $this->maneger->createQuery("SELECT MAX(u.numCGM) FROM Serbinario\Bundle\SaudeBundle\Entity\CGM u ");
            
            return $obj->getResult();
        } catch (Exception $ex) {
            return null;
        }
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function getCGMAjax($id)
    {
        try {
            $obj =  $this->maneger->createQuery("SELECT c, s.sexo, b.nomeBairro, d.nomeCidade,"
                    . " e.logradouro, e.numero, e.comp, e.cep, cv.estadoCivil FROM Serbinario\Bundle\SaudeBundle\Entity\CGM c "
                    . "JOIN c.endereco e "
                    . "JOIN c.sexoSexo s "
                    . "JOIN e.bairro b "
                    . "JOIN e.cidade d "
                    . "JOIN c.estadoCivil cv "
                    . "WHERE c.idCGM = ?1 ")
                    ->setParameter("1", $id);
            
            return $obj->getArrayResult();
        } catch (Exception $ex) {
            return null;
        }
    }
    
    /**
     * 
     * @param type $cpf
     * @param type $nome
     * @return type
     */
    public function searchCGMCpfNome($cpf, $nome, $tipo)
    {
        try {
           $nome = $nome !== "" ? $nome : "0";
           if ($tipo == 1) {
               
               $arrayObj = $this->maneger->createQuery('SELECT c FROM Serbinario\Bundle\SaudeBundle\Entity\CGM c '
                   . 'WHERE (c.CpfCnpj = :idCpf OR c.nome LIKE :idNome) AND c.idCGM NOT IN ( '
                   . 'SELECT a.idCGM FROM Softage\Bundles\EscolaBundle\Entity\CGM a '
                   . 'JOIN a.aluno b '
                   . 'WHERE a.idCGM = b.cgm )')
                   ->setParameter('idCpf', $cpf)
                   ->setParameter('idNome', $nome.'%');
               
           } else if ($tipo == 2) {
               
               $arrayObj = $this->maneger->createQuery('SELECT c FROM Serbinario\Bundle\SaudeBundle\Entity\CGM c '
                   . 'WHERE (c.CpfCnpj = :idCpf OR c.nome LIKE :idNome) AND c.idCGM NOT IN ( '
                   . 'SELECT a.idCGM FROM Softage\Bundles\EscolaBundle\Entity\CGM a '
                   . 'JOIN a.servidor b '
                   . 'WHERE a.idCGM = b.cgm )')
                   ->setParameter('idCpf', $cpf)
                   ->setParameter('idNome', $nome.'%');
           }
           
           return $arrayObj->getArrayResult();
       } catch (Exception $ex) {
           return null;
       }
    }
}
