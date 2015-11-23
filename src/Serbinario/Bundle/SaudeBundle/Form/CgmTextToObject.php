<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Description of CgmTextToObject
 *
 * @author serbinario
 */
class CgmTextToObject implements DataTransformerInterface
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
     * @param type $cgm
     * @return string
     */
    public function transform($cgm)
    {
        if (null === $cgm) {
            return '';
        }

        return $cgm->getIdCGM() . " - " . $cgm->getNome();
    }

    /**
     * 
     * @param type $cgm
     * @return type
     * @throws TransformationFailedException
     */
    public function reverseTransform($cgm)
    {
        // no issue number? It's optional, so that's ok
        if (!$cgm) {
            return;
        }
        $cgmArray = explode("-", $cgm);
        $cgmId    = trim($cgmArray[0]);
        
        $cgm = $this->manager
            ->getRepository('SaudeBundle:CGM')
            // query for the issue with this id
            ->find($cgmId)
        ;

        if (null === $cgm) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'Esse "%s" não existe!',
                $cgmId
            ));
        }

        return $cgm;
    }
}
