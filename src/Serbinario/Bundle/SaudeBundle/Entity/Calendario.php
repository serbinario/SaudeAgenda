<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendario
 *
 * @ORM\Table(name="calendario", indexes={@ORM\Index(name="fk_calendario_agenda_medico1_idx", columns={"agenda_medico_id_agenda_medico"}), @ORM\Index(name="fk_calendario_dias_calendario1_idx", columns={"dias_calendario_id_dias_calendario"}), @ORM\Index(name="fk_calendario_horario_calendario1_idx", columns={"horario_calendario_id_horario_calendario"}), @ORM\Index(name="fk_calendario_localidade1_idx", columns={"localidade_id_localidade"})})
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
     * @var \AgendaMedico
     *
     * @ORM\ManyToOne(targetEntity="AgendaMedico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="agenda_medico_id_agenda_medico", referencedColumnName="id_agenda_medico")
     * })
     */
    private $agendaMedicoAgendaMedico;

    /**
     * @var \DiasCalendario
     *
     * @ORM\ManyToOne(targetEntity="DiasCalendario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dias_calendario_id_dias_calendario", referencedColumnName="id_dias_calendario")
     * })
     */
    private $diasCalendarioDiasCalendario;

    /**
     * @var \HorarioCalendario
     *
     * @ORM\ManyToOne(targetEntity="HorarioCalendario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="horario_calendario_id_horario_calendario", referencedColumnName="id_horario_calendario")
     * })
     */
    private $horarioCalendarioHorarioCalendario;

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
     * Set agendaMedicoAgendaMedico
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\AgendaMedico $agendaMedicoAgendaMedico
     * @return Calendario
     */
    public function setAgendaMedicoAgendaMedico(\Serbinario\Bundle\SaudeBundle\Entity\AgendaMedico $agendaMedicoAgendaMedico = null)
    {
        $this->agendaMedicoAgendaMedico = $agendaMedicoAgendaMedico;

        return $this;
    }

    /**
     * Get agendaMedicoAgendaMedico
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\AgendaMedico 
     */
    public function getAgendaMedicoAgendaMedico()
    {
        return $this->agendaMedicoAgendaMedico;
    }

    /**
     * Set diasCalendarioDiasCalendario
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\DiasCalendario $diasCalendarioDiasCalendario
     * @return Calendario
     */
    public function setDiasCalendarioDiasCalendario(\Serbinario\Bundle\SaudeBundle\Entity\DiasCalendario $diasCalendarioDiasCalendario = null)
    {
        $this->diasCalendarioDiasCalendario = $diasCalendarioDiasCalendario;

        return $this;
    }

    /**
     * Get diasCalendarioDiasCalendario
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\DiasCalendario 
     */
    public function getDiasCalendarioDiasCalendario()
    {
        return $this->diasCalendarioDiasCalendario;
    }

    /**
     * Set horarioCalendarioHorarioCalendario
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\HorarioCalendario $horarioCalendarioHorarioCalendario
     * @return Calendario
     */
    public function setHorarioCalendarioHorarioCalendario(\Serbinario\Bundle\SaudeBundle\Entity\HorarioCalendario $horarioCalendarioHorarioCalendario = null)
    {
        $this->horarioCalendarioHorarioCalendario = $horarioCalendarioHorarioCalendario;

        return $this;
    }

    /**
     * Get horarioCalendarioHorarioCalendario
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\HorarioCalendario 
     */
    public function getHorarioCalendarioHorarioCalendario()
    {
        return $this->horarioCalendarioHorarioCalendario;
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
}
