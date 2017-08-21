<?php

namespace Procash\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Procash\AdministrationBundle\Entity\Produit;

/**
 * Gestion des produits
 *
 * @author thierry1804
 */
class ProduitController extends Controller {

    /**
     * @Template()
     * @return array
     */
    public function indexAction(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $messageErreur = '';
        $messageInfo = '';

        $produitsExistants = $em->getRepository('ProcashAdministrationBundle:Produit')->getProduits();

        if ($req->isMethod('POST')) {
            //les données
            $datas = $req->request->get('produit');

            //vérifier si on ajoute un nouveau type
            $datasAjout = $this->trouverFormulaireAValider($datas, 'ajouter');
            if (count($datasAjout)) {
                //vérifier que le libellé n'existe pas ailleurs
                $doublon = $this->trouverInformationExistanteDansFormulaire($datas, 'libelle', $datasAjout[0]['libelle']);
                if (count($doublon)) {
                    //erreur
                    $messageErreur = 'Ce produit existe déjà. Veuillez en saisir un autre.';
                } else {
                    //on peut procéder à l'ajout si
                    if (strlen(trim($datasAjout[0]['libelle']))) {
                        $produit = new Produit();
                        $produit->setLibelle($datasAjout[0]['libelle']);
                        $produit->setCode($datasAjout[0]['code']);
                        $produit->setDateCreation(new \DateTime());

                        $em->persist($produit);
                        $em->flush();

                        $messageInfo = 'Produit ajouté avec succès.';
                    } else {
                        $messageErreur = 'Le produit ne peut pas être vide.';
                    }
                }
            } else {
                //vérifier si on modifie un type
                $datasModification = $this->trouverFormulaireAValider($datas, 'modifier');
                if (count($datasModification)) {
                    //vérifier que le libellé n'existe pas ailleurs
                    $doublon = $this->trouverInformationExistanteDansFormulaire($datas, 'libelle', $datasModification[0]['libelle']);
                    if (count($doublon)) {
                        //erreur
                        $messageErreur = 'Ce produit existe déjà. Veuillez en saisir un autre.';
                    } else {
                        //on peut procéder à la modification
                        $produit = $em->getRepository('ProcashAdministrationBundle:Produit')->find($datasModification[0]['id']);
                        if ($produit) {
                            if (strlen(trim($datasModification[0]['libelle']))) {
                                $produit->setLibelle($datasModification[0]['libelle']);
                                $produit->setCode($datasModification[0]['code']);
                                $produit->setDateModification(new \DateTime());

                                $em->persist($produit);
                                $em->flush();

                                $messageInfo = 'Produit modifié avec succès.';
                            } else {
                                $messageErreur = 'Le produit ne peut pas être vide.';
                            }
                        } else {
                            $messageErreur = 'Ce produit est introuvable.';
                        }
                    }
                } else {
                    //on peut procéder à la suppression
                    $datasSuppression = $this->trouverFormulaireAValider($datas, 'supprimer');
                    if (count($datasSuppression)) {
                        //on peut supprimer
                        $produit = $em->getRepository('ProcashAdministrationBundle:Produit')->find($datasSuppression[0]['id']);
                        if ($produit) {
                            $produit->setDateSuppression(new \DateTime());
                            
                            $em->persist($produit);
                            $em->flush();

                            $messageInfo = 'Produit supprimé avec succès.';
                        } else {
                            $messageErreur = 'Produit est introuvable.';
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
            return $this->redirect($this->generateUrl('procash_produit_liste'));
        }
        return array(
            'produitsExistants' => $produitsExistants,
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
            if (isset($subArray[$cle]) && $subArray[$cle] == $valeur && (!isset($subArray['ajouter']) && !isset($subArray['modifier']) && !isset($subArray['supprimer']))) {
                $resultat[] = iterator_to_array($subArray);
            }
        }
        return $resultat;
    }

}
