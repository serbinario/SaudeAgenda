<?php

namespace Serbinario\Bundle\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction()
    {
        #Recuperando o serviço
        $authenticationUtils = $this->get('security.authentication_utils');

        #Recuperando o erro do login
        $error = $authenticationUtils->getLastAuthenticationError();

        #Recuperando o último username inserido
        $lastUsername = $authenticationUtils->getLastUsername();

        #Retorno
        return array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            );
       
    }
    
    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {        
    }
    
     /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {        
    }
}
