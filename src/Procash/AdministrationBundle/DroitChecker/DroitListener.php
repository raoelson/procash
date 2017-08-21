<?php

namespace Procash\AdministrationBundle\DroitChecker;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver;
use Symfony\Component\DependencyInjection\Container;

class DroitListener {

    protected $context;
    protected $em;
    protected $resolver;
    protected $listeRoutes;
    protected $container;
    protected $design;

    public function __construct(SecurityContext $context, EntityManager $manager, ControllerResolver $resolver, Container $container) {
        $this->context = $context;
        $this->em = $manager;
        $this->resolver = $resolver;
        $this->container = $container;
        $this->listeRoutes = array();
        $this->listeRoutesSystem = array();
        $this->design = null;
    }

    public function verifierDroit($routeCourante) {
        $ret = 0;
        if ($this->context->getToken()) {
            $utilisateur = $this->context->getToken()->getUser();
            if (is_object($utilisateur)) {
                $listeRoute = array();
                $routesSystemes = array();
                $router = $this->container->get('router');
                foreach ($router->getRouteCollection()->all() as $name => $rout) {
                    if (preg_match('%^(_|fos_)%im', $name)) {
                        $routesSystemes[] = $name;
                    }
                }
                $this->listeRoutes = $routesSystemes;
                if (in_array("ROLE_SUPER_ADMIN", $utilisateur->getRoles())) {
                    $this->listeRoutes = array_merge($this->listeRoutes, array(
                        'procash_profil_liste',
                        'utilisateur',
                        'creer_utilisateur',
                        'procash_type_paiement_liste',
                        'procash_profil_supprimer',
                        'procash_profil_modifier',
                        'procash_liste_redistributions',
                        'procash_gestion_version_liste'
                    ));
                } else {
//                    if ($utilisateur->getProfil()) {
                    $profil = $utilisateur->getProfil()->getLibelle();
                    if ($utilisateur->getProfilGestionnaire()) {
                        $this->listeRoutes = array_merge($this->listeRoutes, array(
                            'procash_liste_fermeture',
                            'procash_ajouter_fermeture',
                            'procash_modifier_fermeture',
                            'procash_supprimer_fermeture',
                            'procash_liste_redistributions',
                            'modifier_facture',
                            'modifier_regul',
                            'liste_encaissement',
                            'modifier_detail_client',
                            'ajax_afficher_historique_regul',
                            'ajax_afficher_historique_invendu',
                            'modifier_chiffre_vente_par_titre',
                            'procash_gestion_facture_provisoire_pdf',
                            'ajax_afficher_historique_montant'));
                    } elseif ($utilisateur->getProfilCollecteur()) {
                        $this->listeRoutes = array_merge($this->listeRoutes, array(
                            'procash_ajouter_delaifermeture'
                        ));
                    } elseif ($utilisateur->getProfilOperateur()) {
                        $this->listeRoutes = array_merge($this->listeRoutes, array(
                            'procash_ajouter_delaifermeture',
                        ));
                    } elseif ($utilisateur->getProfilAdministrateur()) {
                        $this->listeRoutes = array_merge($this->listeRoutes, array(
                            'procash_profil_liste',
                            'utilisateur',
                            'creer_utilisateur',
                            'modifier_utilisateur',
                            'supprimer_utilisateur',
                            'procash_type_paiement_liste',
                            'procash_profil_supprimer',
                            'procash_profil_modifier',
                            'procash_profil_ajouter',
                            'procash_ajouter_delaifermeture',
                            'procash_motif_fermeture_liste',
                            'procash_ecran_visu',
                            'procash_liste_fermeture',
                            'set_encaissement_client',
                            'procash_liste_redistributions',
                            'procash_gestion_facture_provisoire_pdf',
                            'procash_gestion_version_liste'
                        ));
                    }
                    //}
                }
            }
        }
        
        //API SERVICE WEB
        $this->listeRoutes = array_merge($this->listeRoutes, 
                                array(
                                    'get_user',
                                    'get_reseaux_user', 
                                    'get_clients_reseaux',
                                    'get_saisie_reseau_client_utilisateur',
                                    'set_saisie_client_utilisateur',
                                    'get_encaissement_client',
                                    'get_saisie_user',
                                    'get_clients_user',
                                    'get_reseaux',
                                    'get_clients',
                                    'get_saisies',
                                    'get_facturations',
                                    'get_banques',
                                    'set_facturations',
                                    'get_delai_fermeture',
                                    'get_motifs_fermeture',
                                    'set_fermeture',
                                    'get_fermetures',
                                    'get_version_apk',
                                    'get_remplacements-client',
                                    'set_redistribution',
                                    'get_titres',
                                    'get_redistributions',
                                    'set_redistribution'
                                )
                            );
        if (in_array($routeCourante, $this->listeRoutes)) {
            $ret++;
        }

        return $ret;
    }

    protected function verifierRouteNePasExclure($routeCourante) {
        $r = 0;
        if (preg_match('%^(_|fos_user_)%im', $routeCourante)) {
            $r++;
        }
        return $r;
    }

    public function onKernelController(FilterControllerEvent $event) {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }
        $controller = $event->getController();
        $rq = $event->getRequest();
        if (is_object($this->context->getToken())) {
            $usr = $this->context->getToken()->getUser();
            if ($usr == 'anon.') {
                //$rq->attributes->set('_controller', 'FOS\UserBundle\Controller\SecurityController::loginAction');
                $controller = $this->resolver->getController($rq);
            } else {
                $routeCourante = $rq->attributes->get('_route');
                $droitVerifie = $this->verifierDroit($routeCourante);
                $session = $this->container->get('session');
                $session->set('_listeRoutes', $this->listeRoutes);
                $session->set('_css', $this->design);
                if (!$droitVerifie && !$this->verifierRouteNePasExclure($routeCourante) && (!in_array("ROLE_SUPER_ADMIN", $usr->getRoles())) && (!$usr->getProfilAdministrateur() == true)) {
                    $rq->attributes->set('_controller', 'ProcashAdministrationBundle:Default:erreur');
                    $controller = $this->resolver->getController($rq);
                }
            }
        }
        $event->setController($controller);
    }

}
