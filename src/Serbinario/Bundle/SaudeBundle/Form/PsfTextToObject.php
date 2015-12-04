<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Description of MedicoTextToObject
 *
 * @author serbinario
 */
class PsfTextToObject implements DataTransformerInterface
{
    /**
     *
     * @var type 
     */
    private $manager;

    /**
     * 
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    /**
     * 
     * @param type $psf
     * @return string
     */
    public function transform($psf)
    {
        if (null === $psf) {
            return '';
        }

        return $psf->getIdPsf() 
                . " - " .$psf->getNomePsf();                
    }

    /**
     * 
     * @param type $psf
     * @return type
     * @throws TransformationFailedException
     */
    public function reverseTransform($psf)
    {
        // no issue number? It's optional, so that's ok
        if (!$psf) {
            return;
        }
        
        $psfArray = explode(" - ", $psf);
        
        $result = $this->manager
                ->getRepository('SaudeBundle:Psf')
                // query for the issue with this id
                ->find($psfArray[0])
        ;

        if (null === $result) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'Esse "%s" não existe!',
                $psfArray[1]
            ));
        }

        return $result;
    }
}
