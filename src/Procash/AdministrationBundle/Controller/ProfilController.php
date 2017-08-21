<?php

namespace Procash\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Procash\AdministrationBundle\Entity\Profil;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends Controller {

    /**
     * @Template()
     * @return array
     */
    public function listeAction(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $messageErreur = '';
        $messageInfo = '';

        $profilExistants = $em->getRepository('ProcashAdministrationBundle:Profil')->findBy(array('dateSuppression' => null));

        if ($req->isMethod('POST')) {
            //les données
            $datas = $req->request->get('profil');

            //vérifier si on ajoute un nouveau type
            $datasAjout = $this->trouverFormulaireAValider($datas, 'ajouter');
            if (count($datasAjout)) {
                //vérifier que le libellé n'existe pas ailleurs
                $doublon = $this->trouverInformationExistanteDansFormulaire($datas, 'libelle', $datasAjout[0]['libelle']);
                if (count($doublon)) {
                    //erreur
                    $messageErreur = 'Ce profil existe déjà. Veuillez en saisir un autre.';
                } else {
                    //on peut procéder à l'ajout si
                    if (strlen(trim($datasAjout[0]['libelle']))) {
                        $profil = new Profil();
                        $profil->setLibelle($datasAjout[0]['libelle']);
                        $profil->setCode($datasAjout[0]['code']);
                        $profil->setDateCreation(new \DateTime());

                        $em->persist($profil);
                        $em->flush();

                        $messageInfo = 'Profil ajouté avec succès.';
                    }
//                    } else {
//                        $messageErreur = 'Le profil ne peut pas être vide.';
//                    }
                }
            } else {
                //vérifier si on modifie un type
                $datasModification = $this->trouverFormulaireAValider($datas, 'modifier');
                if (count($datasModification)) {
                    //vérifier que le libellé n'existe pas ailleurs
                    $doublon = $this->trouverInformationExistanteDansFormulaire($datas, 'libelle', $datasModification[0]['libelle']);
                    if (count($doublon)) {
                        //erreur
                        $messageErreur = 'Ce profil existe déjà. Veuillez en saisir un autre.';
                    } else {
                        //on peut procéder à la modification
                        $profil = $em->getRepository('ProcashAdministrationBundle:Profil')->find($datasModification[0]['id']);
                        if ($profilExistants) {
                            if (strlen(trim($datasModification[0]['libelle']))) {
                                $profil->setLibelle($datasModification[0]['libelle']);
                                $profil->setCode($datasModification[0]['code']);

                                $em->persist($profil);
                                $em->flush();

                                $messageInfo = 'Profil modifié avec succès.';
                            } else {
                                $messageErreur = 'Le profil ne peut pas être vide.';
                            }
                        } else {
                            $messageErreur = 'Ce profil est introuvable.';
                        }
                    }
                } else {
                    //on peut procéder à la suppression
                    $datasSuppression = $this->trouverFormulaireAValider($datas, 'supprimer');
                    if (count($datasSuppression)) {
                        //on peut supprimer
                        $profil = $em->getRepository('ProcashAdministrationBundle:Profil')->find($datasSuppression[0]['id']);
                        if ($profil) {
                            $profil->setDateSuppression(new \DateTime());

                            $em->persist($profil);
                            $em->flush();

                            $messageInfo = 'Profil supprimé avec succès.';
                        } else {
                            $messageErreur = 'Ce profil est introuvable.';
                        }
                    }
                }
            }
        }

        if (strlen(trim($messageErreur))) {
            $this->get('session')->getFlashBag()->add('error', $messageErreur);
        }
        if (strlen(trim($messageInfo))) {
            $this->get('session')->getFlashBag()->add('info', $messageInfo);
            //redirection
            return $this->redirect($this->generateUrl('procash_profil_liste'));
        }
        return array(
            'profilExistants' => $profilExistants,
        );
    }

    private function trouverFormulaireAValider($tableau, $cle) {
        $resultat = array();
        $arrIt = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($tableau));

        foreach ($arrIt as $sub) {
            $subArray = $arrIt->getSubIterator();
            if (isset($subArray[$cle])) {
                $resultat[] = iterator_to_array($subArray);
            }
        }
        return $resultat;
    }

    private function trouverInformationExistanteDansFormulaire($tableau, $cle, $valeur) {
        $resultat = array();
        $arrIt = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($tableau));

        foreach ($arrIt as $sub) {
            $subArray = $arrIt->getSubIterator();
            if (isset($subArray[$cle]) && strtolower(trim($subArray[$cle])) == strtolower(trim($valeur)) && (!isset($subArray['ajouter']) && !isset($subArray['modifier']) && !isset($subArray['supprimer']))) {
                $resultat[] = iterator_to_array($subArray);
            }
        }
        return $resultat;
    }

}
