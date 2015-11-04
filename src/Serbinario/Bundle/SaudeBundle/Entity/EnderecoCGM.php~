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
     * @var \Cidade
     *
     * @ORM\ManyToOne(targetEntity="Cidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cidade", referencedColumnName="id_cidade")
     * })
     */
    private $cidade;
    
    /**
     * 
     * @return type
     */
    function getIdEnderecoCGM() {
        return $this->idEnderecoCGM;
    }
    
    /**
     * 
     * @return type
     */
    function getLogradouro() {
        return $this->logradouro;
    }
    
    /**
     * 
     * @return type
     */
    function getNumero() {
        return $this->numero;
    }
    
    /**
     * 
     * @return type
     */
    function getComp() {
        return $this->comp;
    }
    
    /**
     * 
     * @return type
     */
    function getCep() {
        return $this->cep;
    }
    
    /**
     * 
     * @return type
     */
    function getBairro() {
        return $this->bairro;
    }
    
    /**
     * 
     * @return type
     */
    function getCidade() {
        return $this->cidade;
    }
    
    /**
     * 
     * @param type $idEnderecoCGM
     */
    function setIdEnderecoCGM($idEnderecoCGM) {
        $this->idEnderecoCGM = $idEnderecoCGM;
    }
    
    /**
     * 
     * @param type $logradouro
     */
    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }
    
    /**
     * 
     * @param type $numero
     */
    function setNumero($numero) {
        $this->numero = $numero;
    }
    
    /**
     * 
     * @param type $comp
     */
    function setComp($comp) {
        $this->comp = $comp;
    }
    
    /**
     * 
     * @param type $cep
     */
    function setCep($cep) {
        $this->cep = $cep;
    }
    
    /**
     * 
     * @param \Bairro $bairro
     */
    function setBairro($bairro) {
        $this->bairro = $bairro;
    }
    
    /**
     * 
     * @param \Cidade $cidade
     */
    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

}
