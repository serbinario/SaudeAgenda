<?php

namespace Serbinario\Bundle\SaudeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CGM
 *
 * @ORM\Table(name="cgm")
 * @ORM\Entity
 */
class CGM
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cgm", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCGM;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="num_cgm", type="integer", nullable=true)
     */
    private $numCGM;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cadastramento", type="date", nullable=true)
     */
    private $dataCadastramento;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf_cnpj", type="string", length=40, nullable=true)
     */
    private $CpfCnpj;
    
    /**
     * @var string
     *
     * @ORM\Column(name="rg", type="string", length=100, nullable=true)
     */
    private $rg;
    
    /**
     * @var string
     *
     * @ORM\Column(name="orgao_emissor", type="string", length=20, nullable=true)
     */
    private $orgaoEmissor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_expedicao", type="date", nullable=true)
     */
    private $dataExpedicao;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=250, nullable=true)
     */
    private $nome;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pai", type="string", length=250, nullable=true)
     */
    private $pai;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mae", type="string", length=250, nullable=true)
     */
    private $mae;

    /**
     * @var string
     *
     * @ORM\Column(name="naturalidade", type="string", length=50, nullable=true)
     */
    private $naturalidade;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento", type="date", nullable=true)
     */
    private $dataNascimento;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_falecimento", type="date", nullable=true)
     */
    private $dataFalecimento;
    
    /**
     * @var \EstadoCivil
     *
     * @ORM\ManyToOne(targetEntity="EstadoCivil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_civil", referencedColumnName="id_estado_civil")
     * })
     */
    private $estadoCivil;

    /**
     * @var \Sexo
     *
     * @ORM\ManyToOne(targetEntity="Sexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sexo_id_sexo", referencedColumnName="id_sexo")
     * })
     */
    private $sexoSexo; 
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="num_cnh", type="string", length=45, nullable=true)
     */
    private $numCNH;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="venci_cnh", type="date", nullable=true)
     */
    private $vencimentoCNH;
    
    /**
     * @var \CategoriaCNH
     *
     * @ORM\ManyToOne(targetEntity="CategoriaCNH")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ctgcnh", referencedColumnName="id_ctgcnh")
     * })
     */
    private $ctgCNH;
    
    /**
     * @var string
     *
     * @ORM\Column(name="inscricao_estadual", type="string", length=50, nullable=true)
     */
    private $inscricaoEstadual;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nire", type="string", length=50, nullable=true)
     */
    private $nire;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nome_complemento", type="string", length=250, nullable=true)
     */
    private $nomeComplemento;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nome_fantasia", type="string", length=250, nullable=true)
     */
    private $nomeFantasia;
    
    /**
     * @var \Nacionalidade
     *
     * @ORM\ManyToOne(targetEntity="Nacionalidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nacionalidade", referencedColumnName="id_nacionalidade")
     * })
     */
    private $nacionalidade;
    
    /**
     * @var \CGMMunicipio
     *
     * @ORM\ManyToOne(targetEntity="CGMMunicipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cgmmunicipio", referencedColumnName="id_cgmmunicipio")
     * })
     */
    private $CGMMunicipio;
    
    /**
     * @var \TipoEmpresa
     *
     * @ORM\ManyToOne(targetEntity="TipoEmpresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_empresa", referencedColumnName="id_tipo_empresa")
     * })
     */
    private $tipoEmpresa;
    
    /**
     * @var \Escolaridade
     *
     * @ORM\ManyToOne(targetEntity="Escolaridade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="escolaridade", referencedColumnName="id_escolaridade")
     * })
     */
    private $escolaridade;
    
    /**
     * @var \FonesCGM
     * 
     * @ORM\OneToMany(targetEntity="FonesCGM", mappedBy="cgm", cascade={"all"})
     */
    private $telefones;
    
    /**
     * @var \EnderecoCGM
     *
     * @ORM\OneToOne(targetEntity="EnderecoCGM", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="endereco", referencedColumnName="id_endereco_cgm")
     * })
     */
    private $endereco;
    
    /**
     * @ORM\OneToOne(targetEntity="FotoCGM", mappedBy="cgm", cascade={"all"})
     **/
    private $foto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tipo_cadastro", type="string", length=1, nullable=true)
     */
    private $tipoCadastro;
        
    /**
     * Método construtor
     */
    public function __construct()
    {        
        $this->telefones  = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * 
     * @return type
     */
    function getIdCGM() {
        return $this->idCGM;
    }
    
    /**
     * 
     * @return type
     */
    function getNumCGM() {
        return $this->numCGM;
    }
    
    /**
     * 
     * @return type
     */
    function getDataCadastramento() {
        return $this->dataCadastramento;
    }
    
    /**
     * 
     * @return type
     */
    function getCpf() {
        return $this->CpfCnpj;
    }
    
    /**
     * 
     * @return type
     */
    function getRg() {
        return $this->rg;
    }
    
    /**
     * 
     * @return type
     */
    function getOrgaoEmissor() {
        return $this->orgaoEmissor;
    }
    
    /**
     * 
     * @return type
     */
    function getDataExpedicao() {
        return $this->dataExpedicao;
    }
    
    /**
     * 
     * @return type
     */
    function getNome() {
        return $this->nome;
    }
    
    /**
     * 
     * @return type
     */
    function getPai() {
        return $this->pai;
    }
    
    /**
     * 
     * @return type
     */
    function getMae() {
        return $this->mae;
    }
    
    /**
     * 
     * @return type
     */
    function getNaturalidade() {
        return $this->naturalidade;
    }
    
    /**
     * 
     * @return type
     */
    function getDataNascimento() {
        return $this->dataNascimento;
    }
    
    /**
     * 
     * @return type
     */
    function getDataFalecimento() {
        return $this->dataFalecimento;
    }
    
    /**
     * 
     * @return type
     */
    function getEstadoCivil() {
        return $this->estadoCivil;
    }
    
    /**
     * 
     * @return type
     */
    function getSexoSexo() {
        return $this->sexoSexo;
    }
    
    /**
     * 
     * @return type
     */
    function getEmail() {
        return $this->email;
    }
    
    /**
     * 
     * @return type
     */
    function getNacionalidade() {
        return $this->nacionalidade;
    }
    
    /**
     * 
     * @return type
     */
    function getCGMMunicipio() {
        return $this->CGMMunicipio;
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
     * @return type
     */
    function getEscolaridade() {
        return $this->escolaridade;
    }
    
    /**
     * 
     * @return type
     */
    function getTelefones() {
        return $this->telefones;
    }
    
    /**
     * 
     * @return type
     */
    function getEndereco() {
        return $this->endereco;
    }
    
    /**
     * 
     * @param type $idCGM
     */
    function setIdCGM($idCGM) {
        $this->idCGM = $idCGM;
    }
    
    /**
     * 
     * @param type $numCGM
     */
    function setNumCGM($numCGM) {
        $this->numCGM = $numCGM;
    }
    
    /**
     * 
     * @param \DateTime $dataCadastramento
     */
    function setDataCadastramento($dataCadastramento) {
        $this->dataCadastramento = $dataCadastramento;
    }

    function setCpf($CpfCnpj) {
        $this->CpfCnpj = $CpfCnpj;
    }
    
    /**
     * 
     * @param type $rg
     */
    function setRg($rg) {
        $this->rg = $rg;
    }
    
    /**
     * 
     * @param type $orgaoEmissor
     */
    function setOrgaoEmissor($orgaoEmissor) {
        $this->orgaoEmissor = $orgaoEmissor;
    }
    
    /**
     * 
     * @param \DateTime $dataExpedicao
     */
    function setDataExpedicao($dataExpedicao) {
        $this->dataExpedicao = $dataExpedicao;
    }
    
    /**
     * 
     * @param type $nome
     */
    function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * 
     * @param type $pai
     */
    function setPai($pai) {
        $this->pai = $pai;
    }
    
    /**
     * 
     * @param type $mae
     */
    function setMae($mae) {
        $this->mae = $mae;
    }
    
    /**
     * 
     * @param type $naturalidade
     */
    function setNaturalidade($naturalidade) {
        $this->naturalidade = $naturalidade;
    }
    
    /**
     * 
     * @param \DateTime $dataNascimento
     */
    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }
    
    /**
     * 
     * @param \DateTime $dataFalecimento
     */
    function setDataFalecimento($dataFalecimento) {
        $this->dataFalecimento = $dataFalecimento;
    }
    
    /**
     * 
     * @param \EstadoCivil $estadoCivil
     */
    function setEstadoCivil($estadoCivil) {
        $this->estadoCivil = $estadoCivil;
    }
    
    /**
     * 
     * @param \Sexo $sexoSexo
     */
    function setSexoSexo($sexoSexo) {
        $this->sexoSexo = $sexoSexo;
    }
    
    /**
     * 
     * @param type $email
     */
    function setEmail($email) {
        $this->email = $email;
    }
    
    /**
     * 
     * @param \Nacionalidade $nacionalidade
     */
    function setNacionalidade($nacionalidade) {
        $this->nacionalidade = $nacionalidade;
    }   
    
    /**
     * 
     * @param \CGMMunicipio $CGMMunicipio
     */
    function setCGMMunicipio($CGMMunicipio) {
        $this->CGMMunicipio = $CGMMunicipio;
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
     * @param \Escolaridade $escolaridade
     */
    function setEscolaridade($escolaridade) {
        $this->escolaridade = $escolaridade;
    }
    
    /**
     * 
     * @param \FonesCGM $telefones
     */
    function setTelefones($telefones) {
        
        foreach ($telefones as $telefone) {
            $telefone->setCgm($this);
        }
        
        $this->telefones = $telefones;
    }
    
    /**
     * 
     * @param \EnderecoCGM $endereco
     */
    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
    
    /**
     * 
     * @return type
     */
    function getFoto() {
        return $this->foto;
    }
    
    /**
     * 
     * @param type $foto
     */
    function setFoto($foto) {
        $this->foto = $foto;
    }
    
    /**
     * 
     * @return type
     */
    function getNumCNH() {
        return $this->numCNH;
    }
    
    /**
     * 
     * @return type
     */
    function getVencimentoCNH() {
        return $this->vencimentoCNH;
    }
    
    /**
     * 
     * @return type
     */
    function getCtgCNH() {
        return $this->ctgCNH;
    }
    
    /**
     * 
     * @param type $numCNH
     */
    function setNumCNH($numCNH) {
        $this->numCNH = $numCNH;
    }
    
    /**
     * 
     * @param \DateTime $vencimentoCNH
     */
    function setVencimentoCNH($vencimentoCNH) {
        $this->vencimentoCNH = $vencimentoCNH;
    }
    
    /**
     * 
     * @param \CategoriaCNH $ctgCNH
     */
    function setCtgCNH($ctgCNH) {
        $this->ctgCNH = $ctgCNH;
    }
    
    /**
     * 
     * @return type
     */
    function getCpfCnpj() {
        return $this->CpfCnpj;
    }
    
    /**
     * 
     * @return type
     */
    function getInscricaoEstadual() {
        return $this->inscricaoEstadual;
    }
    
    /**
     * 
     * @return type
     */
    function getNire() {
        return $this->nire;
    }
    
    /**
     * 
     * @return type
     */
    function getNomeComplemento() {
        return $this->nomeComplemento;
    }
    
    /**
     * 
     * @return type
     */
    function getNomeFantasia() {
        return $this->nomeFantasia;
    }
    
    /**
     * 
     * @param type $CpfCnpj
     */
    function setCpfCnpj($CpfCnpj) {
        $this->CpfCnpj = $CpfCnpj;
    }
    
    /**
     * 
     * @param type $inscricaoEstadual
     */
    function setInscricaoEstadual($inscricaoEstadual) {
        $this->inscricaoEstadual = $inscricaoEstadual;
    }
    
    /**
     * 
     * @param type $nire
     */
    function setNire($nire) {
        $this->nire = $nire;
    }
    
    /**
     * 
     * @param type $nomeComplemento
     */
    function setNomeComplemento($nomeComplemento) {
        $this->nomeComplemento = $nomeComplemento;
    }
    
    /**
     * 
     * @param type $nomeFantasia
     */
    function setNomeFantasia($nomeFantasia) {
        $this->nomeFantasia = $nomeFantasia;
    }
    
    /**
     * 
     * @return type
     */
    function getTipoCadastro() {
        return $this->tipoCadastro;
    }
    
    /**
     * 
     * @param type $tipoCadastro
     */
    function setTipoCadastro($tipoCadastro) {
        $this->tipoCadastro = $tipoCadastro;
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() {
        return $this->nome;
    }
    
}