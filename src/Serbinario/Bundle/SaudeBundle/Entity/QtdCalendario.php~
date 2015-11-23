<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendario
 *
 * @ORM\Table(name="qtd_calendario")
 * @ORM\Entity
 */
class QtdCalendario 
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_qtd_calendario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQtdCalendario;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd_calendario", type="integer", nullable=false)
     */
    private $qtdCalendario;
    
    /**
     * @var \Calendario
     *
     * @ORM\ManyToOne(targetEntity="Calendario", inversedBy="qtdCalendarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calendario_id", referencedColumnName="id_calendario")
     * })
     */
    private $calendario;
    
    /**
     * @var \Psf
     *
     * @ORM\ManyToOne(targetEntity="Psf", inversedBy="qtdCalendarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="psf_id", referencedColumnName="id_psf")
     * })
     */
    private $psf;
    
    
    
    

    /**
     * Get idQtdCalendario
     *
     * @return integer 
     */
    public function getIdQtdCalendario()
    {
        return $this->idQtdCalendario;
    }

    /**
     * Set qtdCalendario
     *
     * @param integer $qtdCalendario
     * @return QtdCalendario
     */
    public function setQtdCalendario($qtdCalendario)
    {
        $this->qtdCalendario = $qtdCalendario;

        return $this;
    }

    /**
     * Get qtdCalendario
     *
     * @return integer 
     */
    public function getQtdCalendario()
    {
        return $this->qtdCalendario;
    }

    /**
     * Set calendario
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Calendario $calendario
     * @return QtdCalendario
     */
    public function setCalendario(\Serbinario\Bundle\SaudeBundle\Entity\Calendario $calendario = null)
    {
        $this->calendario = $calendario;

        return $this;
    }

    /**
     * Get calendario
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Calendario 
     */
    public function getCalendario()
    {
        return $this->calendario;
    }

    /**
     * Set psf
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Psf $psf
     * @return QtdCalendario
     */
    public function setPsf(\Serbinario\Bundle\SaudeBundle\Entity\Psf $psf = null)
    {
        $this->psf = $psf;

        return $this;
    }

    /**
     * Get psf
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Psf 
     */
    public function getPsf()
    {
        return $this->psf;
    }
}
