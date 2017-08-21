<?php

namespace Procash\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Procash\AdministrationBundle\Entity\TypePaiement;

/**
 * Gestion des types de paiement
 *
 * @author thierry1804
 */
class TypePaiementController extends Controller {

    /**
     * @Template()
     * @return array
     */
    public function indexAction(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $messageErreur = '';
        $messageInfo = '';

        $typesPaiementsExistants = $em->getRepository('ProcashAdministrationBundle:TypePaiement')->getTypesPaiements();

        if ($req->isMethod('POST')) {
            //les données
            $datas = $req->request->get('typePaiement');

            //vérifier si on ajoute un nouveau type
            $datasAjout = $this->trouverFormulaireAValider($datas, 'ajouter');
            if (count($datasAjout)) {
                //vérifier que le libellé n'existe pas ailleurs
                $doublon = $this->trouverInformationExistanteDansFormulaire($datas, 'libelle', $datasAjout[0]['libelle']);
                if (count($doublon)) {
                    //erreur
                    $messageErreur = 'Ce mode de règlement existe déjà. Veuillez en saisir un autre.';
                } else {
                    //on peut procéder à l'ajout si
                    if (strlen(trim($datasAjout[0]['libelle']))) {
                        $typePaiement = new TypePaiement();
                        $typePaiement->setLibelle($datasAjout[0]['libelle']);
                        $typePaiement->setCode($datasAjout[0]['code']);
                        $typePaiement->setDateCreation(new \DateTime());
                        $typePaiement->setUtilisateur($this->get('security.context')->getToken()->getUser());

                        $em->persist($typePaiement);
                        $em->flush();

                        $messageInfo = 'Mode de règlement ajouté avec succès.';
                    }
//                    } else {
//                        $messageErreur = 'Le mode de règlement ne peut pas être vide.';
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
                        $messageErreur = 'Ce mode de règlement existe déjà. Veuillez en saisir un autre.';
                    } else {
                        //on peut procéder à la modification
                        $typePaiement = $em->getRepository('ProcashAdministrationBundle:TypePaiement')->find($datasModification[0]['id']);
                        if ($typePaiement) {
                            if (strlen(trim($datasModification[0]['libelle']))) {
                                $typePaiement->setLibelle($datasModification[0]['libelle']);
                                $typePaiement->setCode($datasModification[0]['code']);
                                $typePaiement->setDateModification(new \DateTime());
                                $typePaiement->setUtilisateur($this->get('security.context')->getToken()->getUser());

                                $em->persist($typePaiement);
                                $em->flush();

                                $messageInfo = 'Mode de règlement modifié avec succès.';
                            } else {
                                $messageErreur = 'Le mode de règlement ne peut pas être vide.';
                            }
                        } else {
                            $messageErreur = 'Ce mode de règlement est introuvable.';
                        }
                    }
                } else {
                    //on peut procéder à la suppression
                    $datasSuppression = $this->trouverFormulaireAValider($datas, 'supprimer');
                    if (count($datasSuppression)) {
                        //on peut supprimer
                        $typePaiement = $em->getRepository('ProcashAdministrationBundle:TypePaiement')->find($datasSuppression[0]['id']);
                        if ($typePaiement) {
                            $typePaiement->setDateSuppression(new \DateTime());
                            $typePaiement->setUtilisateur($this->get('security.context')->getToken()->getUser());

                            $em->persist($typePaiement);
                            $em->flush();

                            $messageInfo = 'Mode de règlement supprimé avec succès.';
                        } else {
                            $messageErreur = 'Ce mode de règlement est introuvable.';
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
            return $this->redirect($this->generateUrl('procash_type_paiement_liste'));
        }
        return array(
            'typesPaiementsExistants' => $typesPaiementsExistants,
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
