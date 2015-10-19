<?php

namespace Serbinario\Bundle\SecurityBundle\RN;

use Serbinario\Bundle\SecurityBundle\DAO\AplicacaoDAO;
use Serbinario\Bundle\SecurityBundle\Entity\Aplicacao;

/**
 * Description of AplicacaoRN
 *
 * @author serbinario
 */
class AplicacaoRN 
{
    /**
     *
     * @var type 
     */
    private $cbo;
    
    /**
     * 
     * @param AplicacaoDAO $cbo
     */
    public function __construct(AplicacaoDAO $cbo) 
    {
        $this->cbo = $cbo;
    }
    
    /**
     * 
     * @param Aplicacao $entity
     * @return type
     */
    public function save(Aplicacao $entity)
    {
        $result = $this->cbo->save($entity);
        
        return $result;
    }
    
    /**
     * 
     * @param Aplicacao $entity
     * @return type
     */
    public function update(Aplicacao $entity)
    {
        $result = $this->cbo->update($entity);
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function find($id)
    {        
        $result = $this->cbo->find($id);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->cbo->all();
        
        return $result;
    }
}
