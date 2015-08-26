<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgendaMedico
 *
 * @ORM\Table(name="agenda_medico", indexes={@ORM\Index(name="fk_agenda_medico_tipo_agenda1_idx", columns={"tipo_agenda_id_tipo_agenda"}), @ORM\Index(name="fk_agenda_medico_medico1_idx", columns={"medico_id_medico"})})
 * @ORM\Entity
 */
class AgendaMedico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_agenda_medico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAgendaMedico;

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
     * @var \TipoAgenda
     *
     * @ORM\ManyToOne(targetEntity="TipoAgenda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_agenda_id_tipo_agenda", referencedColumnName="id_tipo_agenda")
     * })
     */
    private $tipoAgendaTipoAgenda;



    /**
     * Get idAgendaMedico
     *
     * @return integer 
     */
    public function getIdAgendaMedico()
    {
        return $this->idAgendaMedico;
    }

    /**
     * Set medicoMedico
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Medico $medicoMedico
     * @return AgendaMedico
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
     * Set tipoAgendaTipoAgenda
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\TipoAgenda $tipoAgendaTipoAgenda
     * @return AgendaMedico
     */
    public function setTipoAgendaTipoAgenda(\Serbinario\Bundle\SaudeBundle\Entity\TipoAgenda $tipoAgendaTipoAgenda = null)
    {
        $this->tipoAgendaTipoAgenda = $tipoAgendaTipoAgenda;

        return $this;
    }

    /**
     * Get tipoAgendaTipoAgenda
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\TipoAgenda 
     */
    public function getTipoAgendaTipoAgenda()
    {
        return $this->tipoAgendaTipoAgenda;
    }
}
