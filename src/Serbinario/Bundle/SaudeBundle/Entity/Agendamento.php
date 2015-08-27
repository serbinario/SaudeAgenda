<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agendamento
 *
 * @ORM\Table(name="agendamento", indexes={@ORM\Index(name="fk_consulta_paciente1_idx", columns={"paciente_id_paciente"}), @ORM\Index(name="fk_consulta_calendario1_idx", columns={"calendario_id_calendario"}), @ORM\Index(name="fk_consulta_usuarios1_idx", columns={"usuarios_id_usuarios"})})
 * @ORM\Entity
 */
class Agendamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_agendamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAgendamento;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao_agendamento", type="text", nullable=true)
     */
    private $observacaoAgendamento;

    /**
     * @var \Calendario
     *
     * @ORM\ManyToOne(targetEntity="Calendario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calendario_id_calendario", referencedColumnName="id_calendario")
     * })
     */
    private $calendarioCalendario;

    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente_id_paciente", referencedColumnName="id_paciente")
     * })
     */
    private $pacientePaciente;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuarios_id_usuarios", referencedColumnName="id_usuarios")
     * })
     */
    private $usuariosUsuarios;



    /**
     * Get idAgendamento
     *
     * @return integer 
     */
    public function getIdAgendamento()
    {
        return $this->idAgendamento;
    }

    /**
     * Set observacaoAgendamento
     *
     * @param string $observacaoAgendamento
     * @return Agendamento
     */
    public function setObservacaoAgendamento($observacaoAgendamento)
    {
        $this->observacaoAgendamento = $observacaoAgendamento;

        return $this;
    }

    /**
     * Get observacaoAgendamento
     *
     * @return string 
     */
    public function getObservacaoAgendamento()
    {
        return $this->observacaoAgendamento;
    }

    /**
     * Set calendarioCalendario
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Calendario $calendarioCalendario
     * @return Agendamento
     */
    public function setCalendarioCalendario(\Serbinario\Bundle\SaudeBundle\Entity\Calendario $calendarioCalendario = null)
    {
        $this->calendarioCalendario = $calendarioCalendario;

        return $this;
    }

    /**
     * Get calendarioCalendario
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Calendario 
     */
    public function getCalendarioCalendario()
    {
        return $this->calendarioCalendario;
    }

    /**
     * Set pacientePaciente
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Paciente $pacientePaciente
     * @return Agendamento
     */
    public function setPacientePaciente(\Serbinario\Bundle\SaudeBundle\Entity\Paciente $pacientePaciente = null)
    {
        $this->pacientePaciente = $pacientePaciente;

        return $this;
    }

    /**
     * Get pacientePaciente
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Paciente 
     */
    public function getPacientePaciente()
    {
        return $this->pacientePaciente;
    }

    /**
     * Set usuariosUsuarios
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Usuarios $usuariosUsuarios
     * @return Agendamento
     */
    public function setUsuariosUsuarios(\Serbinario\Bundle\SaudeBundle\Entity\Usuarios $usuariosUsuarios = null)
    {
        $this->usuariosUsuarios = $usuariosUsuarios;

        return $this;
    }

    /**
     * Get usuariosUsuarios
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Usuarios 
     */
    public function getUsuariosUsuarios()
    {
        return $this->usuariosUsuarios;
    }
}
