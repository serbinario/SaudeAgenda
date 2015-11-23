<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sexo
 *
 * @ORM\Table(name="sexo")
 * @ORM\Entity
 */
class Sexo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sexo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSexo;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=45, nullable=true)
     */
    private $sexo;

    /**
     * Get idSexo
     *
     * @return integer 
     */
    public function getIdSexo()
    {
        return $this->idSexo;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }
    
    public function __toString() {
        return $this->sexo;
    }
}
