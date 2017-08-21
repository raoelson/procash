<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePaiement
 *
 * @ORM\Table(name="type_paiement")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\TypePaiementRepository")
 */
class TypePaiement
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
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     */
    private $dateSuppression;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime", nullable=true)
     */
    private $dateModification;
    
    /**
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User",inversedBy="typePaiements",cascade={"persist"}))
     * @ORM\JoinColumn(nullable=true,name="utilisateur_id")
     */
    private $utilisateur;


     /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Facturation",mappedBy="typePaiement")
     * @ORM\JoinColumn(name="facturation_id", referencedColumnName="id",nullable=true)
     */
    private $facturations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facturations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code
     * @return TypePaiement
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
     * Set libelle
     *
     * @param string $libelle
     * @return TypePaiement
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
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return TypePaiement
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
     * @return TypePaiement
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
     * @return TypePaiement
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
     * Set utilisateur
     *
     * @param \Procash\UserBundle\Entity\User $utilisateur
     * @return TypePaiement
     */
    public function setUtilisateur(\Procash\UserBundle\Entity\User $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Procash\UserBundle\Entity\User 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Add facturations
     *
     * @param \Procash\GestionBundle\Entity\Facturation $facturations
     * @return TypePaiement
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

    public function supprimable() {
        $sup = true;
        if (sizeof($this->facturations) != 0) {
            $sup = false;
        }
        return $sup;
    }

}
