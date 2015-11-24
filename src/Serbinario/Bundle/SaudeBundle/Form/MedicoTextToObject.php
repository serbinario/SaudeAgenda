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
class MedicoTextToObject implements DataTransformerInterface
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
     * @param type $medico
     * @return string
     */
    public function transform($medico)
    {
        if (null === $medico) {
            return '';
        }

        return $medico->getIdMedico() 
                . " - " .$medico->getCgm()->getNome() 
                . " - " . $medico->getEspecialidadeEspecialidade()->getDescricaoEspecialidade();
    }

    /**
     * 
     * @param type $medico
     * @return type
     * @throws TransformationFailedException
     */
    public function reverseTransform($medico)
    {
        // no issue number? It's optional, so that's ok
        if (!$medico) {
            return;
        }
        
        $medicoArray = explode(" - ", $medico);
        
        $result = $this->manager
                ->getRepository('SaudeBundle:Medico')
                // query for the issue with this id
                ->find($medicoArray[0])
        ;

        if (null === $result) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'Esse "%s" não existe!',
                $medicoArray[1]
            ));
        }

        return $result;
    }
}
