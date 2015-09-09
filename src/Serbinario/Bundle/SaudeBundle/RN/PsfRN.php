<?php
namespace Serbinario\Bundle\SaudeBundle\RN;

use Serbinario\Bundle\SaudeBundle\DAO\PsfDAO;
use Serbinario\Bundle\SaudeBundle\Entity\Psf;
/**
 * Description of PsfRN
 *
 * @author andrey
 */
class PsfRN 
{
    /**
     *
     * @var type 
     */
    private $psfDAO;
    
    /**
     * 
     * @param PsfDAO $psfDAO
     */
    public function __construct(PsfDAO $psfDAO) 
    {
        $this->psfDAO = $psfDAO;
    }
    
    /**
     * 
     * @param Psf $psf
     * @return type
     */
    public function save(Psf $psf)
    {
        $result = $this->psfDAO->save($psf);
        
        return $result;
    }
    
    /**
     * 
     * @param Psf $psf
     * @return type
     */
    public function remove(Psf $psf)
    {
        $result = $this->psfDAO->remove($psf);
        
        return $result;
    }
    
    /**
     * 
     * @param Psf $psf
     * @return type
     */
    public function update(Psf $psf)
    {
        $result = $this->psfDAO->update($psf);
        
        return $result;
    }
    
    /**
     * 
     * @return type
     */
    public function all()
    {
        $result = $this->psfDAO->all();
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findId($id)
    {
        $result = $this->psfDAO->findId($id);
        
        return $result;
    }
}
