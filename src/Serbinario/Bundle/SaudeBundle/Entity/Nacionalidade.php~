<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nacionalidade
 *
 * @ORM\Table(name="nacionalidade")
 * @ORM\Entity
 */
class Nacionalidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_nacionalidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNacionalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidade", type="string", length=30, nullable=true)
     */
    private $nacionalidade;
    
    /**
     * 
     * @return type
     */
    function getIdNacionalidade() {
        return $this->idNacionalidade;
    }
    
    /**
     * 
     * @return type
     */
    function getNacionalidade() {
        return $this->nacionalidade;
    }
    
    /**
     * 
     * @param type $idNacionalidade
     */
    function setIdNacionalidade($idNacionalidade) {
        $this->idNacionalidade = $idNacionalidade;
    }
    
    /**
     * 
     * @param type $nacionalidade
     */
    function setNacionalidade($nacionalidade) {
        $this->nacionalidade = $nacionalidade;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() {
        return $this->nacionalidade;
    }
}
