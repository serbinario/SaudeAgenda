<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * CBO
 *
 * @ORM\Table(name="cbo")
 * @ORM\Entity
 */
class CBO 
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;


    /**
     * Set id
     *
     * @param integer $id
     * @return CBO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set descricao
     *
     * @param string $descricao
     * @return CBO
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString()
    {
        return $this->getId() . " - " . $this->getDescricao();
    }
}
