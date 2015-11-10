<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Especialidade
 *
 * @ORM\Table(name="especialidade")
 * @ORM\Entity
 */
class Especialidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_especialidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEspecialidade;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao_especialidade", type="string", length=50, nullable=true)
     */
    private $descricaoEspecialidade;
    
    /**
     *
     * @var CBO
     * 
     * @ORM\ManyToOne("CBO")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn("cbo_id", referencedColumnName="codigo")
     * })
     */
    private $cbo;

    /**
     * @var \Medico
     *
     * @ORM\OneToMany(targetEntity="Medico", mappedBy="especialidadeEspecialidade", cascade={"all"})
     */
    private $medico;

    /**
     * Get idEspecialidade
     *
     * @return integer 
     */
    public function getIdEspecialidade()
    {
        return $this->idEspecialidade;
    }

    /**
     * 
     * @return type
     */
    public function __toString() 
    {
        return $this->cbo->getDescricao();
    }

    /**
     * Set cbo
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\CBO $cbo
     * @return Especialidade
     */
    public function setCbo(\Serbinario\Bundle\SaudeBundle\Entity\CBO $cbo = null)
    {
        $this->cbo = $cbo;

        return $this;
    }

    /**
     * Get cbo
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\CBO 
     */
    public function getCbo()
    {
        return $this->cbo;
    }

    /**
     * Set descricaoEspecialidade
     *
     * @param string $descricaoEspecialidade
     * @return Especialidade
     */
    public function setDescricaoEspecialidade($descricaoEspecialidade)
    {
        $this->descricaoEspecialidade = $descricaoEspecialidade;

        return $this;
    }

    /**
     * Get descricaoEspecialidade
     *
     * @return string 
     */
    public function getDescricaoEspecialidade()
    {
        return $this->descricaoEspecialidade;
    }
    
    /**
     * 
     * @return type
     */
    function getMedico() {
        return $this->medico;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medico = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add medico
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Medico $medico
     * @return Especialidade
     */
    public function addMedico(\Serbinario\Bundle\SaudeBundle\Entity\Medico $medico)
    {
        $this->medico[] = $medico;

        return $this;
    }

    /**
     * Remove medico
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Medico $medico
     */
    public function removeMedico(\Serbinario\Bundle\SaudeBundle\Entity\Medico $medico)
    {
        $this->medico->removeElement($medico);
    }
}
