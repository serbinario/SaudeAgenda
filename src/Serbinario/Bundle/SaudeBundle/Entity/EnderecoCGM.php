<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnderecoCGM
 *
 * @ORM\Table(name="endereco_cgm")
 * @ORM\Entity
 */
class EnderecoCGM
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_endereco_cgm", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEnderecoCGM;

    /**
     * @var string
     *
     * @ORM\Column(name="logradouro", type="string", length=200, nullable=true)
     */
    private $logradouro;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=20, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="comp", type="string", length=15, nullable=true)
     */
    private $comp;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=15, nullable=true)
     */
    private $cep;

    /**
     * @var \Bairro
     *
     * @ORM\ManyToOne(targetEntity="Bairro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bairro", referencedColumnName="id_bairro")
     * })
     */
    private $bairro;  


    /**
     * Get idEnderecoCGM
     *
     * @return integer 
     */
    public function getIdEnderecoCGM()
    {
        return $this->idEnderecoCGM;
    }

    /**
     * Set logradouro
     *
     * @param string $logradouro
     * @return EnderecoCGM
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get logradouro
     *
     * @return string 
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return EnderecoCGM
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set comp
     *
     * @param string $comp
     * @return EnderecoCGM
     */
    public function setComp($comp)
    {
        $this->comp = $comp;

        return $this;
    }

    /**
     * Get comp
     *
     * @return string 
     */
    public function getComp()
    {
        return $this->comp;
    }

    /**
     * Set cep
     *
     * @param string $cep
     * @return EnderecoCGM
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set bairro
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Bairro $bairro
     * @return EnderecoCGM
     */
    public function setBairro(\Serbinario\Bundle\SaudeBundle\Entity\Bairro $bairro = null)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Bairro 
     */
    public function getBairro()
    {
        return $this->bairro;
    }
}
