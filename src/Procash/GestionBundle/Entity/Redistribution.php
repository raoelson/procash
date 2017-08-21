<?php

namespace Procash\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Redistribution
 *
 * @ORM\Table(name="redistribution")
 * @ORM\Entity(repositoryClass="Procash\GestionBundle\Entity\RedistributionRepository")
 */
class Redistribution {

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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="commande_saisie", type="integer")
     */
    private $commandeSaisie;

     /**
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User",inversedBy="redistributions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=true)
     */
    private $loginSaisi;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Client",inversedBy="redistribues")
     * @ORM\JoinColumn(name="client_a_redistribue_id", referencedColumnName="id",nullable=true)
     */
    private $clientRedistribue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_saisie", type="datetime")
     */
    private $dateHeureSaisie;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Client",inversedBy="redistributions")
     * @ORM\JoinColumn(name="client_remplacement_id", referencedColumnName="id",nullable=true)
     */
    private $clientRemplace;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Produit",inversedBy="redistributions")
     * @ORM\JoinColumn(name="titre_a_distribuer_id", referencedColumnName="id",nullable=true)
     */
    private $titreADistribuer;

     /**
     * @var datetime
     *
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     *
     */
    private $dateSuppression;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\GestionBundle\Entity\SaisiFermeture",inversedBy="redistributions")
     * @ORM\JoinColumn(name="fermeture_id", referencedColumnName="id",nullable=true)
     */
    private $fermeture;


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
     * Set date
     *
     * @param \DateTime $date
     * @return Redistribution
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
     * Set commandeSaisie
     *
     * @param integer $commandeSaisie
     * @return Redistribution
     */
    public function setCommandeSaisie($commandeSaisie)
    {
        $this->commandeSaisie = $commandeSaisie;

        return $this;
    }

    /**
     * Get commandeSaisie
     *
     * @return integer 
     */
    public function getCommandeSaisie()
    {
        return $this->commandeSaisie;
    }

    /**
     * Set dateHeureSaisie
     *
     * @param \DateTime $dateHeureSaisie
     * @return Redistribution
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
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return Redistribution
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
     * Set loginSaisi
     *
     * @param \Procash\UserBundle\Entity\User $loginSaisi
     * @return Redistribution
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
     * Set clientRedistribue
     *
     * @param \Procash\AdministrationBundle\Entity\Client $clientRedistribue
     * @return Redistribution
     */
    public function setClientRedistribue(\Procash\AdministrationBundle\Entity\Client $clientRedistribue = null)
    {
        $this->clientRedistribue = $clientRedistribue;

        return $this;
    }

    /**
     * Get clientRedistribue
     *
     * @return \Procash\AdministrationBundle\Entity\Client 
     */
    public function getClientRedistribue()
    {
        return $this->clientRedistribue;
    }

    /**
     * Set clientRemplace
     *
     * @param \Procash\AdministrationBundle\Entity\Client $clientRemplace
     * @return Redistribution
     */
    public function setClientRemplace(\Procash\AdministrationBundle\Entity\Client $clientRemplace = null)
    {
        $this->clientRemplace = $clientRemplace;

        return $this;
    }

    /**
     * Get clientRemplace
     *
     * @return \Procash\AdministrationBundle\Entity\Client 
     */
    public function getClientRemplace()
    {
        return $this->clientRemplace;
    }

    /**
     * Set titreADistribuer
     *
     * @param \Procash\AdministrationBundle\Entity\Produit $titreADistribuer
     * @return Redistribution
     */
    public function setTitreADistribuer(\Procash\AdministrationBundle\Entity\Produit $titreADistribuer = null)
    {
        $this->titreADistribuer = $titreADistribuer;

        return $this;
    }

    /**
     * Get titreADistribuer
     *
     * @return \Procash\AdministrationBundle\Entity\Produit 
     */
    public function getTitreADistribuer()
    {
        return $this->titreADistribuer;
    }

    /**
     * Set fermeture
     *
     * @param \Procash\GestionBundle\Entity\SaisiFermeture $fermeture
     * @return Redistribution
     */
    public function setFermeture(\Procash\GestionBundle\Entity\SaisiFermeture $fermeture = null)
    {
        $this->fermeture = $fermeture;

        return $this;
    }

    /**
     * Get fermeture
     *
     * @return \Procash\GestionBundle\Entity\SaisiFermeture 
     */
    public function getFermeture()
    {
        return $this->fermeture;
    }
}
