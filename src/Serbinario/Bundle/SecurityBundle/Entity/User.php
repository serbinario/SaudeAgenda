<?php

namespace Serbinario\Bundle\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Serbinario\Bundle\SecurityBundle\Entity\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable
{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\ManyToMany(targetEntity="Perfil")
     * @ORM\JoinTable(name="perfis_user",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="perfil_id", referencedColumnName="id")}
     *      )
     **/
    private $perfis;
    
    /**
     * @ORM\ManyToMany(targetEntity="Role", cascade={"all"})
     * @ORM\JoinTable(name="role_user",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     **/
    private $roles;
    
    /**
     * @ORM\OneToOne(targetEntity="Serbinario\Bundle\SaudeBundle\Entity\CGM")
     * @ORM\JoinColumn(name="cgm_id", referencedColumnName="id_cgm")
     **/
    private $cgm;
    
    /**
     * @var \FotoMedico
     *
     * @ORM\OneToOne(targetEntity="FotoUser", mappedBy="user", cascade={"all"})
     */
    private $foto;
    
    /**
     * @var \Psf
     *
     * @ORM\ManyToOne(targetEntity="Serbinario\Bundle\SaudeBundle\Entity\Psf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="psf_id_psf", referencedColumnName="id_psf")
     * })
     */
    private $psfPsf;
    

    public function __construct()
    {
        $this->isActive = true;
        $this->perfis   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles    = new \Doctrine\Common\Collections\ArrayCollection();
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 
     * @return type
     */
    public function getRoles()
    { 
        #Variáveis ultilizadas
        $arrayRetorno = array('ROLE_USER');
        $perfis       = $this->perfis->toArray();
        $roles        = $this->roles->toArray();
         
        #Adicionando roles dos perfis
        if(count($perfis) > 0) {
            foreach($perfis as $perfil) {
                $rolesPerfil = $perfil->getRoles()->toArray();
                if(count($rolesPerfil) > 0) {
                    foreach($rolesPerfil as $role) {
                       \array_push($arrayRetorno, $role->getNomeRole()); 
                    }
                    
                }                
            }
        }
        
        #Adicionando roles individuais
        foreach($roles as $role) {
            \array_push($arrayRetorno, $role->getNomeRole());            
        }
            
        #Retorno
        return \array_unique($arrayRetorno);
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add perfi
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Perfil $perfi
     *
     * @return User
     */
    public function addPerfi(\Serbinario\Bundle\SecurityBundle\Entity\Perfil $perfi)
    {
        $this->perfis[] = $perfi;

        return $this;
    }

    /**
     * Remove perfi
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Perfil $perfi
     */
    public function removePerfi(\Serbinario\Bundle\SecurityBundle\Entity\Perfil $perfi)
    {
        $this->perfis->removeElement($perfi);
    }
    
    /**
     * 
     */
    public function clearPerfis()
    {
        $this->perfis->clear();
    }

    /**
     * Get perfis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerfis()
    {
        return $this->perfis;
    }

    /**
     * Add role
     *
     * @param \Serbinario\Bundle\SecurityBundle\Entity\Role $role
     *
     * @return User
     */
    public function addRole(\Serbinario\Bundle\SecurityBundle\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \SerBinario\SecurityBundle\Entity\Role $role
     */
    public function removeRole(\Serbinario\Bundle\SecurityBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }
    
    /**
     * 
     */
    public function clearRoles()
    {
        $this->roles->clear();
    }
    
    /**
     * 
     * @return type
     */
    public function listRoles()
    {
        return $this->roles;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * 
     * @return boolean
     */
    public function isAccountNonLocked() 
    {
        return true;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isCredentialsNonExpired() 
    {
        return true;
    }

    /**
     * 
     * @return type
     */
    public function isEnabled()
    {
        return $this->isActive;
    }
    
    /**
     * 
     * @return type
     */
    public function getFoto() 
    {
        return $this->foto;
    }
    
    /**
     * 
     * @param type $foto
     */
    public function setFoto($foto) 
    {
        $this->foto = $foto;
    }

    /**
     * 
     * @return type
     */
    public function getPsfPsf() 
    {
        return $this->psfPsf;
    }
    
    /**
     * 
     * @param type $psfPsf
     */
    public function setPsfPsf($psfPsf) 
    {
        $this->psfPsf = $psfPsf;
    }
    
    /**
     * Set cgm
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\CGM $cgm
     * @return Paciente
     */
    public function setCgm(\Serbinario\Bundle\SaudeBundle\Entity\CGM $cgm = null)
    {
        $this->cgm = $cgm;

        return $this;
    }

    /**
     * Get cgm
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\CGM 
     */
    public function getCgm()
    {
        return $this->cgm;
    }
}