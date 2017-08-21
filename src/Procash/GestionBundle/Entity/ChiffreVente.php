<?php

namespace Procash\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChiffreVente
 *
 * @ORM\Table(name="chiffre_vente")
 * @ORM\Entity(repositoryClass="Procash\GestionBundle\Entity\ChiffreVenteRepository")
 */
class ChiffreVente {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_num_commande", type="integer",nullable=true)
     */
    private $nombreNumCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_invendu", type="integer",nullable=true)
     */
    private $nombreInvendu;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_regul", type="integer",nullable=true)
     */
    private $nombreRegul;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fichier", type="string", length=255,nullable=true)
     */
    private $nomFichier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date",nullable=true)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_mis_a_jour", type="datetime",nullable=true)
     */
    private $dateMisAJour;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_invendu_saisi", type="integer",nullable=true)
     */
    private $nombreInvenduSaisi;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_regul_saisi", type="integer",nullable=true)
     */
    private $nombreRegulSaisi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_saisi", type="datetime",nullable=true)
     */
    private $dateHeureSaisi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime",nullable=true)
     */
    private $dateModification;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_vendu", type="integer",nullable=true)
     */
    private $nombreVendu;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Client",inversedBy="chiffreVentes")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id",nullable=true)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Produit",inversedBy="chiffreVentes")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id",nullable=true)
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Reseau",inversedBy="chiffreVentes")
     * @ORM\JoinColumn(name="reseau_id", referencedColumnName="id",nullable=true)
     */
    private $reseau;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User",inversedBy="chiffreVentes")
     * @ORM\JoinColumn(name="login_saisi_id", referencedColumnName="id",nullable=true)
     */
    private $loginSaisi;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User",inversedBy="chiffreVentesModifs")
     * @ORM\JoinColumn(name="login_saisi_modif_id", referencedColumnName="id",nullable=true)
     */
    private $loginSaisiModif;

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
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\HistoriqueRegul",mappedBy="parentCv")
     * @ORM\JoinColumn(name="historique_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $historiques;

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
     * Set nombreNumCommande
     *
     * @param integer $nombreNumCommande
     * @return ChiffreVente
     */
    public function setNombreNumCommande($nombreNumCommande)
    {
        $this->nombreNumCommande = $nombreNumCommande;

        return $this;
    }

    /**
     * Get nombreNumCommande
     *
     * @return integer 
     */
    public function getNombreNumCommande()
    {
        return $this->nombreNumCommande;
    }

    /**
     * Set nombreInvendu
     *
     * @param integer $nombreInvendu
     * @return ChiffreVente
     */
    public function setNombreInvendu($nombreInvendu)
    {
        $this->nombreInvendu = $nombreInvendu;

        return $this;
    }

    /**
     * Get nombreInvendu
     *
     * @return integer 
     */
    public function getNombreInvendu()
    {
        return $this->nombreInvendu;
    }

    /**
     * Set nombreRegul
     *
     * @param integer $nombreRegul
     * @return ChiffreVente
     */
    public function setNombreRegul($nombreRegul)
    {
        $this->nombreRegul = $nombreRegul;

        return $this;
    }

    /**
     * Get nombreRegul
     *
     * @return integer 
     */
    public function getNombreRegul()
    {
        return $this->nombreRegul;
    }

    /**
     * Set nomFichier
     *
     * @param string $nomFichier
     * @return ChiffreVente
     */
    public function setNomFichier($nomFichier)
    {
        $this->nomFichier = $nomFichier;

        return $this;
    }

    /**
     * Get nomFichier
     *
     * @return string 
     */
    public function getNomFichier()
    {
        return $this->nomFichier;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return ChiffreVente
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
     * Set dateMisAJour
     *
     * @param \DateTime $dateMisAJour
     * @return ChiffreVente
     */
    public function setDateMisAJour($dateMisAJour)
    {
        $this->dateMisAJour = $dateMisAJour;

        return $this;
    }

    /**
     * Get dateMisAJour
     *
     * @return \DateTime 
     */
    public function getDateMisAJour()
    {
        return $this->dateMisAJour;
    }

    /**
     * Set nombreInvenduSaisi
     *
     * @param integer $nombreInvenduSaisi
     * @return ChiffreVente
     */
    public function setNombreInvenduSaisi($nombreInvenduSaisi)
    {
        $this->nombreInvenduSaisi = $nombreInvenduSaisi;

        return $this;
    }

    /**
     * Get nombreInvenduSaisi
     *
     * @return integer 
     */
    public function getNombreInvenduSaisi()
    {
        return $this->nombreInvenduSaisi;
    }

    /**
     * Set nombreRegulSaisi
     *
     * @param integer $nombreRegulSaisi
     * @return ChiffreVente
     */
    public function setNombreRegulSaisi($nombreRegulSaisi)
    {
        $this->nombreRegulSaisi = $nombreRegulSaisi;

        return $this;
    }

    /**
     * Get nombreRegulSaisi
     *
     * @return integer 
     */
    public function getNombreRegulSaisi()
    {
        return $this->nombreRegulSaisi;
    }

    /**
     * Set dateHeureSaisi
     *
     * @param \DateTime $dateHeureSaisi
     * @return ChiffreVente
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
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return ChiffreVente
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
     * Set nombreVendu
     *
     * @param integer $nombreVendu
     * @return ChiffreVente
     */
    public function setNombreVendu($nombreVendu)
    {
        $this->nombreVendu = $nombreVendu;

        return $this;
    }

    /**
     * Get nombreVendu
     *
     * @return integer 
     */
    public function getNombreVendu()
    {
        return $this->nombreVendu;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return ChiffreVente
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
     * @return ChiffreVente
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
     * @return ChiffreVente
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
     * @return ChiffreVente
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
     * @return ChiffreVente
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
     * @return ChiffreVente
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
     * Set produit
     *
     * @param \Procash\AdministrationBundle\Entity\Produit $produit
     * @return ChiffreVente
     */
    public function setProduit(\Procash\AdministrationBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Procash\AdministrationBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set reseau
     *
     * @param \Procash\AdministrationBundle\Entity\Reseau $reseau
     * @return ChiffreVente
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
     * Set loginSaisi
     *
     * @param \Procash\UserBundle\Entity\User $loginSaisi
     * @return ChiffreVente
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
     * Set loginSaisiModif
     *
     * @param \Procash\UserBundle\Entity\User $loginSaisiModif
     * @return ChiffreVente
     */
    public function setLoginSaisiModif(\Procash\UserBundle\Entity\User $loginSaisiModif = null)
    {
        $this->loginSaisiModif = $loginSaisiModif;

        return $this;
    }

    /**
     * Get loginSaisiModif
     *
     * @return \Procash\UserBundle\Entity\User 
     */
    public function getLoginSaisiModif()
    {
        return $this->loginSaisiModif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->historiques = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add historiques
     *
     * @param \Procash\GestionBundle\Entity\HistoriqueRegul $historiques
     * @return ChiffreVente
     */
    public function addHistorique(\Procash\GestionBundle\Entity\HistoriqueRegul $historiques)
    {
        $this->historiques[] = $historiques;

        return $this;
    }

    /**
     * Remove historiques
     *
     * @param \Procash\GestionBundle\Entity\HistoriqueRegul $historiques
     */
    public function removeHistorique(\Procash\GestionBundle\Entity\HistoriqueRegul $historiques)
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
}
