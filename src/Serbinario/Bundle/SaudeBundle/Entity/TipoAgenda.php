<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoAgenda
 *
 * @ORM\Table(name="tipo_agenda")
 * @ORM\Entity
 */
class TipoAgenda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tipo_agenda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoAgenda;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_tipo_agendal", type="string", length=20, nullable=false)
     */
    private $nomeTipoAgendal;



    /**
     * Get idTipoAgenda
     *
     * @return integer 
     */
    public function getIdTipoAgenda()
    {
        return $this->idTipoAgenda;
    }

    /**
     * Set nomeTipoAgendal
     *
     * @param string $nomeTipoAgendal
     * @return TipoAgenda
     */
    public function setNomeTipoAgendal($nomeTipoAgendal)
    {
        $this->nomeTipoAgendal = $nomeTipoAgendal;

        return $this;
    }

    /**
     * Get nomeTipoAgendal
     *
     * @return string 
     */
    public function getNomeTipoAgendal()
    {
        return $this->nomeTipoAgendal;
    }
}
