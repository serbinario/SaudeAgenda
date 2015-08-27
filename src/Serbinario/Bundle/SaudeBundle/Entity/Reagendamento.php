<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reagendamento
 *
 * @ORM\Table(name="reagendamento", indexes={@ORM\Index(name="fk_reagendamento_consulta1_idx", columns={"consulta_id_consulta_adiado"}), @ORM\Index(name="fk_reagendamento_consulta2_idx", columns={"consulta_id_consulta_remarcado"})})
 * @ORM\Entity
 */
class Reagendamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reagendamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReagendamento;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao_reagendamento", type="text", nullable=false)
     */
    private $observacaoReagendamento;

    /**
     * @var \Agendamento
     *
     * @ORM\ManyToOne(targetEntity="Agendamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consulta_id_consulta_adiado", referencedColumnName="id_agendamento")
     * })
     */
    private $consultaConsultaAdiado;

    /**
     * @var \Agendamento
     *
     * @ORM\ManyToOne(targetEntity="Agendamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consulta_id_consulta_remarcado", referencedColumnName="id_agendamento")
     * })
     */
    private $consultaConsultaRemarcado;



    /**
     * Get idReagendamento
     *
     * @return integer 
     */
    public function getIdReagendamento()
    {
        return $this->idReagendamento;
    }

    /**
     * Set observacaoReagendamento
     *
     * @param string $observacaoReagendamento
     * @return Reagendamento
     */
    public function setObservacaoReagendamento($observacaoReagendamento)
    {
        $this->observacaoReagendamento = $observacaoReagendamento;

        return $this;
    }

    /**
     * Get observacaoReagendamento
     *
     * @return string 
     */
    public function getObservacaoReagendamento()
    {
        return $this->observacaoReagendamento;
    }

    /**
     * Set consultaConsultaAdiado
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Agendamento $consultaConsultaAdiado
     * @return Reagendamento
     */
    public function setConsultaConsultaAdiado(\Serbinario\Bundle\SaudeBundle\Entity\Agendamento $consultaConsultaAdiado = null)
    {
        $this->consultaConsultaAdiado = $consultaConsultaAdiado;

        return $this;
    }

    /**
     * Get consultaConsultaAdiado
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Agendamento 
     */
    public function getConsultaConsultaAdiado()
    {
        return $this->consultaConsultaAdiado;
    }

    /**
     * Set consultaConsultaRemarcado
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Agendamento $consultaConsultaRemarcado
     * @return Reagendamento
     */
    public function setConsultaConsultaRemarcado(\Serbinario\Bundle\SaudeBundle\Entity\Agendamento $consultaConsultaRemarcado = null)
    {
        $this->consultaConsultaRemarcado = $consultaConsultaRemarcado;

        return $this;
    }

    /**
     * Get consultaConsultaRemarcado
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Agendamento 
     */
    public function getConsultaConsultaRemarcado()
    {
        return $this->consultaConsultaRemarcado;
    }
}
