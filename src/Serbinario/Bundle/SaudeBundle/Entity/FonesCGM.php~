<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonesCGM
 *
 * @ORM\Table(name="fones_cgm")
 * @ORM\Entity
 */
class FonesCGM
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_fones_cgm", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFonesCGM;

    /**
     * @var string
     *
     * @ORM\Column(name="fone_cgm", type="string", length=30, nullable=true)
     */
    private $foneCGM;

    /**
     * @var \CGM
     *
     * @ORM\ManyToOne(targetEntity="CGM", inversedBy="telefones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cgm", referencedColumnName="id_cgm")
     * })
     */
    private $cgm;
    
    /**
     * 
     * @return type
     */
    function getIdFonesCGM() {
        return $this->idFonesCGM;
    }
    
    /**
     * 
     * @return type
     */
    function getFoneCGM() {
        return $this->foneCGM;
    }
    
    /**
     * 
     * @return type
     */
    function getCgm() {
        return $this->cgm;
    }
    
    /**
     * 
     * @param type $idFonesCGM
     */
    function setIdFonesCGM($idFonesCGM) {
        $this->idFonesCGM = $idFonesCGM;
    }
    
    /**
     * 
     * @param type $foneCGM
     */
    function setFoneCGM($foneCGM) {
        $this->foneCGM = $foneCGM;
    }
    
    /**
     * 
     * @param \CGM $cgm
     */
    function setCgm($cgm) {
        $this->cgm = $cgm;
    }

}
