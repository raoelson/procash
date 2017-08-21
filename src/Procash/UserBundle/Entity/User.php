<?php

namespace Procash\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\AttributeOverride;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="UserRepository")
 * @AttributeOverrides({
 *     @AttributeOverride(name="username",
 *         column=@ORM\Column(
 *             name="username",
 *             type="string",
 *             length=255,
 *             unique=false
 * 
 *         )
 *     ),
 *     @AttributeOverride(name="usernameCanonical",
 *         column=@ORM\Column(
 *             name="usernameCanonical",
 *             type="string",
 *             length=255,
 *             unique=false
 *         )
 *     ),
 * })
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Veuillez entrez votre nom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     * 	    min=3,
     * 	    max=32,
     * 	    minMessage="Le nom est trop court.",
     * 	    maxMessage="Le nom est trop long.",
     * 	    groups={"Registration", "Profile"}
     * )
     */
    private $nom;

   /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez entrez votre prenom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     * 	    min=3,
     * 	    max=32,
     * 	    minMessage="Le prenom est trop court.",
     * 	    maxMessage="Le prenom est trop long.",
     * 	    groups={"Registration", "Profile"}
     * )
     */
    private $prenom;


    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=true)
     *
     */
    private $role;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     *
     */
    private $dateCreation;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     *
     */
    private $dateSuppression;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_modification", type="datetime", nullable=true)
     *
     */
    private $dateModification;
    
    /**
     * @ORM\OneToMany(targetEntity="Procash\AdministrationBundle\Entity\DelaiFermeture",mappedBy="utilisateur")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $delaiFermetures;
    
    /**
     * @ORM\OneToMany(targetEntity="Procash\AdministrationBundle\Entity\MotifFermeture",mappedBy="utilisateur")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $motifFermetures;
    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Redistribution",mappedBy="loginSaisi")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $redistributions;
    
    /**
     * @ORM\OneToMany(targetEntity="Procash\AdministrationBundle\Entity\TypePaiement",mappedBy="utilisateur")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $typePaiements;
    
    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Profil",inversedBy="utilisateurs")
     */
    private $profil;

    /**
     * @var boolean
     * @ORM\Column(name="profil_administrateur", type="boolean", nullable=true)
     */
    private $profilAdministrateur;

    /**
     * @var boolean
     * @ORM\Column(name="profil_collecteur", type="boolean", nullable=true)
     */
    private $profilCollecteur;

    /**
     * @var boolean
     * @ORM\Column(name="profil_operateur", type="boolean", nullable=true)
     */
    private $profilOperateur;

    /**
     * @var boolean
     * @ORM\Column(name="profil_gestionnaire", type="boolean", nullable=true)
     */
    private $profilGestionnaire;

     /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Reseau",inversedBy="utilisateurs")
     */
    private $reseau;

    /**    private $utilisateur;

     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\SaisiFermeture",mappedBy="login_saisie")
     *
     * @ORM\JoinColumn(name="saisie_fermeture_id", referencedColumnName="id", nullable=true)
     */
    private $saisieFermetures;

    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Historique",mappedBy="login_saisi")
     * @ORM\JoinColumn(name="historique_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $historiques;

    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\ChiffreVente",mappedBy="loginSaisi")
     * @ORM\JoinColumn(name="detail_chiffre_vente_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $chiffreVentes;
    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\ChiffreVente",mappedBy="loginSaisiModif")
     * @ORM\JoinColumn(name="detail_chiffre_vente_modif_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $chiffreVentesModifs;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", nullable=true)
     *
     */
    private $telephone;
    
     /**
     * @var string
     *
     * @ORM\Column(name="telephone_portable", type="string", nullable=true)
     *
     */
    private $telephonePortable;
    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Facturation",mappedBy="loginSaisi")
     *
     * @ORM\JoinColumn(name="facturation_id", referencedColumnName="id", nullable=true)
     */
    private $facturations;
    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Facturation",mappedBy="loginModifSaisi")
     *
     * @ORM\JoinColumn(name="facturation_modif_id", referencedColumnName="id", nullable=true)
     */
    private $facturationsModif;

    /**
     * Constructor
     */
    public function __construct()
    {
          parent::__construct();
    }
 


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return User
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return User
     */
    public function setDateSuppression($dateSuppression)
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }

    /**
     * Get dateSuppression
     *
     * @return \DateTime 
     */
    public function getDateSuppression()
    {
        return $this->dateSuppression;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return User
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set profilAdministrateur
     *
     * @param boolean $profilAdministrateur
     * @return User
     */
    public function setProfilAdministrateur($profilAdministrateur)
    {
        $this->profilAdministrateur = $profilAdministrateur;

        return $this;
    }

    /**
     * Get profilAdministrateur
     *
     * @return boolean 
     */
    public function getProfilAdministrateur()
    {
        return $this->profilAdministrateur;
    }

    /**
     * Set profilCollecteur
     *
     * @param boolean $profilCollecteur
     * @return User
     */
    public function setProfilCollecteur($profilCollecteur)
    {
        $this->profilCollecteur = $profilCollecteur;

        return $this;
    }

    /**
     * Get profilCollecteur
     *
     * @return boolean 
     */
    public function getProfilCollecteur()
    {
        return $this->profilCollecteur;
    }

    /**
     * Set profilOperateur
     *
     * @param boolean $profilOperateur
     * @return User
     */
    public function setProfilOperateur($profilOperateur)
    {
        $this->profilOperateur = $profilOperateur;

        return $this;
    }

    /**
     * Get profilOperateur
     *
     * @return boolean 
     */
    public function getProfilOperateur()
    {
        return $this->profilOperateur;
    }

    /**
     * Set profilGestionnaire
     *
     * @param boolean $profilGestionnaire
     * @return User
     */
    public function setProfilGestionnaire($profilGestionnaire)
    {
        $this->profilGestionnaire = $profilGestionnaire;

        return $this;
    }

    /**
     * Get profilGestionnaire
     *
     * @return boolean 
     */
    public function getProfilGestionnaire()
    {
        return $this->profilGestionnaire;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set telephonePortable
     *
     * @param string $telephonePortable
     * @return User
     */
    public function setTelephonePortable($telephonePortable)
    {
        $this->telephonePortable = $telephonePortable;

        return $this;
    }

    /**
     * Get telephonePortable
     *
     * @return string 
     */
    public function getTelephonePortable()
    {
        return $this->telephonePortable;
    }

    /**
     * Add delaiFermetures
     *
     * @param \Procash\AdministrationBundle\Entity\DelaiFermeture $delaiFermetures
     * @return User
     */
    public function addDelaiFermeture(\Procash\AdministrationBundle\Entity\DelaiFermeture $delaiFermetures)
    {
        $this->delaiFermetures[] = $delaiFermetures;

        return $this;
    }

    /**
     * Remove delaiFermetures
     *
     * @param \Procash\AdministrationBundle\Entity\DelaiFermeture $delaiFermetures
     */
    public function removeDelaiFermeture(\Procash\AdministrationBundle\Entity\DelaiFermeture $delaiFermetures)
    {
        $this->delaiFermetures->removeElement($delaiFermetures);
    }

    /**
     * Get delaiFermetures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDelaiFermetures()
    {
        return $this->delaiFermetures;
    }

    /**
     * Add motifFermetures
     *
     * @param \Procash\AdministrationBundle\Entity\MotifFermeture $motifFermetures
     * @return User
     */
    public function addMotifFermeture(\Procash\AdministrationBundle\Entity\MotifFermeture $motifFermetures)
    {
        $this->motifFermetures[] = $motifFermetures;

        return $this;
    }

    /**
     * Remove motifFermetures
     *
     * @param \Procash\AdministrationBundle\Entity\MotifFermeture $motifFermetures
     */
    public function removeMotifFermeture(\Procash\AdministrationBundle\Entity\MotifFermeture $motifFermetures)
    {
        $this->motifFermetures->removeElement($motifFermetures);
    }

    /**
     * Get motifFermetures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMotifFermetures()
    {
        return $this->motifFermetures;
    }

    /**
     * Add typePaiements
     *
     * @param \Procash\AdministrationBundle\Entity\TypePaiement $typePaiements
     * @return User
     */
    public function addTypePaiement(\Procash\AdministrationBundle\Entity\TypePaiement $typePaiements)
    {
        $this->typePaiements[] = $typePaiements;

        return $this;
    }

    /**
     * Remove typePaiements
     *
     * @param \Procash\AdministrationBundle\Entity\TypePaiement $typePaiements
     */
    public function removeTypePaiement(\Procash\AdministrationBundle\Entity\TypePaiement $typePaiements)
    {
        $this->typePaiements->removeElement($typePaiements);
    }

    /**
     * Get typePaiements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypePaiements()
    {
        return $this->typePaiements;
    }

    /**
     * Set profil
     *
     * @param \Procash\AdministrationBundle\Entity\Profil $profil
     * @return User
     */
    public function setProfil(\Procash\AdministrationBundle\Entity\Profil $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \Procash\AdministrationBundle\Entity\Profil 
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set reseau
     *
     * @param \Procash\AdministrationBundle\Entity\Reseau $reseau
     * @return User
     */
    public function setReseau(\Procash\AdministrationBundle\Entity\Reseau $reseau = null)
    {
        $this->reseau = $reseau;

        return $this;
    }

    /**
     * Get reseau
     *
     * @return \Procash\AdministrationBundle\Entity\Reseau 
     */
    public function getReseau()
    {
        return $this->reseau;
    }

    /**
     * Add saisieFermetures
     *
     * @param \Procash\GestionBundle\Entity\SaisiFermeture $saisieFermetures
     * @return User
     */
    public function addSaisieFermeture(\Procash\GestionBundle\Entity\SaisiFermeture $saisieFermetures)
    {
        $this->saisieFermetures[] = $saisieFermetures;

        return $this;
    }

    /**
     * Remove saisieFermetures
     *
     * @param \Procash\GestionBundle\Entity\SaisiFermeture $saisieFermetures
     */
    public function removeSaisieFermeture(\Procash\GestionBundle\Entity\SaisiFermeture $saisieFermetures)
    {
        $this->saisieFermetures->removeElement($saisieFermetures);
    }

    /**
     * Get saisieFermetures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSaisieFermetures()
    {
        return $this->saisieFermetures;
    }

    /**
     * Add historiques
     *
     * @param \Procash\GestionBundle\Entity\Historique $historiques
     * @return User
     */
    public function addHistorique(\Procash\GestionBundle\Entity\Historique $historiques)
    {
        $this->historiques[] = $historiques;

        return $this;
    }

    /**
     * Remove historiques
     *
     * @param \Procash\GestionBundle\Entity\Historique $historiques
     */
    public function removeHistorique(\Procash\GestionBundle\Entity\Historique $historiques)
    {
        $this->historiques->removeElement($historiques);
    }

    /**
     * Get historiques
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHistoriques()
    {
        return $this->historiques;
    }

    /**
     * Add chiffreVentes
     *
     * @param \Procash\GestionBundle\Entity\ChiffreVente $chiffreVentes
     * @return User
     */
    public function addChiffreVente(\Procash\GestionBundle\Entity\ChiffreVente $chiffreVentes)
    {
        $this->chiffreVentes[] = $chiffreVentes;

        return $this;
    }

    /**
     * Remove chiffreVentes
     *
     * @param \Procash\GestionBundle\Entity\ChiffreVente $chiffreVentes
     */
    public function removeChiffreVente(\Procash\GestionBundle\Entity\ChiffreVente $chiffreVentes)
    {
        $this->chiffreVentes->removeElement($chiffreVentes);
    }

    /**
     * Get chiffreVentes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChiffreVentes()
    {
        return $this->chiffreVentes;
    }

    /**
     * Add facturations
     *
     * @param \Procash\GestionBundle\Entity\Facturation $facturations
     * @return User
     */
    public function addFacturation(\Procash\GestionBundle\Entity\Facturation $facturations)
    {
        $this->facturations[] = $facturations;

        return $this;
    }

    /**
     * Remove facturations
     *
     * @param \Procash\GestionBundle\Entity\Facturation $facturations
     */
    public function removeFacturation(\Procash\GestionBundle\Entity\Facturation $facturations)
    {
        $this->facturations->removeElement($facturations);
    }

    /**
     * Get facturations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturations()
    {
        return $this->facturations;
    }

    /**
     * Add chiffreVentesModifs
     *
     * @param \Procash\GestionBundle\Entity\ChiffreVente $chiffreVentesModifs
     * @return User
     */
    public function addChiffreVentesModif(\Procash\GestionBundle\Entity\ChiffreVente $chiffreVentesModifs)
    {
        $this->chiffreVentesModifs[] = $chiffreVentesModifs;

        return $this;
    }

    /**
     * Remove chiffreVentesModifs
     *
     * @param \Procash\GestionBundle\Entity\ChiffreVente $chiffreVentesModifs
     */
    public function removeChiffreVentesModif(\Procash\GestionBundle\Entity\ChiffreVente $chiffreVentesModifs)
    {
        $this->chiffreVentesModifs->removeElement($chiffreVentesModifs);
    }

    /**
     * Get chiffreVentesModifs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChiffreVentesModifs()
    {
        return $this->chiffreVentesModifs;
    }

    /**
     * Add redistributions
     *
     * @param \Procash\GestionBundle\Entity\Redistribution $redistributions
     * @return User
     */
    public function addRedistribution(\Procash\GestionBundle\Entity\Redistribution $redistributions)
    {
        $this->redistributions[] = $redistributions;

        return $this;
    }

    /**
     * Remove redistributions
     *
     * @param \Procash\GestionBundle\Entity\Redistribution $redistributions
     */
    public function removeRedistribution(\Procash\GestionBundle\Entity\Redistribution $redistributions)
    {
        $this->redistributions->removeElement($redistributions);
    }

    /**
     * Get redistributions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedistributions()
    {
        return $this->redistributions;
    }

    /**
     * Add facturationsModif
     *
     * @param \Procash\GestionBundle\Entity\Facturation $facturationsModif
     * @return User
     */
    public function addFacturationsModif(\Procash\GestionBundle\Entity\Facturation $facturationsModif)
    {
        $this->facturationsModif[] = $facturationsModif;

        return $this;
    }

    /**
     * Remove facturationsModif
     *
     * @param \Procash\GestionBundle\Entity\Facturation $facturationsModif
     */
    public function removeFacturationsModif(\Procash\GestionBundle\Entity\Facturation $facturationsModif)
    {
        $this->facturationsModif->removeElement($facturationsModif);
    }

    /**
     * Get facturationsModif
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturationsModif()
    {
        return $this->facturationsModif;
    }
}
