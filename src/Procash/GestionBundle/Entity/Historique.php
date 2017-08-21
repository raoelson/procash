<?php

namespace Procash\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Procash\GestionBundle\Entity\HistoriqueRepository")
 */
class Historique
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_num_commande", type="integer")
     */
    private $nombreNumCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_invendu", type="integer")
     */
    private $nombreInvendu;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_regul", type="integer")
     */
    private $nombreRegul;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fichier_source", type="string", length=255)
     */
    private $nomFichierSource;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_alimentation", type="datetime")
     */
    private $dateAlimentation;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_invendu_saisi", type="integer")
     */
    private $nombreInvenduSaisi;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_regul_saisi", type="integer", length=255)
     */
    private $nombreRegulSaisi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_saisie", type="datetime")
     */
    private $dateHeureSaisie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure_modification", type="datetime")
     */
    private $dateHeureModification;

 /**
     * @ORM\ManyToOne(targetEntity="Procash\UserBundle\Entity\User",inversedBy="historiques")
     * @ORM\JoinColumn(name="login_saisi_id", referencedColumnName="id",nullable=true)
     */
    private $login_saisi;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Historique
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
     * Set nombreNumCommande
     *
     * @param integer $nombreNumCommande
     * @return Historique
     */
    public function setNombreNumCommande($nombreNumCommande)
    {
        $this->nombreNumCommande = $nombreNumCommande;

        return $this;
    }

    /**
     * Get nombreNumCommande
     *
     * @return integer 
     */
    public function getNombreNumCommande()
    {
        return $this->nombreNumCommande;
    }

    /**
     * Set nombreInvendu
     *
     * @param integer $nombreInvendu
     * @return Historique
     */
    public function setNombreInvendu($nombreInvendu)
    {
        $this->nombreInvendu = $nombreInvendu;

        return $this;
    }

    /**
     * Get nombreInvendu
     *
     * @return integer 
     */
    public function getNombreInvendu()
    {
        return $this->nombreInvendu;
    }

    /**
     * Set nombreRegul
     *
     * @param integer $nombreRegul
     * @return Historique
     */
    public function setNombreRegul($nombreRegul)
    {
        $this->nombreRegul = $nombreRegul;

        return $this;
    }

    /**
     * Get nombreRegul
     *
     * @return integer 
     */
    public function getNombreRegul()
    {
        return $this->nombreRegul;
    }

    /**
     * Set nomFichierSource
     *
     * @param string $nomFichierSource
     * @return Historique
     */
    public function setNomFichierSource($nomFichierSource)
    {
        $this->nomFichierSource = $nomFichierSource;

        return $this;
    }

    /**
     * Get nomFichierSource
     *
     * @return string 
     */
    public function getNomFichierSource()
    {
        return $this->nomFichierSource;
    }

    /**
     * Set dateAlimentation
     *
     * @param \DateTime $dateAlimentation
     * @return Historique
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
     * Set nombreInvenduSaisi
     *
     * @param integer $nombreInvenduSaisi
     * @return Historique
     */
    public function setNombreInvenduSaisi($nombreInvenduSaisi)
    {
        $this->nombreInvenduSaisi = $nombreInvenduSaisi;

        return $this;
    }

    /**
     * Get nombreInvenduSaisi
     *
     * @return integer 
     */
    public function getNombreInvenduSaisi()
    {
        return $this->nombreInvenduSaisi;
    }


    /**
     * Set dateHeureSaisie
     *
     * @param \DateTime $dateHeureSaisie
     * @return Historique
     */
    public function setDateHeureSaisie($dateHeureSaisie)
    {
        $this->dateHeureSaisie = $dateHeureSaisie;

        return $this;
    }

    /**
     * Get dateHeureSaisie
     *
     * @return \DateTime 
     */
    public function getDateHeureSaisie()
    {
        return $this->dateHeureSaisie;
    }

    /**
     * Set dateHeureModification
     *
     * @param \DateTime $dateHeureModification
     * @return Historique
     */
    public function setDateHeureModification($dateHeureModification)
    {
        $this->dateHeureModification = $dateHeureModification;

        return $this;
    }

    /**
     * Get dateHeureModification
     *
     * @return \DateTime 
     */
    public function getDateHeureModification()
    {
        return $this->dateHeureModification;
    }

    /**
     * Set nombreRegulSaisi
     *
     * @param integer $nombreRegulSaisi
     * @return Historique
     */
    public function setNombreRegulSaisi($nombreRegulSaisi)
    {
        $this->nombreRegulSaisi = $nombreRegulSaisi;

        return $this;
    }

    /**
     * Get nombreRegulSaisi
     *
     * @return integer 
     */
    public function getNombreRegulSaisi()
    {
        return $this->nombreRegulSaisi;
    }

    /**
     * Set login_saisi
     *
     * @param \Procash\UserBundle\Entity\User $loginSaisi
     * @return Historique
     */
    public function setLoginSaisi(\Procash\UserBundle\Entity\User $loginSaisi = null)
    {
        $this->login_saisi = $loginSaisi;

        return $this;
    }

    /**
     * Get login_saisi
     *
     * @return \Procash\UserBundle\Entity\User 
     */
    public function getLoginSaisi()
    {
        return $this->login_saisi;
    }
}
