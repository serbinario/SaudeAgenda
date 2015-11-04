<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventos
 *
 * @ORM\Table(name="eventos", indexes={@ORM\Index(name="fk_eventos_agendamento1_idx", columns={"id_agendamento"})})
 * @ORM\Entity
 */
class Eventos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_eventos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEventos;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @var \Date
     *
     * @ORM\Column(name="start", type="date", nullable=true)
     */
    private $start;

    /**
     * @var \Date
     *
     * @ORM\Column(name="end", type="date", nullable=true)
     */
    private $end;

    /**
     * @var \Agendamento
     *
     * @ORM\ManyToOne(targetEntity="Agendamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_agendamento", referencedColumnName="id_agendamento")
     * })
     */
    private $idAgendamento;



    /**
     * Get idEventos
     *
     * @return integer 
     */
    public function getIdEventos()
    {
        return $this->idEventos;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Eventos
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Eventos
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Eventos
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set idAgendamento
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Agendamento $idAgendamento
     * @return Eventos
     */
    public function setIdAgendamento(\Serbinario\Bundle\SaudeBundle\Entity\Agendamento $idAgendamento = null)
    {
        $this->idAgendamento = $idAgendamento;

        return $this;
    }

    /**
     * Get idAgendamento
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Agendamento 
     */
    public function getIdAgendamento()
    {
        return $this->idAgendamento;
    }
}
