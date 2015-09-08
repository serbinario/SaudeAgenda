<?php

namespace Serbinario\Bundle\SaudeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Serbinario\Bundle\SaudeBundle\Form\MedicoType;
use Serbinario\Bundle\SaudeBundle\Form\EspecialidadeType;
use Serbinario\Bundle\SaudeBundle\UTIL\GridClass;

/**
 * @Route("/agenda")
 */
class AgendaController extends Controller {

    /**
     * @Route("/agendamento", name="agendamento")
     * @Template()
     */
    public function agendamentoAction() {
        return array();
    }

}
