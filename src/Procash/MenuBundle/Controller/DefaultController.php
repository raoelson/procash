<?php

namespace Procash\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Template()
     * @return array
     */
    public function menuPrincipalAction($route) {
//        if ($this->getUser()->getProfilAdministrateur() || in_array("ROLE_SUPER_ADMIN", $this->getUser()->getRoles())) {
        $menus = array(
                'administration' => array(
                    'libelle' => 'ADMINISTRATION',
                    'imgMenu' => 'administration',
                    'route' => 'utilisateur',
                    'path' => '/administration1',
                    'actif' => false
                ),
                'referentiel' => array(
                    'libelle' => 'REFERENTIELS',
                    'imgMenu' => 'referentiel',
                    'route' => 'procash_type_paiement_liste',
                    'path' => '/referentiel',
                    'actif' => false
                ),
                'gestion' => array(
                    'libelle' => 'GESTION',
                    'imgMenu' => 'gestion',
                    'route' => 'liste_encaissement',
                    'path' => '/gestion1',
                    'actif' => false
                ),
            );
       // }
        //Afficher les menus en fonction du profil de l'user en cours
        if ($this->getUser()->getProfilGestionnaire()) {
            $menus = array(
                'gestion' => array(
                    'libelle' => 'GESTION',
                    'imgMenu' => 'gestion',
                    'route' => 'liste_encaissement',
                    'path' => '/gestion1',
                    'actif' => false
                ),
            );
        }

        foreach ($menus as $menu => $infos) {
            if ($infos['path'] == '/referentiel' && preg_match('%/referentiel%i', $route)) {
                $menus[$menu]['actif'] = true;
                break;
            }
            if (preg_match('%' . $infos['path'] . '/%im', $route)) {
                $menus[$menu]['actif'] = true;
                break;
            }

            if ($infos['path'] == '/administration1' && preg_match('%/administration%i', $route)) {
                $menus[$menu]['actif'] = true;
                break;
            }
            if ($infos['path'] == '/gestion1' && preg_match('%/gestion%i', $route)) {
                $menus[$menu]['actif'] = true;
                break;
            }
        }

        //sous menu admin
        $smenuAdmin = array();
        $this->sousMenuAdmin($smenuAdmin, $route);

        //sous menu referentiel
        $smenuRef = array();
        $this->sousMenuReferentiel($smenuRef, $route);

        //sous menu referentiel
        $smenuGest = array();
        $this->sousMenuGestion($smenuGest, $route);

        return array(
            'menus' => $menus,
            'sousMenuAdm' => $smenuAdmin,
            'sousMenuRef' => $smenuRef,
            'sousMenuGest' => $smenuGest,
        );
    }

    /**
     * @Template()
     * @param type $routeCourante
     * @return type
     */
    public function menuResponsiveAction($routeCourante) {
        $menus = array();
        $this->tousLesMenus($menus, $routeCourante);
        return array(
            'menus' => $menus,
        );
    }

    /**
     * @Template()
     * @param type $routeCourante
     * @return type
     */
    public function sousMenuAction($routeCourante) {
        $smenus = array();
        $this->tousLesMenus($smenus, $routeCourante);
        return array(
            'sousMenus' => $smenus,
        );
    }

    public function sousMenuAdmin(&$menus, $routeCourante = '') {
        //Menu administration
//        if (preg_match('%/administration%i', $routeCourante)) {
        $menus[] = array(
            'libelle' => 'Utilisateurs',
            'imgMenu' => 'menu_utilisateurs',
            'route' => 'utilisateur',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/utilisateur%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
        );
        $menus[] = array(
            'libelle' => 'Profils',
            'imgMenu' => 'menu_profils',
            'route' => 'procash_profil_liste',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/administration/profils%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
        );
        $menus[] = array(
            'libelle' => 'Gestion de version',
            'imgMenu' => 'menu_profils',
            'route' => 'procash_gestion_version_liste',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/administration/gestion-version%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
        );

//        $menus[] = array(
//            'libelle' => 'Titres',
//            'route' => 'procash_titre_liste',
//            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/administration/titres%i', $routeCourante)) ? 'actif' : '') : ''),
//            'sous-menu' => 1,
//        );
        //        }
    }

    public function sousMenuReferentiel(&$menus, $routeCourante = '') {
        //Menu réferentiel
//        if (preg_match('%/referentiel%', $routeCourante)) {
        $menus[] = array(
            'libelle' => 'Règlements',
            'imgMenu' => 'type_paiement',
            'route' => 'procash_type_paiement_liste',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/referentiel/reglements%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
//                'class' => 'profils'
        );
        $menus[] = array(
            'libelle' => 'Motif fermeture',
            'imgMenu' => 'motif_fermeture',
            'route' => 'procash_motif_fermeture_liste',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/referentiel/motifs-de-fermeture%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
//                'class' => 'profils'
        );
//        $menus[] = array(
//            'libelle' => 'Délai fermeture',
//            'imgMenu' => 'delai_fermeture',
//            'route' => 'procash_ajouter_delaifermeture',
//            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/referentiel/delai-et-seuil-fermeture%i', $routeCourante)) ? 'actif' : '') : ''),
//            'sous-menu' => 1,
////                'class' => 'profils'
//        );
//        $menus[] = array(
//            'libelle' => 'Produits',
//            'imgMenu' => 'produit',
//            'route' => 'procash_produit_liste',
//            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/referentiel/produits%i', $routeCourante)) ? 'actif' : '') : ''),
//            'sous-menu' => 1,
////                'class' => 'profils'
//        );
        $menus[] = array(
            'libelle' => 'Réseaux/Clients',
            'imgMenu' => 'client',
            'route' => 'procash_reseau_client_liste',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/referentiel/reseaux-clients%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
//                'class' => 'profils'
        );
        $menus[] = array(
            'libelle' => 'Banque',
            'imgMenu' => 'banque',
            'route' => 'procash_banque_liste',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/referentiel/banques%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
//                'class' => 'profils'
        );
        //        }
    }

    public function sousMenuGestion(&$menus, $routeCourante = '') {
        //Menu gestion
//        if (preg_match('%/gestion%', $routeCourante)) {
        $menus[] = array(
            'libelle' => 'Encaissement',
            'imgMenu' => 'saisi',
            'route' => 'liste_encaissement',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/gestion/encaissements%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
//                'class' => 'profils'
        );
        $menus[] = array(
            'libelle' => 'Fermeture',
            'imgMenu' => 'fermeture',
            'route' => 'procash_liste_fermeture',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/gestion/fermeture%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
//                'class' => 'profils'
        );
        $menus[] = array(
            'libelle' => 'Redistribution',
            'imgMenu' => 'redistribution',
            'route' => 'procash_liste_redistributions',
            'actif' => ((strlen(trim($routeCourante))) ? ((preg_match('%/gestion/redistributions%i', $routeCourante)) ? 'actif' : '') : ''),
            'sous-menu' => 1,
//                'class' => 'profils'
        );
        //        }
    }

}
