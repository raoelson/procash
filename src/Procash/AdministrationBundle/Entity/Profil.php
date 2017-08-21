<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profil
 *
 * @ORM\Table(name="profil")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\ProfilRepository")
 */
class Profil
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime",nullable=true)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime",nullable=true)
     */
    private $dateSuppression;


    /**
     * @ORM\OneToMany(targetEntity="Procash\UserBundle\Entity\User",mappedBy="profil")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $utilisateurs;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255,nullable=true)
     */
    private $code;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateCreation = new \DateTime();
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
     * @return Profil
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
     * @return Profil
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
     * @return Profil
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
     * Set code
     *
     * @param string $code
     * @return Profil
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
     * Add utilisateurs
     *
     * @param \Procash\UserBundle\Entity\User $utilisateurs
     * @return Profil
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
}
