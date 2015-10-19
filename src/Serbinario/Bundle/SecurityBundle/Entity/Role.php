<?php

namespace Serbinario\Bundle\SecurityBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="role")
 * @ORM\Entity()
 */
class Role 
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
    private $nomeRole;
    
    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="roles")
     **/
    private $user;
   

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
     * Set nomeRole
     *
     * @param string $nomeRole
     *
     * @return Role
     */
    public function setNomeRole($nomeRole)
    {
        $this->nomeRole = $nomeRole;

        return $this;
    }

    /**
     * Get nomeRole
     *
     * @return string
     */
    public function getNomeRole()
    {
        return $this->nomeRole;
    }

    /**
     * Set user
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\User $user
     *
     * @return Role
     */
    public function setUser(\Serbinario\Bundle\SecurityBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Serbinario\Bundle\SecurityBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\User $user
     *
     * @return Role
     */
    public function addUser(\Serbinario\Bundle\SecurityBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\User $user
     */
    public function removeUser(\Serbinario\Bundle\SecurityBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }
}
