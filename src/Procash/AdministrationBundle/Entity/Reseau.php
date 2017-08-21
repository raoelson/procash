<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reseau
 *
 * @ORM\Table(name="reseau")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\ReseauRepository")
 */
class Reseau
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;
    
    /**
     * @var string
     *
     * @ORM\Column(name="code_reseau", type="string", length=255)
     */
    private $codeReseau;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_edition", type="datetime",nullable=true)
     */
    private $dateEdition;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime",nullable=true)
     */
    private $dateSuppression;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime",nullable=true)
     */
    private $dateModification;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime",nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\OneToMany(targetEntity="Procash\UserBundle\Entity\User",mappedBy="reseau")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $utilisateurs;

    /**
     * @ORM\OneToMany(targetEntity="Procash\AdministrationBundle\Entity\Client",mappedBy="reseau")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $clients;

    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\ChiffreVente",mappedBy="reseau")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $chiffreVentes;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clients = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Reseau
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
     * Set dateEdition
     *
     * @param \DateTime $dateEdition
     * @return Reseau
     */
    public function setDateEdition($dateEdition)
    {
        $this->dateEdition = $dateEdition;

        return $this;
    }

    /**
     * Get dateEdition
     *
     * @return \DateTime 
     */
    public function getDateEdition()
    {
        return $this->dateEdition;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return Reseau
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
     * @return Reseau
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Reseau
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
     * Add utilisateurs
     *
     * @param \Procash\UserBundle\Entity\User $utilisateurs
     * @return Reseau
     */
    public function addUtilisateur(\Procash\UserBundle\Entity\User $utilisateurs)
    {
        $this->utilisateurs[] = $utilisateurs;

        return $this;
    }

    /**
     * Remove utilisateurs
     *
     * @param \Procash\UserBundle\Entity\User $utilisateurs
     */
    public function removeUtilisateur(\Procash\UserBundle\Entity\User $utilisateurs)
    {
        $this->utilisateurs->removeElement($utilisateurs);
    }

    /**
     * Get utilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }

    /**
     * Add clients
     *
     * @param \Procash\AdministrationBundle\Entity\Client $clients
     * @return Reseau
     */
    public function addClient(\Procash\AdministrationBundle\Entity\Client $clients)
    {
        $this->clients[] = $clients;

        return $this;
    }

    /**
     * Remove clients
     *
     * @param \Procash\AdministrationBundle\Entity\Client $clients
     */
    public function removeClient(\Procash\AdministrationBundle\Entity\Client $clients)
    {
        $this->clients->removeElement($clients);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Add chiffreVentes
     *
     * @param \Procash\GestionBundle\Entity\ChiffreVente $chiffreVentes
     * @return Reseau
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
     * Set codeReseau
     *
     * @param string $codeReseau
     * @return Reseau
     */
    public function setCodeReseau($codeReseau)
    {
        $this->codeReseau = $codeReseau;

        return $this;
    }

    /**
     * Get codeReseau
     *
     * @return string 
     */
    public function getCodeReseau()
    {
        return $this->codeReseau;
    }
}
