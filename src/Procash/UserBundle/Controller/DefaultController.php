<?php

namespace Procash\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Procash\UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use DateTime;

class DefaultController extends Controller {

    /**
     * @Template()
     * @return array
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('ProcashUserBundle:User')->findBy(array('dateSuppression' => null));
        $utilisateursFiltre = $em->getRepository('ProcashUserBundle:User')->findBy(array('dateSuppression' => null));
        $userEncours = $this->get('security.context')->getToken()->getUser();
        $userSuperAdmin = null;
        $profils = $em->getRepository('ProcashAdministrationBundle:Profil')->findBy(array('dateSuppression'=> null));

        foreach ($utilisateurs as $key => $utilisateur) {
            if (in_array("ROLE_SUPER_ADMIN", $utilisateur->getRoles())) {
                unset($utilisateurs[$key]);
            }
        }
        $utilisateur = null;
        $profil = null;
        $mail = null;
        $dateCr = null;
        if($request->isMethod('POST')){
            $f = $request->request->get('filtre');
            
            if(!is_null($f['utilisateur'])){
                $utilisateur = $f['utilisateur'];
            }
            if(!is_null($f['profil'])){
                $profil = $f['profil'];
            }
            if(!is_null($f['email'])){
                $mail = $f['email'];
            }
            
            if(!is_null($f['date_creation'])){
                $dateCr = $f['date_creation'];
            }
            
            $utilisateurs =  $em->getRepository('ProcashUserBundle:User')->getUtilisateurParFiltre($f);
        }
        return array(
            'utilisateurs' => $utilisateurs,
            'utilisateursFiltre' => $utilisateursFiltre,
            'profils' => $profils,
            'utilisateurId' => $utilisateur,
            'profilId' => $profil,
            'email' => $mail,
            'dateCreation' => $dateCr,
        );
    }

    /**
     * @Template()
     */
    public function ajouterAction(Request $request) {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $form = $this->createForm(new UserType(), $user);
        $em = $this->getDoctrine()->getEntityManager();
        $listeProfil = $em->getRepository('ProcashAdministrationBundle:Profil')->findBy(array('dateSuppression' => null));
        $listeReseau = $em->getRepository('ProcashAdministrationBundle:Reseau')->findBy(array('dateSuppression' => null));
        $reposReseaux = $em->getRepository('ProcashAdministrationBundle:Reseau');
        $listeUtilisateurs = $em->getRepository('ProcashUserBundle:User')->findBy(array('dateSuppression' => null));
        $listeUserVerifLogin = $em->getRepository('ProcashUserBundle:User')->findBy(array('dateSuppression' => null));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $request->get('selectProfil');
                $prof = explode('__', $data);
                $profilId = $prof[0];
                $profil = $em->getRepository('ProcashAdministrationBundle:Profil')->find($profilId);
                switch ($profil->getCode()) {
                    case 'adm':
                        $user->setProfilAdministrateur(true);
                        break;
                    case 'col':
                        $user->setProfilCollecteur(true);
                        break;
                    case 'ope':
                        $user->setProfilOperateur(true);
                        break;
                    case 'ges':
                        $user->setProfilGestionnaire(true);
                        break;
                    default :
                        break;
                }
                $reseaux = $reposReseaux->find($request->get('selectReseau'));
                $user->setReseau($reseaux);
                $user->setProfil($profil);
                $user->setDateCreation(new DateTime('now'));
                $user->setEnabled(true);
                $em->persist($user);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Utilisateur enregistré avec succès.');
                return $this->redirect($this->generateUrl('utilisateur'));
            }
        }
        return array(
            'form' => $form->createView(),
            'listeUtilisateur' => $listeUtilisateurs,
            'listeProfil' => $listeProfil,
            'listeReseau' => $listeReseau,
            'listeUserVerifLogin' => $listeUserVerifLogin,
        );
    }

    /**
     * @Template()
     */
    public function modifierAction($id) {
        $userManager = $this->container->get('fos_user.user_manager');
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('ProcashUserBundle:User')->find($id);
        $form = $this->createForm(new UserType(), $user);
        $listeUtilisateurs = $em->getRepository('ProcashUserBundle:User')->findBy(array('dateSuppression' => null));
        $listeReseau = $em->getRepository('ProcashAdministrationBundle:Reseau')->findBy(array('dateSuppression' => null));
        $reposReseaux = $em->getRepository('ProcashAdministrationBundle:Reseau');
        $listeUserVerifLogin = $em->getRepository('ProcashUserBundle:User')->findBy(array("dateSuppression"=>null));
        foreach ($listeUserVerifLogin as $key => $utilisateur) {
            if ($utilisateur->getId() == $user->getId()) {
                unset($listeUserVerifLogin[$key]);
            }
        }
        $listeProfil = $em->getRepository('ProcashAdministrationBundle:Profil')->findBy(array('dateSuppression' => null));
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $request->get('selectProfil');
                $prof = explode('__', $data);
                $profilId = $prof[0];
                $profil = $em->getRepository('ProcashAdministrationBundle:Profil')->find($profilId);
                switch ($profil->getCode()) {
                    case 'adm':
                        $user->setProfilAdministrateur(true);
                        $user->setProfilCollecteur(false);
                        $user->setProfilOperateur(false);
                        $user->setProfilGestionnaire(false);
                        break;
                    case 'col':
                        $user->setProfilCollecteur(true);
                        $user->setProfilAdministrateur(false);
                        $user->setProfilOperateur(false);
                        $user->setProfilGestionnaire(false);
                        break;
                    case 'ope':
                        $user->setProfilOperateur(true);
                        $user->setProfilCollecteur(false);
                        $user->setProfilAdministrateur(false);
                        $user->setProfilGestionnaire(false);
                        break;
                    case 'ges':
                        $user->setProfilGestionnaire(true);
                        $user->setProfilOperateur(false);
                        $user->setProfilCollecteur(false);
                        $user->setProfilAdministrateur(false);
                        break;
                    default :
                        break;
                }
                $reseaux = $reposReseaux->find($request->get('selectReseau'));
                $user->setReseau($reseaux);
                $user->setProfil($profil);
                $user->setDateModification(new DateTime('now'));
                $user->setEnabled(true);
                $em->persist($user);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Utilisateur modifié avec succès.');
                return $this->redirect($this->generateUrl('utilisateur'));
            }
        }

        return array(
            'form' => $form->createView(),
            'listeUtilisateur' => $listeUtilisateurs,
            'user' => $user,
            'listeProfil' => $listeProfil,
            'listeUserVerifLogin' => $listeUserVerifLogin,
            'listeReseau' => $listeReseau
        );
    }
    
    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ProcashUserBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Impossible de trouver l\'utilisateur.');
        }
        $user->setDateSuppression(new \DateTime());
        $user->setEnabled(false);
        $em->persist($user);
        $em->flush();
        $this->get('session')->getFlashBag()->add('info', 'Utilisateur supprimé avec succès.');
        return $this->redirect($this->generateUrl('utilisateur'));
    }

}
