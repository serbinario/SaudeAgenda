<?php

namespace Serbinario\Bundle\SecurityBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="projeto")
 * @ORM\Entity()
 */
class Projeto 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $nomeProjeto;
    
     /**
     * @ORM\OneToMany(targetEntity="Aplicacao", mappedBy="projeto")
     **/
    private $aplicacoes;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomeProjeto
     *
     * @param string $nomeProjeto
     *
     * @return Projeto
     */
    public function setNomeProjeto($nomeProjeto)
    {
        $this->nomeProjeto = $nomeProjeto;

        return $this;
    }

    /**
     * Get nomeProjeto
     *
     * @return string
     */
    public function getNomeProjeto()
    {
        return $this->nomeProjeto;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->aplicacoes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add aplicaco
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Aplicacao $aplicaco
     *
     * @return Projeto
     */
    public function addAplicaco(\Serbinario\Bundle\SecurityBundle\Entity\Aplicacao $aplicaco)
    {
        $this->aplicacoes[] = $aplicaco;

        return $this;
    }

    /**
     * Remove aplicaco
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Aplicacao $aplicaco
     */
    public function removeAplicaco(\Serbinario\Bundle\SecurityBundle\Entity\Aplicacao $aplicaco)
    {
        $this->aplicacoes->removeElement($aplicaco);
    }

    /**
     * Get aplicacoes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAplicacoes()
    {
        return $this->aplicacoes;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString()
    {
        return $this->nomeProjeto;
    }
}
