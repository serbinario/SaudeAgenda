<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiasCalendario
 *
 * @ORM\Table(name="dias_calendario")
 * @ORM\Entity
 */
class DiasCalendario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_dias_calendario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDiasCalendario;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_dias_calendario", type="string", length=45, nullable=false)
     */
    private $nomeDiasCalendario;



    /**
     * Get idDiasCalendario
     *
     * @return integer 
     */
    public function getIdDiasCalendario()
    {
        return $this->idDiasCalendario;
    }

    /**
     * Set nomeDiasCalendario
     *
     * @param string $nomeDiasCalendario
     * @return DiasCalendario
     */
    public function setNomeDiasCalendario($nomeDiasCalendario)
    {
        $this->nomeDiasCalendario = $nomeDiasCalendario;

        return $this;
    }

    /**
     * Get nomeDiasCalendario
     *
     * @return string 
     */
    public function getNomeDiasCalendario()
    {
        return $this->nomeDiasCalendario;
    }
}
