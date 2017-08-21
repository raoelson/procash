<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banque
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\BanqueRepository")
 */
class Banque
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
     * @ORM\Column(name="code_interne", type="string", length=255)
     */
    private $codeInterne;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_externe", type="string", length=255)
     */
    private $refExterne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     */
    private $dateSuppression;

     /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Facturation",mappedBy="banque")
     * @ORM\JoinColumn(name="facturation_id", referencedColumnName="id",nullable=true)
     */
    private $facturations;

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
     * Set codeInterne
     *
     * @param string $codeInterne
     * @return Banque
     */
    public function setCodeInterne($codeInterne)
    {
        $this->codeInterne = $codeInterne;

        return $this;
    }

    /**
     * Get codeInterne
     *
     * @return string 
     */
    public function getCodeInterne()
    {
        return $this->codeInterne;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Banque
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
     * Set refExterne
     *
     * @param string $refExterne
     * @return Banque
     */
    public function setRefExterne($refExterne)
    {
        $this->refExterne = $refExterne;

        return $this;
    }

    /**
     * Get refExterne
     *
     * @return string 
     */
    public function getRefExterne()
    {
        return $this->refExterne;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return Banque
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
     * Constructor
     */
    public function __construct()
    {
        $this->facturations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add facturations
     *
     * @param \Procash\GestionBundle\Entity\Facturation $facturations
     * @return Banque
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
