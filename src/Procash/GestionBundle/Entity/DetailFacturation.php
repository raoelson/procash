<?php

namespace Procash\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetailFacturation
 *
 * @ORM\Table(name="detail_facturation")
 * @ORM\Entity(repositoryClass="Procash\GestionBundle\Entity\DetailFacturationRepository")
 */
class DetailFacturation
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
     * @ORM\Column(name="numero_facture", type="string", length=255)
     */
    private $numeroFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="commande", type="string", length=255)
     */
    private $commande;

    /**
     * @var string
     *
     * @ORM\Column(name="invendu", type="string", length=255)
     */
    private $invendu;

    /**
     * @var string
     *
     * @ORM\Column(name="regul", type="string", length=255)
     */
    private $regul;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255)
     */
    private $source;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_alimentation", type="datetime")
     */
    private $dateAlimentation;
    
    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Client",inversedBy="detailsFacturations")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id",nullable=true)
     */
    private $client;
    
    /**
     * @ORM\ManyToOne(targetEntity="Procash\AdministrationBundle\Entity\Produit",inversedBy="detailFacturations")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id",nullable=true)
     */
    private $produit;


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
     * Set numeroFacture
     *
     * @param string $numeroFacture
     * @return DetailFacturation
     */
    public function setNumeroFacture($numeroFacture)
    {
        $this->numeroFacture = $numeroFacture;

        return $this;
    }

    /**
     * Get numeroFacture
     *
     * @return string 
     */
    public function getNumeroFacture()
    {
        return $this->numeroFacture;
    }

    /**
     * Set commande
     *
     * @param string $commande
     * @return DetailFacturation
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return string 
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set invendu
     *
     * @param string $invendu
     * @return DetailFacturation
     */
    public function setInvendu($invendu)
    {
        $this->invendu = $invendu;

        return $this;
    }

    /**
     * Get invendu
     *
     * @return string 
     */
    public function getInvendu()
    {
        return $this->invendu;
    }

    /**
     * Set regul
     *
     * @param string $regul
     * @return DetailFacturation
     */
    public function setRegul($regul)
    {
        $this->regul = $regul;

        return $this;
    }

    /**
     * Get regul
     *
     * @return string 
     */
    public function getRegul()
    {
        return $this->regul;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return DetailFacturation
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return DetailFacturation
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
     * Set client
     *
     * @param \Procash\AdministrationBundle\Entity\Client $client
     * @return DetailFacturation
     */
    public function setClient(\Procash\AdministrationBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Procash\AdministrationBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set dateAlimentation
     *
     * @param \DateTime $dateAlimentation
     * @return DetailFacturation
     */
    public function setDateAlimentation($dateAlimentation)
    {
        $this->dateAlimentation = $dateAlimentation;

        return $this;
    }

    /**
     * Get dateAlimentation
     *
     * @return \DateTime 
     */
    public function getDateAlimentation()
    {
        return $this->dateAlimentation;
    }

    /**
     * Set produit
     *
     * @param \Procash\AdministrationBundle\Entity\Produit $produit
     * @return DetailFacturation
     */
    public function setProduit(\Procash\AdministrationBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Procash\AdministrationBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }
}
