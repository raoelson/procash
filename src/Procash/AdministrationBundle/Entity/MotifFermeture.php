<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotifFermeture
 *
 * @ORM\Table(name="motif_fermeture")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\MotifFermetureRepository")
 */
class MotifFermeture
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
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User",inversedBy="motifFermetures",cascade={"persist"}))
     * @ORM\JoinColumn(nullable=true,name="utilisateur_id")
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\SaisiFermeture",mappedBy="motifFermeture")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $saisieFermetures;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->saisieFermetures = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return MotifFermeture
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return MotifFermeture
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
     * @return MotifFermeture
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
     * @return MotifFermeture
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
     * @return MotifFermeture
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
     * Add saisieFermetures
     *
     * @param \Procash\GestionBundle\Entity\SaisiFermeture $saisieFermetures
     * @return MotifFermeture
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
     * Set code
     *
     * @param string $code
     * @return MotifFermeture
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
}
