<?php

namespace Serbinario\Bundle\SecurityBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="permissao")
 * @ORM\Entity()
 */
class Permissao 
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
    private $nomePermissao;
    
    /**
     * @ORM\ManyToOne(targetEntity="Aplicacao", inversedBy="permissoes")
     * @ORM\JoinColumn(name="aplicacao_id", referencedColumnName="id")
     **/
    private $aplicacao;

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
     * Set nomePermissao
     *
     * @param string $nomePermissao
     *
     * @return Permissao
     */
    public function setNomePermissao($nomePermissao)
    {
        $this->nomePermissao = $nomePermissao;

        return $this;
    }

    /**
     * Get nomePermissao
     *
     * @return string
     */
    public function getNomePermissao()
    {
        return $this->nomePermissao;
    }

    /**
     * Set aplicacao
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Permissao $aplicacao
     *
     * @return Permissao
     */
    public function setAplicacao(\Serbinario\Bundle\SecurityBundle\Entity\Aplicacao $aplicacao = null)
    {
        $this->aplicacao = $aplicacao;

        return $this;
    }

    /**
     * Get aplicacao
     *
     * @return \Serbinario\Bundle\SecurityBundle\Entity\Permissao
     */
    public function getAplicacao()
    {
        return $this->aplicacao;
    }
}