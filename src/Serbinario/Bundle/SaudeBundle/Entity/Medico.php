<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medico
 *
 * @ORM\Table(name="medico", indexes={@ORM\Index(name="fk_medico_especialidade_idx", columns={"especialidade_id_especialidade"})})
 * @ORM\Entity
 */
class Medico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_medico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_medico", type="string", length=50, nullable=false)
     */
    private $nomeMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="email_medico", type="string", length=50, nullable=false)
     */
    private $emailMedico;
    
    /**
     * @var string
     *
     * @ORM\Column(name="quantidade_vagas", type="string", length=10, nullable=false)
     */
    private $quantidadeVagas;
    
    /**
     * @var string
     *
     * @ORM\Column(name="status_medico", type="boolean", nullable=false,  options={"default" = true})
     */
    private $statusMedico = true;
    
    /**
     * @var Time
     *
     * @ORM\Column(name="horario_inicio", type="time", nullable=false)
     */
    private $horarioInicio;
    
    /**
     * @var Time
     *
     * @ORM\Column(name="horario_fim", type="time", nullable=false)
     */
    private $horarioFim;

    /**
     * @var \Especialidade
     *
     * @ORM\ManyToOne(targetEntity="Especialidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="especialidade_id_especialidade", referencedColumnName="id_especialidade")
     * })
     */
    private $especialidadeEspecialidade;
        
    /**
     * @var \Localidade
     *
     * @ORM\ManyToMany(targetEntity="Localidade", inversedBy="medico", cascade={"all"})
     * @ORM\JoinTable(name="localidade_medico", 
     *      joinColumns={@ORM\JoinColumn(name="id_medico", referencedColumnName="id_medico")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_localidade", referencedColumnName="id_localidade")}
     * )
     */
    private $localidade;
    
    /**
     * @var \FotoMedico
     *
     * @ORM\OneToOne(targetEntity="FotoMedico", mappedBy="medico", cascade={"all"})
     */
    private $foto;

    /**
     * Get idMedico
     *
     * @return integer 
     */
    public function getIdMedico()
    {
        return $this->idMedico;
    }

    /**
     * Set nomeMedico
     *
     * @param string $nomeMedico
     * @return Medico
     */
    public function setNomeMedico($nomeMedico)
    {
        $this->nomeMedico = $nomeMedico;

        return $this;
    }

    /**
     * Get nomeMedico
     *
     * @return string 
     */
    public function getNomeMedico()
    {
        return $this->nomeMedico;
    }

    /**
     * Set emailMedico
     *
     * @param string $emailMedico
     * @return Medico
     */
    public function setEmailMedico($emailMedico)
    {
        $this->emailMedico = $emailMedico;

        return $this;
    }

    /**
     * Get emailMedico
     *
     * @return string 
     */
    public function getEmailMedico()
    {
        return $this->emailMedico;
    }

    /**
     * Set especialidadeEspecialidade
     *
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Especialidade $especialidadeEspecialidade
     * @return Medico
     */
    public function setEspecialidadeEspecialidade(\Serbinario\Bundle\SaudeBundle\Entity\Especialidade $especialidadeEspecialidade = null)
    {
        $this->especialidadeEspecialidade = $especialidadeEspecialidade;

        return $this;
    }

    /**
     * Get especialidadeEspecialidade
     *
     * @return \Serbinario\Bundle\SaudeBundle\Entity\Especialidade 
     */
    public function getEspecialidadeEspecialidade()
    {
        return $this->especialidadeEspecialidade;
    }
    
    /**
     * 
     * @return type
     */
    public function getLocalidade() 
    {
        return $this->localidade;
    }
    
    /**
     * 
     * @param \Localidade $localidade
     */
    public function setLocalidade($localidade)
    {
        $this->localidade = $localidade;
    }
    
    /**
     * 
     * @return type
     */
    public function getQuantidadeVagas() 
    {
        return $this->quantidadeVagas;
    }
    
    /**
     * 
     * @param type $quantidadeVagas
     */
    public function setQuantidadeVagas($quantidadeVagas) 
    {
        $this->quantidadeVagas = $quantidadeVagas;
    }
    
    /**
     * 
     * @return type
     */
    public function getHorarioInicio()
    {
        return $this->horarioInicio;
    }
    
    /**
     * 
     * @return type
     */
    public function getHorarioFim()
    {
        return $this->horarioFim;
    }
    
    /**
     * 
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Time $horarioInicio
     */
    public function setHorarioInicio($horarioInicio)
    {
        $this->horarioInicio = $horarioInicio;
    }
    
    /**
     * 
     * @param \Serbinario\Bundle\SaudeBundle\Entity\Time $horarioFim
     */
    public function setHorarioFim($horarioFim) 
    {
        $this->horarioFim = $horarioFim;
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
     * @param \FotosMedico $foto
     */
    public function setFoto($foto) 
    {
        $this->foto = $foto;
    }
    
    /**
     * 
     * @return type
     */
    public function getStatusMedico() 
    {
        return $this->statusMedico;
    }

    /**
     * 
     * @param type $statusMedico
     */
    public function setStatusMedico($statusMedico) 
    {
        $this->statusMedico = $statusMedico;
    }


}
