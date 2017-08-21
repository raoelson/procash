<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\ProduitRepository")
 */
class Produit {

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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     */
    private $dateSuppression;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime", nullable=true)
     */
    private $dateModification;

   /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\ChiffreVente",mappedBy="produit")
     * @ORM\JoinColumn(name="chiffre_vente_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $chiffreVentes;
    
    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Redistribution",mappedBy="titreADistribuer")
     */
    private $redistributions;
    
    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\DetailFacturation",mappedBy="produit")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $detailFacturations;


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
     * Set libelle
     *
     * @param string $libelle
     * @return Produit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Produit
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Produit
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
     * @return Produit
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
     * @return Produit
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
     * @return Produit
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
     * Add redistributions
     *
     * @param \Procash\GestionBundle\Entity\Redistribution $redistributions
     * @return Produit
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
     * Add detailFacturations
     *
     * @param \Procash\GestionBundle\Entity\DetailFacturation $detailFacturations
     * @return Produit
     */
    public function addDetailFacturation(\Procash\GestionBundle\Entity\DetailFacturation $detailFacturations)
    {
        $this->detailFacturations[] = $detailFacturations;

        return $this;
    }

    /**
     * Remove detailFacturations
     *
     * @param \Procash\GestionBundle\Entity\DetailFacturation $detailFacturations
     */
    public function removeDetailFacturation(\Procash\GestionBundle\Entity\DetailFacturation $detailFacturations)
    {
        $this->detailFacturations->removeElement($detailFacturations);
    }

    /**
     * Get detailFacturations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDetailFacturations()
    {
        return $this->detailFacturations;
    }
}
