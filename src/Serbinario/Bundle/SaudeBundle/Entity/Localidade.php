<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localidade
 *
 * @ORM\Table(name="localidade")
 * @ORM\Entity
 */
class Localidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_localidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLocalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_localidade", type="string", length=45, nullable=false)
     */
    private $nomeLocalidade;

    
    /**
     * @var \Medico
     *
     * @ORM\ManyToMany(targetEntity="Medico", mappedBy="localidade", cascade={"all"})
     */
    private $medico;

    /**
     * Get idLocalidade
     *
     * @return integer 
     */
    public function getIdLocalidade()
    {
        return $this->idLocalidade;
    }

    /**
     * Set nomeLocalidade
     *
     * @param string $nomeLocalidade
     * @return Localidade
     */
    public function setNomeLocalidade($nomeLocalidade)
    {
        $this->nomeLocalidade = $nomeLocalidade;

        return $this;
    }

    /**
     * Get nomeLocalidade
     *
     * @return string 
     */
    public function getNomeLocalidade()
    {
        return $this->nomeLocalidade;
    }
    
    /**
     * 
     * @return type
     */
    function getMedico() {
        return $this->medico;
    }
    
    /**
     * 
     * @param \Medico $medico
     */
    function setMedico($medico) {
        $this->medico = $medico;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() {
        return $this->nomeLocalidade;
    }
}
