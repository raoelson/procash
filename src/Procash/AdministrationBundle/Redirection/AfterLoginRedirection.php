<?php

/**
 * @copyright  Copyright (c) 2009-2014 Steven TITREN - www.webaki.com
 * @package    Webaki\UserBundle\Redirection
 * @author     Steven Titren <contact@webaki.com>
 */

namespace Procash\AdministrationBundle\Redirection;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface {

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;
    private $em;
    private $session;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router, EntityManager $em, Session $session, SecurityContext $context) {
        $this->router = $router;
        $this->em = $em;
        $this->session = $session;
        $this->context = $context;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        // Get list of roles for current user
        $roles = $token->getRoles();
        // Tranform this list in array
        $rolesTab = array_map(function($role) {
            return $role->getRole();
        }, $roles);

        //vérification nombre de compte créé
        $em = $this->em;
        $session = $this->session;
        $userEnCours = $this->context->getToken()->getUser();

        // If is a admin or super admin we redirect to the backoffice area
        if (in_array('ROLE_ADMIN', $rolesTab, true) || in_array('ROLE_SUPER_ADMIN', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('utilisateur'));
        // otherwise, if is a commercial user we redirect to the crm area
        elseif ($userEnCours->getProfilGestionnaire())
            $redirection = new RedirectResponse($this->router->generate('liste_encaissement'));
        // otherwise we redirect user to the member area
        else
            $redirection = new RedirectResponse($this->router->generate('utilisateur'));

        return $redirection;
    }

}
