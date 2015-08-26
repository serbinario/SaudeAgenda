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
     * @var \Especialidade
     *
     * @ORM\ManyToOne(targetEntity="Especialidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="especialidade_id_especialidade", referencedColumnName="id_especialidade")
     * })
     */
    private $especialidadeEspecialidade;



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
}
