<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Psf
 *
 * @ORM\Table(name="psf")
 * @ORM\Entity
 */
class Psf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_psf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPsf;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_psf", type="string", length=45, nullable=false)
     */
    private $nomePsf;
    
    /**
     * @var \QtdCalendario
     * 
     * @ORM\OneToMany(targetEntity="QtdCalendario", mappedBy="psf", cascade={"all"})
     */
    private $qtdCalendarios;
    
    /**
     * @var \QtdDefault
     * 
     * @ORM\OneToMany(targetEntity="QtdDefault", mappedBy="psf", cascade={"all"})
     */
    private $qtdDefaults;


    /**
     * Get idPsf
     *
     * @return integer 
     */
    public function getIdPsf()
    {
        return $this->idPsf;
    }

    /**
     * Set nomePsf
     *
     * @param string $nomePsf
     * @return Psf
     */
    public function setNomePsf($nomePsf)
    {
        $this->nomePsf = $nomePsf;

        return $this;
    }

    /**
     * Get nomePsf
     *
     * @return string 
     */
    public function getNomePsf()
    {
        return $this->nomePsf;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() 
    {
        return $this->nomePsf;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->qtdCalendarios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add qtdCalendarios
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\QtdCalendario $qtdCalendarios
     * @return Psf
     */
    public function addQtdCalendario(\Serbinario\Bundle\SaudeBundle\Entity\QtdCalendario $qtdCalendarios)
    {
        $this->qtdCalendarios[] = $qtdCalendarios;

        return $this;
    }

    /**
     * Remove qtdCalendarios
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\QtdCalendario $qtdCalendarios
     */
    public function removeQtdCalendario(\Serbinario\Bundle\SaudeBundle\Entity\QtdCalendario $qtdCalendarios)
    {
        $this->qtdCalendarios->removeElement($qtdCalendarios);
    }

    /**
     * Get qtdCalendarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQtdCalendarios()
    {
        return $this->qtdCalendarios;
    }

    /**
     * Add qtdDefaults
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\QtdDefault $qtdDefaults
     * @return Psf
     */
    public function addQtdDefault(\Serbinario\Bundle\SaudeBundle\Entity\QtdDefault $qtdDefaults)
    {
        $this->qtdDefaults[] = $qtdDefaults;

        return $this;
    }

    /**
     * Remove qtdDefaults
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\QtdDefault $qtdDefaults
     */
    public function removeQtdDefault(\Serbinario\Bundle\SaudeBundle\Entity\QtdDefault $qtdDefaults)
    {
        $this->qtdDefaults->removeElement($qtdDefaults);
    }

    /**
     * Get qtdDefaults
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQtdDefaults()
    {
        return $this->qtdDefaults;
    }
}
