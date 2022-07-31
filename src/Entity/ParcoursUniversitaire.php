<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * ParcoursUniversitaire
 *
 * @ORM\Table(name="parcours_universitaire", indexes={ @ORM\Index(name="IDX_996FC494A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_996FC494B3E9C81", columns={"niveau_id"})})
 * @ORM\Entity
 * 
 */
class ParcoursUniversitaire
{
    /**
     * 
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
     * @ORM\Column(name="anne_inscription", type="date", nullable=false)
     */
    private $anneInscription;

    /**
     * @var string
     *
     * @ORM\Column(name="filiere", type="string", length=255, nullable=false)
     */
    private $filiere;

    /**
     * @var string
     *
     * @ORM\Column(name="mention", type="string", length=255, nullable=false)
     */
    private $mention;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=255, nullable=false)
     */
    private $fichier;

    

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=255, nullable=false)
     */
    private $detail;

    /**
     * @var string
     *
     * @ORM\Column(name="moyenne", type="string", length=255, nullable=false)
     */
    private $moyenne;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_univeriste", type="string", length=255, nullable=false)
     */
    private $titreUniveriste;

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
     * @var \Niveau
     *
     * @ORM\ManyToOne(targetEntity="Niveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau_id", referencedColumnName="id")
     * })
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity=TypeUniversite::class, inversedBy="parcoursUniversitaires")
     */
    private $typeUniversite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeCursus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneInscription(): ?\DateTimeInterface
    {
        return $this->anneInscription;
    }

    public function setAnneInscription(\DateTimeInterface $anneInscription): self
    {
        $this->anneInscription = $anneInscription;

        return $this;
    }

    public function getFiliere(): ?string
    {
        return $this->filiere;
    }

    public function setFiliere(string $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getMention(): ?string
    {
        return $this->mention;
    }

    public function setMention(string $mention): self
    {
        $this->mention = $mention;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(string $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    public function getMoyenne(): ?string
    {
        return $this->moyenne;
    }

    public function setMoyenne(string $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    public function getTitreUniveriste(): ?string
    {
        return $this->titreUniveriste;
    }

    public function setTitreUniveriste(string $titreUniveriste): self
    {
        $this->titreUniveriste = $titreUniveriste;

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


    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

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

    public function getTypeUniversite(): ?TypeUniversite
    {
        return $this->typeUniversite;
    }

    public function setTypeUniversite(?TypeUniversite $typeUniversite): self
    {
        $this->typeUniversite = $typeUniversite;

        return $this;
    }

    public function getTypeCursus(): ?string
    {
        return $this->typeCursus;
    }

    public function setTypeCursus(string $typeCursus): self
    {
        $this->typeCursus = $typeCursus;

        return $this;
    }


}
