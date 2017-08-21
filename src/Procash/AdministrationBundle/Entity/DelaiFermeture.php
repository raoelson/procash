<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DelaiFermeture
 *
 * @ORM\Table(name="delai_fermeture")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\DelaiFermetureRepository")
 */
class DelaiFermeture {

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
     * @var integer
     *
     * @ORM\Column(name="delai_min", type="integer")
     */
    private $delaiMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="seuil_max", type="integer")
     */
    private $seuilMax;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User",inversedBy="delaiFermetures",cascade={"persist"}))
     * @ORM\JoinColumn(nullable=true,name="utilisateur_id")
     */
    private $utilisateur;

       /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     */
    private $dateSuppression;   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return DelaiFermeture
     */
    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation() {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return DelaiFermeture
     */
    public function setDateModification($dateModification) {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification() {
        return $this->dateModification;
    }

    /**
     * Set delaiMax
     *
     * @param integer $delaiMax
     * @return DelaiFermeture
     */
    public function setDelaiMin($delaiMin) {
        $this->delaiMin = $delaiMin;

        return $this;
    }

    /**
     * Get delaiMax
     *
     * @return integer 
     */
    public function getDelaiMin() {
        return $this->delaiMin;
    }

    /**
     * Set seuilMin
     *
     * @param integer $seuilMin
     * @return DelaiFermeture
     */
    public function setSeuilMax($seuilMax) {
        $this->seuilMax = $seuilMax;

        return $this;
    }

    /**
     * Get seuilMin
     *
     * @return integer 
     */
    public function getSeuilMax() {
        return $this->seuilMax;
    }

    /**
     * Set utilisateur
     *
     * @param \Procash\UserBundle\Entity\User $utilisateur
     * @return DelaiFermeture
     */
    public function setUtilisateur(\Procash\UserBundle\Entity\User $utilisateur = null) {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Procash\UserBundle\Entity\User 
     */
    public function getUtilisateur() {
        return $this->utilisateur;
    }


    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return DelaiFermeture
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
}
