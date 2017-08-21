<?php

namespace Procash\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facturation
 *
 * @ORM\Table(name="facturation")
 * @ORM\Entity(repositoryClass="Procash\GestionBundle\Entity\FacturationRepository")
 */
class Facturation
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
     * @ORM\Column(name="numero_facture", type="string", length=255, nullable =true)
     */
    private $numeroFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="type_facture", type="string", length=255, nullable =true)
     */
    private $typeFacture;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_facture", type="float", nullable =true)
     */
    private $montantFacture;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_encaisse", type="float", nullable =true)
     */
    private $montantEncaisse;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_avoir", type="float", nullable =true)
     */
    private $montantAvoir;

    /**
     * @var integer
     *
     * @ORM\Column(name="annee_facture", type="integer", nullable =true)
     */
    private $anneeFacture;

    /**
     * @var integer
     *
     * @ORM\Column(name="mois_facture", type="integer", nullable =true)
     */
    private $moisFacture;

    /**
     * @var integer
     *
     * @ORM\Column(name="jour_facture", type="integer", nullable =true)
     */
    private $jourFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255, nullable =true)
     */
    private $source;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable =true)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_alimentation", type="datetime", nullable =true)
     */
    private $dateAlimentation;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_encaisse_saisi", type="float", nullable =true)
     */
    private $montantEncaisseSaisi;
    /**
     * @var float
     *
     * @ORM\Column(name="montant_du", type="float", nullable =true)
     */
    private $montantDu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_saisi", type="datetime", nullable =true)
     */
    private $dateHeureSaisi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_modif", type="datetime", nullable =true)
     */
    private $dateHeureModif;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_cheque", type="string", length=255, nullable =true)
     */
    private $numeroCheque;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="echeance", type="datetime", nullable =true)
     */
    private $echeance;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_recu", type="string", length=255, nullable =true)
     */
    private $nomRecu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi_recu_email", type="datetime", nullable =true)
     */
    private $dateEnvoiRecuEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_impression_recu", type="datetime", nullable =true)
     */
    private $dateImpressionRecu;

    /**
     * @var string
     *
     * @ORM\Column(name="email_client", type="string", length=255, nullable =true)
     */
    private $emailClient;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Client",inversedBy="facturations")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id",nullable=true)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\TypePaiement",inversedBy="facturations")
     * @ORM\JoinColumn(name="type_paiement_id", referencedColumnName="id",nullable=true)
     */
    private $typePaiement;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Banque",inversedBy="facturations")
     * @ORM\JoinColumn(name="banque_id", referencedColumnName="id",nullable=true)
     */
    private $banque;

     /**
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User",inversedBy="facturations")
     * @ORM\JoinColumn(name="login_saisi_id", referencedColumnName="id",nullable=true)
     */
    private $loginSaisi;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User",inversedBy="facturationsModif")
     * @ORM\JoinColumn(name="login_saisi_modif_id", referencedColumnName="id",nullable=true)
     */
    private $loginModifSaisi;
    /**
     * @var datetime
     *
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     *
     */
    private $dateSuppression;
    
    /**
     * @var string
     *
     * @ORM\Column(name="app_version", type="string", length=255, nullable =true)
     */
    private $appVersion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=255, nullable =true)
     */
    private $mac;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description_sync", type="string", length=255, nullable =true)
     */
    private $descriptionSync;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_parent", type="integer",nullable=true)
     */
    private $idParent;


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
     * Set numeroFacture
     *
     * @param string $numeroFacture
     * @return Facturation
     */
    public function setNumeroFacture($numeroFacture)
    {
        $this->numeroFacture = $numeroFacture;

        return $this;
    }

    /**
     * Get numeroFacture
     *
     * @return string 
     */
    public function getNumeroFacture()
    {
        return $this->numeroFacture;
    }

    /**
     * Set typeFacture
     *
     * @param string $typeFacture
     * @return Facturation
     */
    public function setTypeFacture($typeFacture)
    {
        $this->typeFacture = $typeFacture;

        return $this;
    }

    /**
     * Get typeFacture
     *
     * @return string 
     */
    public function getTypeFacture()
    {
        return $this->typeFacture;
    }

    /**
     * Set montantFacture
     *
     * @param float $montantFacture
     * @return Facturation
     */
    public function setMontantFacture($montantFacture)
    {
        $this->montantFacture = $montantFacture;

        return $this;
    }

    /**
     * Get montantFacture
     *
     * @return float 
     */
    public function getMontantFacture()
    {
        return $this->montantFacture;
    }

    /**
     * Set montantEncaisse
     *
     * @param float $montantEncaisse
     * @return Facturation
     */
    public function setMontantEncaisse($montantEncaisse)
    {
        $this->montantEncaisse = $montantEncaisse;

        return $this;
    }

    /**
     * Get montantEncaisse
     *
     * @return float 
     */
    public function getMontantEncaisse()
    {
        return $this->montantEncaisse;
    }

    /**
     * Set montantAvoir
     *
     * @param float $montantAvoir
     * @return Facturation
     */
    public function setMontantAvoir($montantAvoir)
    {
        $this->montantAvoir = $montantAvoir;

        return $this;
    }

    /**
     * Get montantAvoir
     *
     * @return float 
     */
    public function getMontantAvoir()
    {
        return $this->montantAvoir;
    }

    /**
     * Set anneeFacture
     *
     * @param integer $anneeFacture
     * @return Facturation
     */
    public function setAnneeFacture($anneeFacture)
    {
        $this->anneeFacture = $anneeFacture;

        return $this;
    }

    /**
     * Get anneeFacture
     *
     * @return integer 
     */
    public function getAnneeFacture()
    {
        return $this->anneeFacture;
    }

    /**
     * Set moisFacture
     *
     * @param integer $moisFacture
     * @return Facturation
     */
    public function setMoisFacture($moisFacture)
    {
        $this->moisFacture = $moisFacture;

        return $this;
    }

    /**
     * Get moisFacture
     *
     * @return integer 
     */
    public function getMoisFacture()
    {
        return $this->moisFacture;
    }

    /**
     * Set jourFacture
     *
     * @param integer $jourFacture
     * @return Facturation
     */
    public function setJourFacture($jourFacture)
    {
        $this->jourFacture = $jourFacture;

        return $this;
    }

    /**
     * Get jourFacture
     *
     * @return integer 
     */
    public function getJourFacture()
    {
        return $this->jourFacture;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Facturation
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Facturation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateAlimentation
     *
     * @param \DateTime $dateAlimentation
     * @return Facturation
     */
    public function setDateAlimentation($dateAlimentation)
    {
        $this->dateAlimentation = $dateAlimentation;

        return $this;
    }

    /**
     * Get dateAlimentation
     *
     * @return \DateTime 
     */
    public function getDateAlimentation()
    {
        return $this->dateAlimentation;
    }

    /**
     * Set montantEncaisseSaisi
     *
     * @param float $montantEncaisseSaisi
     * @return Facturation
     */
    public function setMontantEncaisseSaisi($montantEncaisseSaisi)
    {
        $this->montantEncaisseSaisi = $montantEncaisseSaisi;

        return $this;
    }

    /**
     * Get montantEncaisseSaisi
     *
     * @return float 
     */
    public function getMontantEncaisseSaisi()
    {
        return $this->montantEncaisseSaisi;
    }

    /**
     * Set montantDu
     *
     * @param float $montantDu
     * @return Facturation
     */
    public function setMontantDu($montantDu)
    {
        $this->montantDu = $montantDu;

        return $this;
    }

    /**
     * Get montantDu
     *
     * @return float 
     */
    public function getMontantDu()
    {
        return $this->montantDu;
    }

    /**
     * Set dateHeureSaisi
     *
     * @param \DateTime $dateHeureSaisi
     * @return Facturation
     */
    public function setDateHeureSaisi($dateHeureSaisi)
    {
        $this->dateHeureSaisi = $dateHeureSaisi;

        return $this;
    }

    /**
     * Get dateHeureSaisi
     *
     * @return \DateTime 
     */
    public function getDateHeureSaisi()
    {
        return $this->dateHeureSaisi;
    }

    /**
     * Set dateHeureModif
     *
     * @param \DateTime $dateHeureModif
     * @return Facturation
     */
    public function setDateHeureModif($dateHeureModif)
    {
        $this->dateHeureModif = $dateHeureModif;

        return $this;
    }

    /**
     * Get dateHeureModif
     *
     * @return \DateTime 
     */
    public function getDateHeureModif()
    {
        return $this->dateHeureModif;
    }

    /**
     * Set numeroCheque
     *
     * @param string $numeroCheque
     * @return Facturation
     */
    public function setNumeroCheque($numeroCheque)
    {
        $this->numeroCheque = $numeroCheque;

        return $this;
    }

    /**
     * Get numeroCheque
     *
     * @return string 
     */
    public function getNumeroCheque()
    {
        return $this->numeroCheque;
    }

    /**
     * Set echeance
     *
     * @param \DateTime $echeance
     * @return Facturation
     */
    public function setEcheance($echeance)
    {
        $this->echeance = $echeance;

        return $this;
    }

    /**
     * Get echeance
     *
     * @return \DateTime 
     */
    public function getEcheance()
    {
        return $this->echeance;
    }

    /**
     * Set nomRecu
     *
     * @param string $nomRecu
     * @return Facturation
     */
    public function setNomRecu($nomRecu)
    {
        $this->nomRecu = $nomRecu;

        return $this;
    }

    /**
     * Get nomRecu
     *
     * @return string 
     */
    public function getNomRecu()
    {
        return $this->nomRecu;
    }

    /**
     * Set dateEnvoiRecuEmail
     *
     * @param \DateTime $dateEnvoiRecuEmail
     * @return Facturation
     */
    public function setDateEnvoiRecuEmail($dateEnvoiRecuEmail)
    {
        $this->dateEnvoiRecuEmail = $dateEnvoiRecuEmail;

        return $this;
    }

    /**
     * Get dateEnvoiRecuEmail
     *
     * @return \DateTime 
     */
    public function getDateEnvoiRecuEmail()
    {
        return $this->dateEnvoiRecuEmail;
    }

    /**
     * Set dateImpressionRecu
     *
     * @param \DateTime $dateImpressionRecu
     * @return Facturation
     */
    public function setDateImpressionRecu($dateImpressionRecu)
    {
        $this->dateImpressionRecu = $dateImpressionRecu;

        return $this;
    }

    /**
     * Get dateImpressionRecu
     *
     * @return \DateTime 
     */
    public function getDateImpressionRecu()
    {
        return $this->dateImpressionRecu;
    }

    /**
     * Set emailClient
     *
     * @param string $emailClient
     * @return Facturation
     */
    public function setEmailClient($emailClient)
    {
        $this->emailClient = $emailClient;

        return $this;
    }

    /**
     * Get emailClient
     *
     * @return string 
     */
    public function getEmailClient()
    {
        return $this->emailClient;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return Facturation
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
     * Set appVersion
     *
     * @param string $appVersion
     * @return Facturation
     */
    public function setAppVersion($appVersion)
    {
        $this->appVersion = $appVersion;

        return $this;
    }

    /**
     * Get appVersion
     *
     * @return string 
     */
    public function getAppVersion()
    {
        return $this->appVersion;
    }

    /**
     * Set mac
     *
     * @param string $mac
     * @return Facturation
     */
    public function setMac($mac)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * Get mac
     *
     * @return string 
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * Set descriptionSync
     *
     * @param string $descriptionSync
     * @return Facturation
     */
    public function setDescriptionSync($descriptionSync)
    {
        $this->descriptionSync = $descriptionSync;

        return $this;
    }

    /**
     * Get descriptionSync
     *
     * @return string 
     */
    public function getDescriptionSync()
    {
        return $this->descriptionSync;
    }

    /**
     * Set idParent
     *
     * @param integer $idParent
     * @return Facturation
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;

        return $this;
    }

    /**
     * Get idParent
     *
     * @return integer 
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * Set client
     *
     * @param \Procash\AdministrationBundle\Entity\Client $client
     * @return Facturation
     */
    public function setClient(\Procash\AdministrationBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Procash\AdministrationBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set typePaiement
     *
     * @param \Procash\AdministrationBundle\Entity\TypePaiement $typePaiement
     * @return Facturation
     */
    public function setTypePaiement(\Procash\AdministrationBundle\Entity\TypePaiement $typePaiement = null)
    {
        $this->typePaiement = $typePaiement;

        return $this;
    }

    /**
     * Get typePaiement
     *
     * @return \Procash\AdministrationBundle\Entity\TypePaiement 
     */
    public function getTypePaiement()
    {
        return $this->typePaiement;
    }

    /**
     * Set banque
     *
     * @param \Procash\AdministrationBundle\Entity\Banque $banque
     * @return Facturation
     */
    public function setBanque(\Procash\AdministrationBundle\Entity\Banque $banque = null)
    {
        $this->banque = $banque;

        return $this;
    }

    /**
     * Get banque
     *
     * @return \Procash\AdministrationBundle\Entity\Banque 
     */
    public function getBanque()
    {
        return $this->banque;
    }

    /**
     * Set loginSaisi
     *
     * @param \Procash\UserBundle\Entity\User $loginSaisi
     * @return Facturation
     */
    public function setLoginSaisi(\Procash\UserBundle\Entity\User $loginSaisi = null)
    {
        $this->loginSaisi = $loginSaisi;

        return $this;
    }

    /**
     * Get loginSaisi
     *
     * @return \Procash\UserBundle\Entity\User 
     */
    public function getLoginSaisi()
    {
        return $this->loginSaisi;
    }

    /**
     * Set loginModifSaisi
     *
     * @param \Procash\UserBundle\Entity\User $loginModifSaisi
     * @return Facturation
     */
    public function setLoginModifSaisi(\Procash\UserBundle\Entity\User $loginModifSaisi = null)
    {
        $this->loginModifSaisi = $loginModifSaisi;

        return $this;
    }

    /**
     * Get loginModifSaisi
     *
     * @return \Procash\UserBundle\Entity\User 
     */
    public function getLoginModifSaisi()
    {
        return $this->loginModifSaisi;
    }
}
