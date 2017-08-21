<?php

namespace Procash\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisiFermeture
 *
 * @ORM\Table(name="saisi_fermeture")
 * @ORM\Entity(repositoryClass="Procash\GestionBundle\Entity\SaisiFermetureRepository")
 */
class SaisiFermeture
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_fermeture", type="datetime")
     */
    private $dateDebutFermeture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_fermeture", type="datetime")
     */
    private $dateFinFermeture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     */
    private $dateSuppression;   

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\MotifFermeture", inversedBy="saisieFermetures",cascade={"persist"})
     * @ORM\JoinColumn(name="motif_fermeture_id",nullable=true)
     */
    private $motifFermeture;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User", inversedBy="saisieFermetures",cascade={"persist"})
     * @ORM\JoinColumn(name="login_saisie_id",nullable=true)
     */
    private $login_saisie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_saisie", type="datetime", nullable=true)
     */
    private $dateHeureSaisie;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Client",inversedBy="fermetures")
     */
    private $client;
    
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
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Redistribution",mappedBy="fermeture")
     * @ORM\JoinColumn(name="redistribution_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $redistributions;


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
     * Constructor
     */
    public function __construct()
    {
        $this->redistributions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dateDebutFermeture
     *
     * @param \DateTime $dateDebutFermeture
     * @return SaisiFermeture
     */
    public function setDateDebutFermeture($dateDebutFermeture)
    {
        $this->dateDebutFermeture = $dateDebutFermeture;

        return $this;
    }

    /**
     * Get dateDebutFermeture
     *
     * @return \DateTime 
     */
    public function getDateDebutFermeture()
    {
        return $this->dateDebutFermeture;
    }

    /**
     * Set dateFinFermeture
     *
     * @param \DateTime $dateFinFermeture
     * @return SaisiFermeture
     */
    public function setDateFinFermeture($dateFinFermeture)
    {
        $this->dateFinFermeture = $dateFinFermeture;

        return $this;
    }

    /**
     * Get dateFinFermeture
     *
     * @return \DateTime 
     */
    public function getDateFinFermeture()
    {
        return $this->dateFinFermeture;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return SaisiFermeture
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
     * Set dateHeureSaisie
     *
     * @param \DateTime $dateHeureSaisie
     * @return SaisiFermeture
     */
    public function setDateHeureSaisie($dateHeureSaisie)
    {
        $this->dateHeureSaisie = $dateHeureSaisie;

        return $this;
    }

    /**
     * Get dateHeureSaisie
     *
     * @return \DateTime 
     */
    public function getDateHeureSaisie()
    {
        return $this->dateHeureSaisie;
    }

    /**
     * Set appVersion
     *
     * @param string $appVersion
     * @return SaisiFermeture
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
     * @return SaisiFermeture
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
     * @return SaisiFermeture
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
     * Set motifFermeture
     *
     * @param \Procash\AdministrationBundle\Entity\MotifFermeture $motifFermeture
     * @return SaisiFermeture
     */
    public function setMotifFermeture(\Procash\AdministrationBundle\Entity\MotifFermeture $motifFermeture = null)
    {
        $this->motifFermeture = $motifFermeture;

        return $this;
    }

    /**
     * Get motifFermeture
     *
     * @return \Procash\AdministrationBundle\Entity\MotifFermeture 
     */
    public function getMotifFermeture()
    {
        return $this->motifFermeture;
    }

    /**
     * Set login_saisie
     *
     * @param \Procash\UserBundle\Entity\User $loginSaisie
     * @return SaisiFermeture
     */
    public function setLoginSaisie(\Procash\UserBundle\Entity\User $loginSaisie = null)
    {
        $this->login_saisie = $loginSaisie;

        return $this;
    }

    /**
     * Get login_saisie
     *
     * @return \Procash\UserBundle\Entity\User 
     */
    public function getLoginSaisie()
    {
        return $this->login_saisie;
    }

    /**
     * Set client
     *
     * @param \Procash\AdministrationBundle\Entity\Client $client
     * @return SaisiFermeture
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
     * Add redistributions
     *
     * @param \Procash\GestionBundle\Entity\Redistribution $redistributions
     * @return SaisiFermeture
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
}
