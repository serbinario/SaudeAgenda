<?php

namespace Serbinario\Bundle\SecurityBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="aplicacao")
 * @ORM\Entity()
 */
class Aplicacao 
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
    private $nomeAplicacao;
    
    /**
     * @ORM\OneToMany(targetEntity="Permissao", mappedBy="aplicacao")
     **/
    private $permissoes;
    
    /**
     * @ORM\ManyToOne(targetEntity="Projeto", inversedBy="aplicacoes")
     * @ORM\JoinColumn(name="projeto_id", referencedColumnName="id")
     **/
    private $projeto;

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
     * Set nomeAplicacao
     *
     * @param string $nomeAplicacao
     *
     * @return Aplicacao
     */
    public function setNomeAplicacao($nomeAplicacao)
    {
        $this->nomeAplicacao = $nomeAplicacao;

        return $this;
    }

    /**
     * Get nomeAplicacao
     *
     * @return string
     */
    public function getNomeAplicacao()
    {
        return $this->nomeAplicacao;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permissoes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add permisso
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Permissao $permisso
     *
     * @return Aplicacao
     */
    public function addPermisso(\Serbinario\Bundle\SecurityBundle\Entity\Permissao $permisso)
    {
        $this->permissoes[] = $permisso;

        return $this;
    }

    /**
     * Remove permisso
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Permissao $permisso
     */
    public function removePermisso(\Serbinario\Bundle\SecurityBundle\Entity\Permissao $permisso)
    {
        $this->permissoes->removeElement($permisso);
    }

    /**
     * Get permissoes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermissoes()
    {
        return $this->permissoes;
    }

    /**
     * Set projeto
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Projeto $projeto
     *
     * @return Aplicacao
     */
    public function setProjeto(\Serbinario\Bundle\SecurityBundle\Entity\Projeto $projeto = null)
    {
        $this->projeto = $projeto;

        return $this;
    }

    /**
     * Get projeto
     *
     * @return \Serbinario\Bundle\SecurityBundle\Entity\Projeto
     */
    public function getProjeto()
    {
        return $this->projeto;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() 
    {
        return $this->nomeAplicacao;
    }
}
