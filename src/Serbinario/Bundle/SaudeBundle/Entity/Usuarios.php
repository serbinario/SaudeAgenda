<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios", indexes={@ORM\Index(name="fk_usuarios_psf1_idx", columns={"psf_id_psf"})})
 * @ORM\Entity
 */
class Usuarios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuarios", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuarios;

    /**
     * @var string
     *
     * @ORM\Column(name="login_usuarios", type="string", length=15, nullable=false)
     */
    private $loginUsuarios;

    /**
     * @var string
     *
     * @ORM\Column(name="senha_usuarios", type="string", length=255, nullable=false)
     */
    private $senhaUsuarios;

    /**
     * @var \Psf
     *
     * @ORM\ManyToOne(targetEntity="Psf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="psf_id_psf", referencedColumnName="id_psf")
     * })
     */
    private $psfPsf;



    /**
     * Get idUsuarios
     *
     * @return integer 
     */
    public function getIdUsuarios()
    {
        return $this->idUsuarios;
    }

    /**
     * Set loginUsuarios
     *
     * @param string $loginUsuarios
     * @return Usuarios
     */
    public function setLoginUsuarios($loginUsuarios)
    {
        $this->loginUsuarios = $loginUsuarios;

        return $this;
    }

    /**
     * Get loginUsuarios
     *
     * @return string 
     */
    public function getLoginUsuarios()
    {
        return $this->loginUsuarios;
    }

    /**
     * Set senhaUsuarios
     *
     * @param string $senhaUsuarios
     * @return Usuarios
     */
    public function setSenhaUsuarios($senhaUsuarios)
    {
        $this->senhaUsuarios = $senhaUsuarios;

        return $this;
    }

    /**
     * Get senhaUsuarios
     *
     * @return string 
     */
    public function getSenhaUsuarios()
    {
        return $this->senhaUsuarios;
    }

    /**
     * Set psfPsf
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Psf $psfPsf
     * @return Usuarios
     */
    public function setPsfPsf(\Serbinario\Bundle\SaudeBundle\Entity\Psf $psfPsf = null)
    {
        $this->psfPsf = $psfPsf;

        return $this;
    }

    /**
     * Get psfPsf
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Psf 
     */
    public function getPsfPsf()
    {
        return $this->psfPsf;
    }
}
