<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Psf
 *
 * @ORM\Table(name="psf")
 * @ORM\Entity
 */
class Psf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_psf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPsf;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_psf", type="string", length=45, nullable=false)
     */
    private $nomePsf;



    /**
     * Get idPsf
     *
     * @return integer 
     */
    public function getIdPsf()
    {
        return $this->idPsf;
    }

    /**
     * Set nomePsf
     *
     * @param string $nomePsf
     * @return Psf
     */
    public function setNomePsf($nomePsf)
    {
        $this->nomePsf = $nomePsf;

        return $this;
    }

    /**
     * Get nomePsf
     *
     * @return string 
     */
    public function getNomePsf()
    {
        return $this->nomePsf;
    }
}
