<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Titre
 *
 * @ORM\Table(name="titre")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\TitreRepository")
 */
class Titre
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
     * @ORM\Column(name="ref_titre", type="string", length=255)
     */
    private $refTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="periode", type="string", length=255)
     */
    private $periode;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite_minimum", type="float")
     */
    private $quantiteMinimum;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="string", length=255)
     */
    private $descriptif;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime",nullable=true)
     */
    private $dateSuppression;

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
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\ChiffreVente",mappedBy="produit")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $chiffreVentes;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chiffreVentes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set refTitre
     *
     * @param string $refTitre
     * @return Titre
     */
    public function setRefTitre($refTitre)
    {
        $this->refTitre = $refTitre;

        return $this;
    }

    /**
     * Get refTitre
     *
     * @return string 
     */
    public function getRefTitre()
    {
        return $this->refTitre;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Titre
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
     * Set periode
     *
     * @param string $periode
     * @return Titre
     */
    public function setPeriode($periode)
    {
        $this->periode = $periode;

        return $this;
    }

    /**
     * Get periode
     *
     * @return string 
     */
    public function getPeriode()
    {
        return $this->periode;
    }

    /**
     * Set quantiteMinimum
     *
     * @param float $quantiteMinimum
     * @return Titre
     */
    public function setQuantiteMinimum($quantiteMinimum)
    {
        $this->quantiteMinimum = $quantiteMinimum;

        return $this;
    }

    /**
     * Get quantiteMinimum
     *
     * @return float 
     */
    public function getQuantiteMinimum()
    {
        return $this->quantiteMinimum;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     * @return Titre
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return Titre
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Titre
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
     * @return Titre
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
     * Add chiffreVentes
     *
     * @param \Procash\GestionBundle\Entity\ChiffreVente $chiffreVentes
     * @return Titre
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

}
