<?php

namespace Procash\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Procash\AdministrationBundle\Entity\MotifFermeture;
use Procash\AdministrationBundle\Form\DelaiFermetureType;
use Procash\AdministrationBundle\Entity\DelaiFermeture;

/**
 * Description of MotifFermetureController
 *
 * @author thierry1804
 */
class MotifFermetureController extends Controller {

    /**
     * @Template()
     * @return array
     */
    public function indexAction(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $messageErreur = '';
        $messageInfo = '';
        $delaiSeuilFermetures = $em->getRepository('ProcashAdministrationBundle:DelaiFermeture')->findOneBy(array('dateSuppression'=>null));
         if ($delaiSeuilFermetures === null) {
              $delaiSeuilFermeture = new DelaiFermeture();
        } else{
            $delaiSeuilFermeture = $delaiSeuilFermetures;         
        }   

        $motifsFermeturesExistants = $em->getRepository('ProcashAdministrationBundle:MotifFermeture')->getMotifsFermetures();
         $form = $this->createForm(new DelaiFermetureType(), $delaiSeuilFermeture);
        if ($req->isMethod('POST')) {
            //les données
            $datas = $req->request->get('motifFermeture');
            
            //vérifier si on ajoute un nouveau type
            $datasAjout = $this->trouverFormulaireAValider($datas, 'ajouter');
            if (count($datasAjout)) {
                //vérifier que le libellé n'existe pas ailleurs
                $doublon = $this->trouverInformationExistanteDansFormulaire($datas, 'libelle', $datasAjout[0]['libelle']);
                if (count($doublon)) {
                    //erreur
                    $messageErreur = 'Ce motif de fermeture existe déjà. Veuillez en saisir un autre.';
                }
                else {
                    //on peut procéder à l'ajout si
                    if (strlen(trim($datasAjout[0]['libelle']))) {
                        $motifFermeture = new MotifFermeture();
                        $motifFermeture->setLibelle($datasAjout[0]['libelle']);
                        $motifFermeture->setCode($datasAjout[0]['code']);
                        $motifFermeture->setDateCreation(new \DateTime());
                        $motifFermeture->setUtilisateur($this->get('security.context')->getToken()->getUser());

                        $em->persist($motifFermeture);
                        $em->flush();

                        $messageInfo = 'Motif de fermeture ajouté avec succès.';
                    }
                    else {
                        $messageErreur = 'Le motif de fermeture ne peut pas être vide.';
                    }
                }
            }
            else {
                //vérifier si on modifie un type
                $datasModification = $this->trouverFormulaireAValider($datas, 'modifier');
                if (count($datasModification)) {
                    //vérifier que le libellé n'existe pas ailleurs
                    $doublon = $this->trouverInformationExistanteDansFormulaire($datas, 'libelle', $datasModification[0]['libelle']);
                    if (count($doublon)) {
                        //erreur
                        $messageErreur = 'Ce motif de fermeture existe déjà. Veuillez en saisir un autre.';
                    }
                    else {
                        //on peut procéder à la modification
                        $motifFermeture = $em->getRepository('ProcashAdministrationBundle:MotifFermeture')->find($datasModification[0]['id']);
                        if ($motifFermeture) {
                            if (strlen(trim($datasModification[0]['libelle']))) {
                                $motifFermeture->setLibelle($datasModification[0]['libelle']);
                                $motifFermeture->setCode($datasModification[0]['code']);
                                $motifFermeture->setDateModification(new \DateTime());
                                $motifFermeture->setUtilisateur($this->get('security.context')->getToken()->getUser());

                                $em->persist($motifFermeture);
                                $em->flush();

                                $messageInfo = 'Motif de fermeture modifié avec succès.';
                            }
                            else {
                                $messageErreur = 'Le motif de fermeture ne peut pas être vide.';
                            }
                        }
                        else {
                            $messageErreur = 'Ce motif de fermeture est introuvable.';
                        }
                    }
                }
                else {
                    //on peut procéder à la suppression
                    $datasSuppression = $this->trouverFormulaireAValider($datas, 'supprimer');
                    if (count($datasSuppression)) {
                        //on peut supprimer
                        $motifFermeture = $em->getRepository('ProcashAdministrationBundle:MotifFermeture')->find($datasSuppression[0]['id']);
                        if ($motifFermeture) {
                            $motifFermeture->setDateSuppression(new \DateTime());
                            $motifFermeture->setUtilisateur($this->get('security.context')->getToken()->getUser());
                            
                            $em->persist($motifFermeture);
                            $em->flush();
                            
                            $messageInfo = 'Motif de fermeture supprimé avec succès.';
                        }
                        else {
                            $messageErreur = 'Ce motif de fermeture est introuvable.';
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
            return $this->redirect($this->generateUrl('procash_motif_fermeture_liste'));
        }
        return array(
            'motifsFermeturesExistants' => $motifsFermeturesExistants,
            'form' => $form->createView(),
            'delaiSeuilFermeture' => $delaiSeuilFermeture
        );
    }
    
    private function trouverFormulaireAValider($tableau, $cle)
    {
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
    
    private function trouverInformationExistanteDansFormulaire($tableau, $cle, $valeur)
    {
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