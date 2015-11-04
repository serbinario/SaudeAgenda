<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Escolaridade
 *
 * @ORM\Table(name="escolaridade")
 * @ORM\Entity
 */
class Escolaridade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_escolaridade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEscolaridade;

    /**
     * @var string
     *
     * @ORM\Column(name="escolaridade", type="string", length=100, nullable=true)
     */
    private $escolaridade;
    
    /**
     * 
     * @return type
     */
    function getIdEscolaridade() {
        return $this->idEscolaridade;
    }
    
    /**
     * 
     * @return type
     */
    function getEscolaridade() {
        return $this->escolaridade;
    }
    
    /**
     * 
     * @param type $idEscolaridade
     */
    function setIdEscolaridade($idEscolaridade) {
        $this->idEscolaridade = $idEscolaridade;
    }
    
    /**
     * 
     * @param type $escolaridade
     */
    function setEscolaridade($escolaridade) {
        $this->escolaridade = $escolaridade;
    }

    /**
     * 
     * @return type
     */
    public function __toString() {
        return $this->escolaridade;
    }
}
