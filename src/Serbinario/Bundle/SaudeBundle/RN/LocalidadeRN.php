<?php
namespace Serbinario\Bundle\SaudeBundle\RN;

use Serbinario\Bundle\SaudeBundle\DAO\LocalidadeDAO;
use Serbinario\Bundle\SaudeBundle\Entity\Localidade;
/**
 * Description of LocalidadeRN
 *
 * @author andrey
 */
class LocalidadeRN 
{
    /**
     *
     * @var type 
     */
    private $localidadeDAO;
    
    /**
     * 
     * @param LocalidadeDAO $localidadeDAO
     */
    public function __construct(LocalidadeDAO $localidadeDAO) 
    {
        $this->localidadeDAO = $localidadeDAO;
    }
    
    /**
     * 
     * @param Localidade $localidade
     * @return type
     */
    public function save(Localidade $localidade)
    {
        $result = $this->localidadeDAO->save($localidade);
        
        return $result;
    }
    
    /**
     * 
     * @param Localidade $localidade
     * @return type
     */
    public function remove(Localidade $localidade)
    {
        $result = $this->localidadeDAO->remove($localidade);
        
        return $result;
    }
    
    /**
     * 
     * @param Localidade $localidade
     * @return type
     */
    public function update(Localidade $localidade)
    {
        $result = $this->localidadeDAO->update($localidade);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->localidadeDAO->all();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findId($id)
    {
        $result = $this->localidadeDAO->findId($id);
        
        return $result;
    }
}
