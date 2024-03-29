<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoCivil
 *
 * @ORM\Table(name="estado_civil")
 * @ORM\Entity
 */
class EstadoCivil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_estado_civil", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_civil", type="string", length=45, nullable=true)
     */
    private $estadoCivil;

    /**
     * Get idEstadoCivil
     *
     * @return integer 
     */
    public function getIdEstadoCivil()
    {
        return $this->idEstadoCivil;
    }

    /**
     * Set estadoCivil
     *
     * @param string $estadoCivil
     * @return EstadoCivil
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return string 
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }
    
    public function __toString() {
        return $this->estadoCivil;
    }
}
