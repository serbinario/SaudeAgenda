<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="estado")
 * @ORM\Entity
 */
class Estado 
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_estado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstadp;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_estado", type="string", length=4, nullable=true)
     */
    private $nomeEstado;

    /**
     * Get idEstadp
     *
     * @return integer 
     */
    public function getIdEstadp()
    {
        return $this->idEstadp;
    }

    /**
     * Set nomeEstado
     *
     * @param string $nomeEstado
     * @return Estado
     */
    public function setNomeEstado($nomeEstado)
    {
        $this->nomeEstado = $nomeEstado;

        return $this;
    }

    /**
     * Get nomeEstado
     *
     * @return string 
     */
    public function getNomeEstado()
    {
        return $this->nomeEstado;
    }
}
