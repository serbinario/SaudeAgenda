<?php

namespace Serbinario\Bundle\SaudeBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Description of CBOTextToObject
 *
 * @author serbinario
 */
class CBOTextToObject implements DataTransformerInterface
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
     * @param type $cbo
     * @return string
     */
    public function transform($cbo)
    {
        if (null === $cbo) {
            return '';
        }

        return $cbo->getDescricao();
    }

    /**
     * 
     * @param type $cbo
     * @return type
     * @throws TransformationFailedException
     */
    public function reverseTransform($cbo)
    {
        // no issue number? It's optional, so that's ok
        if (!$cbo) {
            return;
        }
        
        $result  = $this->manager
                    ->getRepository('SaudeBundle:CBO')
                    // query for the issue with this id
                    ->findBy(array("descricao" => $cbo));
        
        if (!$result) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'Esse "%s" não existe!',
                $cbo
            ));
        }

        return $result[0];
    }
}
