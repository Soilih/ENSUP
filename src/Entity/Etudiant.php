<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use   Doctrine\ORM\Query;

/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant", indexes={ @ORM\Index(name="IDX_717E22E3A76ED395", columns={"user_id"})})
 * @ORM\Entity
 * 
 */
class Etudiant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=false)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_naissance", type="string", length=255, nullable=false)
     */
    private $lieuNaissance;


    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

   

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255, nullable=false)
     */
    private $nationalite;

    

    /**
     * @var string
     *
     * @ORM\Column(name="ile", type="string", length=255, nullable=false)
     */
    private $ile;

   

    /**
     * @var string
     *
     * @ORM\Column(name="type_identite", type="string", length=255, nullable=false)
     */
    private $typeIdentite;

    

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255, nullable=false)
     */
    private $sexe;

   
    
    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etatcivile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telUrgence;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDelivrance;

    /**
     * @ORM\Column(type="date")
     */
    private $dateExpiration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NumCarteidentite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pieceidentite;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cv;
    public function getId(): ?int
    {
        return $this->id;
    }
    

   

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

   

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

   

    public function getIle(): ?string
    {
        return $this->ile;
    }

    public function setIle(string $ile): self
    {
        $this->ile = $ile;

        return $this;
    }

   

    public function getTypeIdentite(): ?string
    {
        return $this->typeIdentite;
    }

    public function setTypeIdentite(string $typeIdentite): self
    {
        $this->typeIdentite = $typeIdentite;

        return $this;
    }

    

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    

  

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    
   

    public function __toString() {
        return $this->name;
    }

    public function getEtatcivile(): ?string
    {
        return $this->etatcivile;
    }

    public function setEtatcivile(string $etatcivile): self
    {
        $this->etatcivile = $etatcivile;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getTelUrgence(): ?string
    {
        return $this->telUrgence;
    }

    public function setTelUrgence(string $telUrgence): self
    {
        $this->telUrgence = $telUrgence;

        return $this;
    }

    public function getDateDelivrance(): ?\DateTimeInterface
    {
        return $this->dateDelivrance;
    }

    public function setDateDelivrance(\DateTimeInterface $dateDelivrance): self
    {
        $this->dateDelivrance = $dateDelivrance;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): self
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    public function getNumCarteidentite(): ?string
    {
        return $this->NumCarteidentite;
    }

    public function setNumCarteidentite(string $NumCarteidentite): self
    {
        $this->NumCarteidentite = $NumCarteidentite;

        return $this;
    }

    public function getPieceidentite(): ?string
    {
        return $this->Pieceidentite;
    }

    public function setPieceidentite(string $Pieceidentite): self
    {
        $this->Pieceidentite = $Pieceidentite;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }
   

     

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

}
