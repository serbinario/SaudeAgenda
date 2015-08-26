<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente")
 * @ORM\Entity
 */
class Paciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_paciente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_paciente", type="string", length=45, nullable=false)
     */
    private $nomePaciente;



    /**
     * Get idPaciente
     *
     * @return integer 
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    /**
     * Set nomePaciente
     *
     * @param string $nomePaciente
     * @return Paciente
     */
    public function setNomePaciente($nomePaciente)
    {
        $this->nomePaciente = $nomePaciente;

        return $this;
    }

    /**
     * Get nomePaciente
     *
     * @return string 
     */
    public function getNomePaciente()
    {
        return $this->nomePaciente;
    }
}
