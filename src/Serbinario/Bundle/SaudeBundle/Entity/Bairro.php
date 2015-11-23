<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bairro
 *
 * @ORM\Table(name="bairro")
 * @ORM\Entity
 */
class Bairro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_bairro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBairro;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_bairro", type="string", length=45, nullable=true)
     */
    private $nomeBairro;
    
    /**
     * @var \Cidade
     *
     * @ORM\ManyToOne(targetEntity="Cidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cidade", referencedColumnName="id_cidade")
     * })
     */
    private $cidade;

    /**
     * Get idBairro
     *
     * @return integer 
     */
    public function getIdBairro()
    {
        return $this->idBairro;
    }

    /**
     * Set nomeBairro
     *
     * @param string $nomeBairro
     * @return Bairro
     */
    public function setNomeBairro($nomeBairro)
    {
        $this->nomeBairro = $nomeBairro;

        return $this;
    }

    /**
     * Get nomeBairro
     *
     * @return string 
     */
    public function getNomeBairro()
    {
        return $this->nomeBairro;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() 
    {        
        return $this->nomeBairro;
    }

    /**
     * Set cidade
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Cidade $cidade
     * @return Bairro
     */
    public function setCidade(\Serbinario\Bundle\SaudeBundle\Entity\Cidade $cidade = null)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Cidade 
     */
    public function getCidade()
    {
        return $this->cidade;
    }
}
