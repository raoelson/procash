<?php

namespace Procash\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * GestionVersion
 *
 * @ORM\Table(name="gestion_version")
 * @ORM\Entity(repositoryClass="Procash\AdministrationBundle\Entity\GestionVersionRepository")
 */
class GestionVersion
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
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    /**
     * @Assert\File(maxSize="6000000k")
     */
    public $file;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
    private $dateCreation;
    
   /**
     * @var string
     *
     * @ORM\Column(name="actif", type="boolean", length=255)
     */
    private $actif;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_suppression", type="datetime", nullable=true)
     */
    private $dateSuppression;
    
    public function getWebPath()
    {
        return null === $this->getVersion() ? null : $this->getUploadDir().'/'.$this->getVersion() ;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'version/apk';
    }
    
    public function uploadProfilePicture($numVersion)
    {
        $creationNomFile = explode('.',$this->file->getClientOriginalName());
        //renommer le fichier 
        $fileName = $numVersion.'.'.end($creationNomFile);
        // Nous utilisons le nom de fichier original, donc il est dans la pratique 
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité
        array_map('unlink', glob($this->getUploadRootDir()."/*"));
        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $fileName);

        // On sauvegarde le nom de fichier
        //$this->version = $this->file->getClientOriginalName();
        $this->setVersion($numVersion);
        
        // La propriété file ne servira plus
        $this->file = null;
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return GestionVersion
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
     * Set actif
     *
     * @param boolean $actif
     * @return GestionVersion
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return GestionVersion
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return GestionVersion
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
