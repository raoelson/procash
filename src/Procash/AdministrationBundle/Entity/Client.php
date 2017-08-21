<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\ClientRepository")
 */
class Client
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255,nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255,nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=255,nullable=true)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_sociale", type="string", length=255,nullable=true)
     */
    private $raisonSociale;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255,nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="complement_adresse", type="string", length=255,nullable=true)
     */
    private $complementAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postale", type="string", length=255,nullable=true)
     */
    private $codePostale;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255,nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255,nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="telephone", type="integer",nullable=true)
     */
    private $telephone;

    /**
     * @var integer
     *
     * @ORM\Column(name="fax", type="integer",nullable=true)
     */
    private $fax;

    /**
     * @var integer
     *
     * @ORM\Column(name="portable", type="integer",nullable=true)
     */
    private $portable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime",nullable=true)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime",nullable=true)
     */
    private $dateModification;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime",nullable=true)
     */
    private $dateSuppression;


     /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\ChiffreVente",mappedBy="client")
     * @ORM\JoinColumn(name="chiffre_vente_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $chiffreVentes;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Reseau",inversedBy="clients")
     */
    private $reseau;

    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Facturation",mappedBy="client")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $facturations;

    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\DetailFacturation",mappedBy="client")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $detailsFacturations;

    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\SaisiFermeture",mappedBy="client")
     * @ORM\JoinColumn(name="fermeture_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $fermetures;

   /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Redistribution",mappedBy="clientRedistribue")
     * @ORM\JoinColumn(name="redistribue_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $redistribues;

    /**
     * @ORM\OneToMany(targetEntity="Procash\AdministrationBundle\Entity\RemplacementClient",mappedBy="client")
     * @ORM\JoinColumn(name="client_remplacement_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $remplacementClients;

    /**
     * @ORM\OneToMany(targetEntity="Procash\AdministrationBundle\Entity\RemplacementClient",mappedBy="clientRemplacement")
     * @ORM\JoinColumn(name="numero_client_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $clientRemplacements;

    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Redistribution",mappedBy="clientRemplace")
     * @ORM\JoinColumn(name="redistrinution_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $redistributions;

    /**
     * @var string
     *
     * @ORM\Column(name="code_client", type="string", length=255,nullable=true,unique=true)
     */
    private $codeClient;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chiffreVentes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->facturations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fermetures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->redistribues = new \Doctrine\Common\Collections\ArrayCollection();
        $this->remplacementClients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clientRemplacements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->redistributions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Client
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
     * @return Client
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
     * Set civilite
     *
     * @param string $civilite
     * @return Client
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string 
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set raisonSociale
     *
     * @param string $raisonSociale
     * @return Client
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string 
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Client
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set complementAdresse
     *
     * @param string $complementAdresse
     * @return Client
     */
    public function setComplementAdresse($complementAdresse)
    {
        $this->complementAdresse = $complementAdresse;

        return $this;
    }

    /**
     * Get complementAdresse
     *
     * @return string 
     */
    public function getComplementAdresse()
    {
        return $this->complementAdresse;
    }

    /**
     * Set codePostale
     *
     * @param string $codePostale
     * @return Client
     */
    public function setCodePostale($codePostale)
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    /**
     * Get codePostale
     *
     * @return string 
     */
    public function getCodePostale()
    {
        return $this->codePostale;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Client
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     * @return Client
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     * @return Client
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return integer 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set portable
     *
     * @param integer $portable
     * @return Client
     */
    public function setPortable($portable)
    {
        $this->portable = $portable;

        return $this;
    }

    /**
     * Get portable
     *
     * @return integer 
     */
    public function getPortable()
    {
        return $this->portable;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Client
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
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return Client
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
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return Client
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
     * Add chiffreVentes
     *
     * @param \Procash\GestionBundle\Entity\ChiffreVente $chiffreVentes
     * @return Client
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
     * Set reseau
     *
     * @param \Procash\AdministrationBundle\Entity\Reseau $reseau
     * @return Client
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
     * Add facturations
     *
     * @param \Procash\GestionBundle\Entity\Facturation $facturations
     * @return Client
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
     * Add fermetures
     *
     * @param \Procash\GestionBundle\Entity\SaisiFermeture $fermetures
     * @return Client
     */
    public function addFermeture(\Procash\GestionBundle\Entity\SaisiFermeture $fermetures)
    {
        $this->fermetures[] = $fermetures;

        return $this;
    }

    /**
     * Remove fermetures
     *
     * @param \Procash\GestionBundle\Entity\SaisiFermeture $fermetures
     */
    public function removeFermeture(\Procash\GestionBundle\Entity\SaisiFermeture $fermetures)
    {
        $this->fermetures->removeElement($fermetures);
    }

    /**
     * Get fermetures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFermetures()
    {
        return $this->fermetures;
    }

    /**
     * Add redistribues
     *
     * @param \Procash\GestionBundle\Entity\Redistribution $redistribues
     * @return Client
     */
    public function addRedistribue(\Procash\GestionBundle\Entity\Redistribution $redistribues)
    {
        $this->redistribues[] = $redistribues;

        return $this;
    }

    /**
     * Remove redistribues
     *
     * @param \Procash\GestionBundle\Entity\Redistribution $redistribues
     */
    public function removeRedistribue(\Procash\GestionBundle\Entity\Redistribution $redistribues)
    {
        $this->redistribues->removeElement($redistribues);
    }

    /**
     * Get redistribues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedistribues()
    {
        return $this->redistribues;
    }

    /**
     * Add remplacementClients
     *
     * @param \Procash\AdministrationBundle\Entity\RemplacementClient $remplacementClients
     * @return Client
     */
    public function addRemplacementClient(\Procash\AdministrationBundle\Entity\RemplacementClient $remplacementClients)
    {
        $this->remplacementClients[] = $remplacementClients;

        return $this;
    }

    /**
     * Remove remplacementClients
     *
     * @param \Procash\AdministrationBundle\Entity\RemplacementClient $remplacementClients
     */
    public function removeRemplacementClient(\Procash\AdministrationBundle\Entity\RemplacementClient $remplacementClients)
    {
        $this->remplacementClients->removeElement($remplacementClients);
    }

    /**
     * Get remplacementClients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRemplacementClients()
    {
        return $this->remplacementClients;
    }

    /**
     * Add clientRemplacements
     *
     * @param \Procash\AdministrationBundle\Entity\RemplacementClient $clientRemplacements
     * @return Client
     */
    public function addClientRemplacement(\Procash\AdministrationBundle\Entity\RemplacementClient $clientRemplacements)
    {
        $this->clientRemplacements[] = $clientRemplacements;

        return $this;
    }

    /**
     * Remove clientRemplacements
     *
     * @param \Procash\AdministrationBundle\Entity\RemplacementClient $clientRemplacements
     */
    public function removeClientRemplacement(\Procash\AdministrationBundle\Entity\RemplacementClient $clientRemplacements)
    {
        $this->clientRemplacements->removeElement($clientRemplacements);
    }

    /**
     * Get clientRemplacements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientRemplacements()
    {
        return $this->clientRemplacements;
    }

    /**
     * Add redistributions
     *
     * @param \Procash\GestionBundle\Entity\Redistribution $redistributions
     * @return Client
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
     * Add detailsFacturations
     *
     * @param \Procash\GestionBundle\Entity\DetailFacturation $detailsFacturations
     * @return Client
     */
    public function addDetailsFacturation(\Procash\GestionBundle\Entity\DetailFacturation $detailsFacturations)
    {
        $this->detailsFacturations[] = $detailsFacturations;

        return $this;
    }

    /**
     * Remove detailsFacturations
     *
     * @param \Procash\GestionBundle\Entity\DetailFacturation $detailsFacturations
     */
    public function removeDetailsFacturation(\Procash\GestionBundle\Entity\DetailFacturation $detailsFacturations)
    {
        $this->detailsFacturations->removeElement($detailsFacturations);
    }

    /**
     * Get detailsFacturations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDetailsFacturations()
    {
        return $this->detailsFacturations;
    }

    /**
     * Set codeClient
     *
     * @param string $codeClient
     * @return Client
     */
    public function setCodeClient($codeClient)
    {
        $this->codeClient = $codeClient;

        return $this;
    }

    /**
     * Get codeClient
     *
     * @return string 
     */
    public function getCodeClient()
    {
        return $this->codeClient;
    }
}
