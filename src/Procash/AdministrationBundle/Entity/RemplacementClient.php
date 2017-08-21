<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RemplacementClient
 *
 * @ORM\Table(name="remplacement_client")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\RemplacementClientRepository")
 */
class RemplacementClient {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_ordre", type="integer")
     */
    private $numeroOrdre;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Client",inversedBy="remplacementClients",cascade={"persist"}))
     * @ORM\JoinColumn(nullable=true,name="client_id")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Client",inversedBy="clientRemplacements",cascade={"persist"}))
     * @ORM\JoinColumn(nullable=true,name="numero_client_remplacement_id")
     */
    private $clientRemplacement;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255)
     */
    private $source;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_alimentation", type="datetime")
     */
    private $dateAlimentation;

    /**
     * @ORM\OneToMany(targetEntity="Procash\GestionBundle\Entity\Redistribution",mappedBy="clientRemplace")
     * @ORM\JoinColumn(name="redistribution_id", referencedColumnName="id",nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $redistributions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime",nullable=true)
     */
    private $dateSuppression;

    /**
     * Constructor
     */
    public function __construct() {
        $this->redistributions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set numeroOrdre
     *
     * @param integer $numeroOrdre
     * @return RemplacementClient
     */
    public function setNumeroOrdre($numeroOrdre) {
        $this->numeroOrdre = $numeroOrdre;

        return $this;
    }

    /**
     * Get numeroOrdre
     *
     * @return integer 
     */
    public function getNumeroOrdre() {
        return $this->numeroOrdre;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return RemplacementClient
     */
    public function setSource($source) {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource() {
        return $this->source;
    }

    /**
     * Set dateAlimentation
     *
     * @param \DateTime $dateAlimentation
     * @return RemplacementClient
     */
    public function setDateAlimentation($dateAlimentation) {
        $this->dateAlimentation = $dateAlimentation;

        return $this;
    }

    /**
     * Get dateAlimentation
     *
     * @return \DateTime 
     */
    public function getDateAlimentation() {
        return $this->dateAlimentation;
    }

    /**
     * Set client
     *
     * @param \Procash\AdministrationBundle\Entity\Client $client
     * @return RemplacementClient
     */
    public function setClient(\Procash\AdministrationBundle\Entity\Client $client = null) {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Procash\AdministrationBundle\Entity\Client 
     */
    public function getClient() {
        return $this->client;
    }

    /**
     * Set clientRemplacement
     *
     * @param \Procash\AdministrationBundle\Entity\Client $clientRemplacement
     * @return RemplacementClient
     */
    public function setClientRemplacement(\Procash\AdministrationBundle\Entity\Client $clientRemplacement = null) {
        $this->clientRemplacement = $clientRemplacement;

        return $this;
    }

    /**
     * Get clientRemplacement
     *
     * @return \Procash\AdministrationBundle\Entity\Client 
     */
    public function getClientRemplacement() {
        return $this->clientRemplacement;
    }

    /**
     * Add redistributions
     *
     * @param \Procash\GestionBundle\Entity\Redistribution $redistributions
     * @return RemplacementClient
     */
    public function addRedistribution(\Procash\GestionBundle\Entity\Redistribution $redistributions) {
        $this->redistributions[] = $redistributions;

        return $this;
    }

    /**
     * Remove redistributions
     *
     * @param \Procash\GestionBundle\Entity\Redistribution $redistributions
     */
    public function removeRedistribution(\Procash\GestionBundle\Entity\Redistribution $redistributions) {
        $this->redistributions->removeElement($redistributions);
    }

    /**
     * Get redistributions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedistributions() {
        return $this->redistributions;
    }


    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return RemplacementClient
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
