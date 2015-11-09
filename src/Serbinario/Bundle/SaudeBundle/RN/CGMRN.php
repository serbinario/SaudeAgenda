<?php
namespace Serbinario\Bundle\SaudeBundle\RN;

use Serbinario\Bundle\SaudeBundle\DAO\CGMDAO;
use Serbinario\Bundle\SaudeBundle\Entity\CGM;

/**
 * Description of CGMRN
 *
 * @author fabio
 */
class CGMRN
{
    /**
     *
     * @var type 
     */
    private $cgmDAO;
    
    /**
     * 
     * @param CGMDAO $cgmDAO
     */
    public function __construct(CGMDAO $cgmDAO) 
    {
        $this->cgmDAO = $cgmDAO;
    }
    
    /**
     * 
     * @param CGM $cgm
     */
    public function save(CGM $cgm)
    {
        $result = $this->cgmDAO->save($cgm);
        
        return $result;
    }
    
    /**
     * 
     * @param CGM $cgm
     */
    public function edit(CGM $cgm)
    {
        $result = $this->cgmDAO->update($cgm);
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     */
    public function findById($id)
    {
        $result = $this->cgmDAO->findById($id);
        
        return $result;
    }
    
    /**
     * 
     * @param type
     */
    public function ultimoRegistroNumCGM()
    {
        $result = $this->cgmDAO->ultimoRegistroNumCGM();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function getCGMAjax($id)
    {
        $result = $this->cgmDAO->getCGMAjax($id);
        
        return $result;
    }
    
    /**
     * 
     * @param type $cpf
     * @param type $nome
     * @return type
     */
    public function searchCGMCpfNome($cpf, $nome, $tipo)
    {
        $result = $this->cgmDAO->searchCGMCpfNome($cpf, $nome, $tipo);
        
        return $result;
    }
    
    /**
     * 
     * @param type $Telefone
     * @param type $idCgm
     * @return type
     */
    public function removeTelefonesByUpdate($Telefone, $idCgm)
    {
        $result = $this->cgmDAO->removeTelefonesByUpdate($Telefone, $idCgm);
        
        return $result;
    }
    
    /**
     * 
     * @param type $idCgm
     * @return type
     */
    public function removeTelefonesByUpdateVazio($idCgm)
    {
        $result = $this->cgmDAO->removeTelefonesByUpdateVazio($idCgm);
        
        return $result;
    }
}
