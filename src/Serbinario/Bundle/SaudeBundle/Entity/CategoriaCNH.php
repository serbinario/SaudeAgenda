<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaCNH
 *
 * @ORM\Table(name="categoria_cnh")
 * @ORM\Entity
 */
class CategoriaCNH
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ctgcnh", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCtgCNH;

    /**
     * @var string
     *
     * @ORM\Column(name="ctg_cnh", type="string", length=20, nullable=true)
     */
    private $ctgCNH;
    
    /**
     * 
     * @return type
     */
    function getIdCtgCNH() {
        return $this->idCtgCNH;
    }
    
    /**
     * 
     * @return type
     */
    function getCtgCNH() {
        return $this->ctgCNH;
    }
    
    /**
     * 
     * @param type $idCtgCNH
     */
    function setIdCtgCNH($idCtgCNH) {
        $this->idCtgCNH = $idCtgCNH;
    }
    
    /**
     * 
     * @param type $ctgCNH
     */
    function setCtgCNH($ctgCNH) {
        $this->ctgCNH = $ctgCNH;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() {
        return $this->ctgCNH;
    }
}
