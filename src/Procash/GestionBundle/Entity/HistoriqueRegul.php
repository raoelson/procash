<?php

namespace Procash\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriqueRegul
 *
 * @ORM\Table(name="historique_regul")
 * @ORM\Entity(repositoryClass="Procash\GestionBundle\Entity\HistoriqueRegulRepository")
 */
class HistoriqueRegul
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
     * @var integer
     *
     * @ORM\Column(name="nombre_commande", type="integer")
     */
    private $nombreCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="regul", type="integer")
     */
    private $regul;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="invendu", type="integer")
     */
    private $invendu;

    /**
     * @var string
     *
     * @ORM\Column(name="login_saisi", type="string", length=255)
     */
    private $loginSaisi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_saisie", type="datetime")
     */
    private $dateSaisie;

    /**
     * @ORM\ManyToOne(targetEntity="Procash\GestionBundle\Entity\ChiffreVente",inversedBy="historiques")
     * @ORM\JoinColumn(name="parent_cv_id", referencedColumnName="id",nullable=true)
     */
    private $parentCv;


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
     * Set nombreCommande
     *
     * @param integer $nombreCommande
     * @return HistoriqueRegul
     */
    public function setNombreCommande($nombreCommande)
    {
        $this->nombreCommande = $nombreCommande;

        return $this;
    }

    /**
     * Get nombreCommande
     *
     * @return integer 
     */
    public function getNombreCommande()
    {
        return $this->nombreCommande;
    }

    /**
     * Set regul
     *
     * @param integer $regul
     * @return HistoriqueRegul
     */
    public function setRegul($regul)
    {
        $this->regul = $regul;

        return $this;
    }

    /**
     * Get regul
     *
     * @return integer 
     */
    public function getRegul()
    {
        return $this->regul;
    }

    /**
     * Set invendu
     *
     * @param integer $invendu
     * @return HistoriqueRegul
     */
    public function setInvendu($invendu)
    {
        $this->invendu = $invendu;

        return $this;
    }

    /**
     * Get invendu
     *
     * @return integer 
     */
    public function getInvendu()
    {
        return $this->invendu;
    }

    /**
     * Set loginSaisi
     *
     * @param string $loginSaisi
     * @return HistoriqueRegul
     */
    public function setLoginSaisi($loginSaisi)
    {
        $this->loginSaisi = $loginSaisi;

        return $this;
    }

    /**
     * Get loginSaisi
     *
     * @return string 
     */
    public function getLoginSaisi()
    {
        return $this->loginSaisi;
    }

    /**
     * Set dateSaisie
     *
     * @param \DateTime $dateSaisie
     * @return HistoriqueRegul
     */
    public function setDateSaisie($dateSaisie)
    {
        $this->dateSaisie = $dateSaisie;

        return $this;
    }

    /**
     * Get dateSaisie
     *
     * @return \DateTime 
     */
    public function getDateSaisie()
    {
        return $this->dateSaisie;
    }

    /**
     * Set parentCv
     *
     * @param \Procash\GestionBundle\Entity\ChiffreVente $parentCv
     * @return HistoriqueRegul
     */
    public function setParentCv(\Procash\GestionBundle\Entity\ChiffreVente $parentCv = null)
    {
        $this->parentCv = $parentCv;

        return $this;
    }

    /**
     * Get parentCv
     *
     * @return \Procash\GestionBundle\Entity\ChiffreVente 
     */
    public function getParentCv()
    {
        return $this->parentCv;
    }
}
