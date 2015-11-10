<?php
namespace Serbinario\Bundle\SaudeBundle\RN;

use Serbinario\Bundle\SaudeBundle\DAO\EspecialidadeDAO;
use Serbinario\Bundle\SaudeBundle\Entity\Especialidade;
/**
 * Description of EspecialidadeRN
 *
 * @author andrey
 */
class EspecialidadeRN 
{
    /**
     *
     * @var type 
     */
    private $especialidadeDAO;
    
    /**
     * 
     * @param EspecialidadeDAO $especialidadeDAO
     */
    public function __construct(EspecialidadeDAO $especialidadeDAO) 
    {
        $this->especialidadeDAO = $especialidadeDAO;
    }
    
    /**
     * 
     * @param Especialidade $especialidade
     * @return type
     */
    public function save(Especialidade $especialidade)
    {
        $result = $this->especialidadeDAO->save($especialidade);
        
        return $result;
    }
    
    /**
     * 
     * @param Especialidade $especialidade
     * @return type
     */
    public function remove(Especialidade $especialidade)
    {
        $result = $this->especialidadeDAO->remove($especialidade);
        
        return $result;
    }
    
    /**
     * 
     * @param Especialidade $especialidade
     * @return type
     */
    public function update(Especialidade $especialidade)
    {
        $result = $this->especialidadeDAO->update($especialidade);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->especialidadeDAO->all();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findId($id)
    {
        $result = $this->especialidadeDAO->findId($id);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function findWithMedico()
    {
        $result = $this->especialidadeDAO->findWithMedico();
        
        return $result;
    }
}
