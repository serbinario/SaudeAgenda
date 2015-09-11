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
     * @var \Localidade
     *
     * @ORM\OneToOne(targetEntity="Localidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localidade_id_localidade", referencedColumnName="id_localidade")
     * })
     */
    private $localidadeLocalidade;



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


}
