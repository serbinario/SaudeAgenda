<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agendamento
 *
 * @ORM\Table(name="agendamento", indexes={@ORM\Index(name="fk_consulta_paciente1_idx", columns={"cgm_id_cgm"}), @ORM\Index(name="fk_consulta_calendario1_idx", columns={"calendario_id_calendario"}), @ORM\Index(name="fk_consulta_usuarios1_idx", columns={"user_id_user"})})
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
     * @var boolean
     *
     * @ORM\Column(name="status_agendamento", type="boolean", nullable=true)
     */
    private $statusAgendamento = true;

    /**
     * @var \Calendario
     *
     * @ORM\ManyToOne(targetEntity="Calendario", inversedBy="agendamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calendario_id_calendario", referencedColumnName="id_calendario")
     * })
     */
    private $calendarioCalendario;

    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Cgm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cgm_id_cgm", referencedColumnName="id_cgm")
     * })
     */
    private $pacientePaciente;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="\Serbinario\bundle\SecurityBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id_user", referencedColumnName="id")
     * })
     */
    private $usuariosUsuarios;
    
    
    /**
     * @ORM\OneToOne(targetEntity="Eventos", mappedBy="idAgendamento", cascade={"all"})
     **/
    private $evento;



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
    public function setPacientePaciente(\Serbinario\Bundle\SaudeBundle\Entity\Cgm $pacientePaciente = null)
    {
        $this->pacientePaciente = $pacientePaciente;

        return $this;
    }

    /**
     * Get pacientePaciente
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Cgm 
     */
    public function getPacientePaciente()
    {
        return $this->pacientePaciente;
    }

    /**
     * Set usuariosUsuarios
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Usuarios $usuariosUsuarios
     * @return Agendamento
     */
    public function setUsuariosUsuarios(\Serbinario\Bundle\SecurityBundle\Entity\User $usuariosUsuarios = null)
    {
        $this->usuariosUsuarios = $usuariosUsuarios;

        return $this;
    }

    /**
     * Get usuariosUsuarios
     *
     * @return \Serbinario\Bundle\SecurityBundle\Entity\Usuarios 
     */
    public function getUsuariosUsuarios()
    {
        return $this->usuariosUsuarios;
    }

    /**
     * Set statusAgendamento
     *
     * @param boolean $statusAgendamento
     * @return Agendamento
     */
    public function setStatusAgendamento($statusAgendamento)
    {
        $this->statusAgendamento = $statusAgendamento;

        return $this;
    }

    /**
     * Get statusAgendamento
     *
     * @return boolean 
     */
    public function getStatusAgendamento()
    {
        return $this->statusAgendamento;
    }

    /**
     * Set evento
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Eventos $evento
     * @return Agendamento
     */
    public function setEvento(\Serbinario\Bundle\SaudeBundle\Entity\Eventos $evento = null)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Eventos 
     */
    public function getEvento()
    {
        return $this->evento;
    }
}
