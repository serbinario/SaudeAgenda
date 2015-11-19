<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CGMMunicipio
 *
 * @ORM\Table(name="cgmmunicipio")
 * @ORM\Entity
 */
class CGMMunicipio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cgmmunicipio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCGMMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="cgmmunicipio", type="string", length=10, nullable=true)
     */
    private $CGMMunicipio;
    
    /**
     * 
     * @return type
     */
    function getIdCGMMunicipio() {
        return $this->idCGMMunicipio;
    }
    
    /**
     * 
     * @return type
     */
    function getCGMMunicipio() {
        return $this->CGMMunicipio;
    }
    
    /**
     * 
     * @param type $idCGMMunicipio
     */
    function setIdCGMMunicipio($idCGMMunicipio) {
        $this->idCGMMunicipio = $idCGMMunicipio;
    }
    
    /**
     * 
     * @param type $CGMMunicipio
     */
    function setCGMMunicipio($CGMMunicipio) {
        $this->CGMMunicipio = $CGMMunicipio;
    }

    /**
     * 
     * @return type
     */
    public function __toString() {
        return utf8_encode($this->CGMMunicipio);
    }
}
