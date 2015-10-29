<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cidade
 *
 * @ORM\Table(name="cidade")
 * @ORM\Entity
 */
class Cidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_cidade", type="string", length=100, nullable=true)
     */
    private $nomeCidade;

    /**
     * Get idCidade
     *
     * @return integer 
     */
    public function getIdCidade()
    {
        return $this->idCidade;
    }

    /**
     * Set nomeCidade
     *
     * @param string $nomeCidade
     * @return Cidade
     */
    public function setNomeCidade($nomeCidade)
    {
        $this->nomeCidade = $nomeCidade;

        return $this;
    }

    /**
     * Get nomeCidade
     *
     * @return string 
     */
    public function getNomeCidade()
    {
        return $this->nomeCidade;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() {
        
        return $this->nomeCidade;
    }
}
