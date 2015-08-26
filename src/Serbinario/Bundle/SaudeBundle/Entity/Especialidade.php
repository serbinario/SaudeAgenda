<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Especialidade
 *
 * @ORM\Table(name="especialidade")
 * @ORM\Entity
 */
class Especialidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_especialidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEspecialidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_especialidade", type="string", length=50, nullable=false)
     */
    private $nomeEspecialidade;



    /**
     * Get idEspecialidade
     *
     * @return integer 
     */
    public function getIdEspecialidade()
    {
        return $this->idEspecialidade;
    }

    /**
     * Set nomeEspecialidade
     *
     * @param string $nomeEspecialidade
     * @return Especialidade
     */
    public function setNomeEspecialidade($nomeEspecialidade)
    {
        $this->nomeEspecialidade = $nomeEspecialidade;

        return $this;
    }

    /**
     * Get nomeEspecialidade
     *
     * @return string 
     */
    public function getNomeEspecialidade()
    {
        return $this->nomeEspecialidade;
    }
    
    public function __toString() {
        return $this->nomeEspecialidade;
    }
}
