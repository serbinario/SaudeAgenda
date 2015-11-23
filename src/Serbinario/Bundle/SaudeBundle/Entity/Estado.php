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
    private $idEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_estado", type="string", length=50, nullable=true)
     */
    private $nomeEstado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sigla_estado", type="string", length=2, nullable=true)
     */
    private $siglaEstado;

    /**
     * Get idEstadp
     *
     * @return integer 
     */
    public function getIdEstado()
    {
        return $this->idEstado;
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

    /**
     * Set siglaEstado
     *
     * @param string $siglaEstado
     * @return Estado
     */
    public function setSiglaEstado($siglaEstado)
    {
        $this->siglaEstado = $siglaEstado;

        return $this;
    }

    /**
     * Get siglaEstado
     *
     * @return string 
     */
    public function getSiglaEstado()
    {
        return $this->siglaEstado;
    }
}
