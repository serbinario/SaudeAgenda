<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendario
 *
 * @ORM\Table(name="calendario")
 * @ORM\Entity
 */
class Calendario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_calendario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCalendario;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd_total_calendario", type="integer", nullable=false)
     */
    private $qtdTotalCalendario;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd_reserva_calendario", type="integer", nullable=false)
     */
    private $qtdReservaCalendario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dia_calendario", type="date", nullable=false)
     */
    private $diaCalendario;

    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horario_calendario", type="time", nullable=false)
     */
    private $horarioCalendario;
    
    /**
     * @var Boolean
     *
     * @ORM\Column(name="status_calendario", type="boolean", nullable=false, options={"default" = true})
     */
    private $statusCalendario = true;

    /**
     * @var \Localidade
     *
     * @ORM\ManyToOne(targetEntity="Localidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localidade_id_localidade", referencedColumnName="id_localidade")
     * })
     */
    private $localidadeLocalidade;
    
     /**
     * @var \Medico
     *
     * @ORM\ManyToOne(targetEntity="Medico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="medico_id_medico", referencedColumnName="id_medico")
     * })
     */
    private $medicoMedico;
    
    /**
     * @var \QtdCalendario
     * 
     * @ORM\OneToMany(targetEntity="QtdCalendario", mappedBy="psf", cascade={"all"})
     */
    private $qtdCalendarios;

    /**
     * Get idCalendario
     *
     * @return integer 
     */
    public function getIdCalendario()
    {
        return $this->idCalendario;
    }

    /**
     * Set qtdTotalCalendario
     *
     * @param integer $qtdTotalCalendario
     * @return Calendario
     */
    public function setQtdTotalCalendario($qtdTotalCalendario)
    {
        $this->qtdTotalCalendario = $qtdTotalCalendario;

        return $this;
    }

    /**
     * Get qtdTotalCalendario
     *
     * @return integer 
     */
    public function getQtdTotalCalendario()
    {
        return $this->qtdTotalCalendario;
    }

    /**
     * Set qtdReservaCalendario
     *
     * @param integer $qtdReservaCalendario
     * @return Calendario
     */
    public function setQtdReservaCalendario($qtdReservaCalendario)
    {
        $this->qtdReservaCalendario = $qtdReservaCalendario;

        return $this;
    }

    /**
     * Get qtdReservaCalendario
     *
     * @return integer 
     */
    public function getQtdReservaCalendario()
    {
        return $this->qtdReservaCalendario;
    }

    /**
     * Set localidadeLocalidade
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Localidade $localidadeLocalidade
     * @return Calendario
     */
    public function setLocalidadeLocalidade(\Serbinario\Bundle\SaudeBundle\Entity\Localidade $localidadeLocalidade = null)
    {
        $this->localidadeLocalidade = $localidadeLocalidade;

        return $this;
    }

    /**
     * Get localidadeLocalidade
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Localidade 
     */
    public function getLocalidadeLocalidade()
    {
        return $this->localidadeLocalidade;
    }
    
    /**
     * Set medicoMedico
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Medico $medicoMedico
     * @return Calendario
     */
    public function setMedicoMedico(\Serbinario\Bundle\SaudeBundle\Entity\Medico $medicoMedico = null)
    {
        $this->medicoMedico = $medicoMedico;

        return $this;
    }

    /**
     * Get medicoMedico
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Medico 
     */
    public function getMedicoMedico()
    {
        return $this->medicoMedico;
    }
    
    /**
     * 
     * @return type
     */
    public function getDiaCalendario()
    {
        return $this->diaCalendario;
    }

    /**
     * 
     * @return type
     */
    public function getHorarioCalendario() 
    {
        return $this->horarioCalendario;
    }

    /**
     * 
     * @param type $diaCalendario
     */
    public function setDiaCalendario($diaCalendario) {
        $this->diaCalendario = $diaCalendario;
    }

    /**
     * 
     * @param type $horarioCalendario
     */
    public function setHorarioCalendario($horarioCalendario) 
    {
        $this->horarioCalendario = $horarioCalendario;
    }

    /**
     * 
     * @return type
     */
    public function getStatusCalendario() 
    {
        return $this->statusCalendario;
    }
    
    /**
     * 
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Boolean $statusCalendario
     */
    public function setStatusCalendario($statusCalendario) 
    {
        $this->statusCalendario = $statusCalendario;
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
     * @return Calendario
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
}
