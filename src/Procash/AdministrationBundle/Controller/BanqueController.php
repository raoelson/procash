<?php

namespace Procash\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Procash\AdministrationBundle\Entity\Banque;

class BanqueController extends Controller {

    /**
     * @Template()
     */
    public function indexAction(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $messageErreur = '';
        $messageInfo = '';
        $banque = new Banque();
        $listeBanqueExistants = $em->getRepository('ProcashAdministrationBundle:Banque')->findBy(array('dateSuppression' => null));
        $form = $this->createForm(new \Procash\AdministrationBundle\Form\BanqueType(), $banque);
        $container = $this->container;
        if ($container->hasParameter("default_path")) {
            $path = $container->getParameter("default_path");
        } else {
            $path = "";
        }
        if ($req->isMethod('POST')) {
//les données
            $datas = $req->request->get('banque');
            //vérifier si on ajoute un nouveau type
            $datasAjout = $this->trouverFormulaireAValider($datas, 'ajouter');

            if (count($datasAjout)) {
                //vérifier que le libellé n'existe pas ailleurs
                $doublon = $this->trouverInformationExistanteDansFormulaire($datas, 'code', $datasAjout[0]['code']);
                if (count($doublon)) {
//erreur
                    $messageErreur = 'Le code existe déjà. Veuillez en saisir un autre.';
                } else {
                    //on peut procéder à l'ajout si
                    if (strlen(trim($datasAjout[0]['code']))) {
                        $bq = new Banque();
                        $bq->setCodeInterne($datasAjout[0]['code']);
                        $bq->setLibelle($datasAjout[0]['libelle']);
                        $bq->setRefExterne($datasAjout[0]['refExterne']);
                        $em->persist($bq);
                        $em->flush();

                        $messageInfo = 'Banque ajoutée avec succès.';

                        if ($container->hasParameter('default_url') && $container->hasParameter('default_token')) {
                            $firebase = new \Firebase\FirebaseLib(
                                    $container->getParameter('default_url'), $container->getParameter('default_token')
                            );

                            $bqFire = array(
                                "code" => $bq->getCodeInterne(),
                                "libelle" => $bq->getLibelle(),
                                "refExterne" => $bq->getRefExterne()
                            );
                            $dateTime = new \DateTime();
                            $firebase->set($path.'banque/' . $bq->getId(), $bqFire);
                        }
                    }
                }
            } else {
                //vérifier si on modifie un type
                $datasModification = $this->trouverFormulaireAValider($datas, 'modifier');
                if (count($datasModification)) {
                    //vérifier que le libellé n'existe pas ailleurs
                    $doublon = $this->trouverInformationExistanteDansFormulaire($datas, 'libelle', $datasModification[0]['code']);
                    if (count($doublon)) {
//erreur
                        $messageErreur = 'Le code existe déjà. Veuillez en saisir un autre.';
                    } else {
//on peut procéder à la modification
                        $banq = $em->getRepository('ProcashAdministrationBundle:Banque')->find($datasModification[0]['id']);
                        if ($banq) {
                            if (strlen(trim($datasModification[0]['code']))) {
                                $banq->setCodeInterne($datasModification[0]['code']);
                                $banq->setLibelle($datasModification[0]['libelle']);
                                $banq->setRefExterne($datasModification[0]['refExterne']);

                                $em->persist($banq);
                                $em->flush();

                                $messageInfo = 'Banque modifiée avec succès.';
                                if ($container->hasParameter('default_url') && $container->hasParameter('default_token')) {
                                    $firebase = new \Firebase\FirebaseLib(
                                            $container->getParameter('default_url'), $container->getParameter('default_token')
                                    );
                                    $bqFire = array(
                                        "code" => $banq->getCodeInterne(),
                                        "libelle" => $banq->getLibelle(),
                                        "refExterne" => $banq->getRefExterne()
                                    );
                                    $firebase->update($path.'banque/' . $banq->getId(), $bqFire);
                                    //$bq = $firebase->get('banque/' . $banq->getId());
                                    var_dump($bqFire);
                                }
                            } else {
                                $messageErreur = 'La banque ne peut pas être vide.';
                            }
                        } else {
                            $messageErreur = 'Banque introuvable.';
                        }
                    }
                } else {
//on peut procéder à la suppression
                    $datasSuppression = $this->trouverFormulaireAValider($datas, 'supprimer');
                    if (count($datasSuppression)) {
//on peut supprimer
                        $bque = $em->getRepository('ProcashAdministrationBundle:Banque')->find($datasSuppression[0]['id'])

                        ;
                        if ($bque) {
                            $bque->setDateSuppression(new \DateTime());
                            $em->persist($bque);
                            $em->flush();

                            $messageInfo = 'Suppression réussie.';
                            if ($container->hasParameter('default_url') && $container->hasParameter('default_token')) {
                                $firebase = new \Firebase\FirebaseLib(
                                        $container->getParameter('default_url'), $container->getParameter('default_token')
                                );
                                $firebase->delete($path.'banque/' . $bque->getId());
                            }
                        } else {
                            $messageErreur = 'Banque introuvable.';
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
            return $this->redirect($this->generateUrl('procash_banque_liste'));
        }
        return array('listeBanqueExistants' => $listeBanqueExistants,
            'form' => $form->createView(),
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
