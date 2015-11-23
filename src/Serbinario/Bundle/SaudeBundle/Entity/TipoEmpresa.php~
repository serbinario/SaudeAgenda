<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoEmpresa
 *
 * @ORM\Table(name="tipo_empresa")
 * @ORM\Entity
 */
class TipoEmpresa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tipo_empresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoEmpresa;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_empresa", type="string", length=150, nullable=true)
     */
    private $tipoEmpresa;
    
    /**
     * 
     * @return type
     */
    function getIdTipoEmpresa() {
        return $this->idTipoEmpresa;
    }
    
    /**
     * 
     * @return type
     */
    function getTipoEmpresa() {
        return $this->tipoEmpresa;
    }
    
    /**
     * 
     * @param type $tipoEmpresa
     */
    function setTipoEmpresa($tipoEmpresa) {
        $this->tipoEmpresa = $tipoEmpresa;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() {
        return $this->tipoEmpresa;
    }
}
