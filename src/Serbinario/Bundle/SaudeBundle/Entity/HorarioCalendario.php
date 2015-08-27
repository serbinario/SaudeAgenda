<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HorarioCalendario
 *
 * @ORM\Table(name="horario_calendario")
 * @ORM\Entity
 */
class HorarioCalendario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_horario_calendario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHorarioCalendario;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_horario_calendario", type="string", length=45, nullable=false)
     */
    private $nomeHorarioCalendario;



    /**
     * Get idHorarioCalendario
     *
     * @return integer 
     */
    public function getIdHorarioCalendario()
    {
        return $this->idHorarioCalendario;
    }

    /**
     * Set nomeHorarioCalendario
     *
     * @param string $nomeHorarioCalendario
     * @return HorarioCalendario
     */
    public function setNomeHorarioCalendario($nomeHorarioCalendario)
    {
        $this->nomeHorarioCalendario = $nomeHorarioCalendario;

        return $this;
    }

    /**
     * Get nomeHorarioCalendario
     *
     * @return string 
     */
    public function getNomeHorarioCalendario()
    {
        return $this->nomeHorarioCalendario;
    }
}
