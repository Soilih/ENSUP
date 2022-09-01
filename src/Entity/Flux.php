<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query;

/**
 * Flux
 *
 * @ORM\Table(name="flux", indexes={@ORM\Index(name="IDX_7252313AA76ED395", columns={"user_id"}) ,  @ORM\Index(name="IDX_7252313A5B4E0609", columns={"niveau_actuel_id"}) })
 * @ORM\Entity
 * 
 */
class Flux
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
     * @ORM\Column(name="depart", type="date", nullable=false)
     */
    private $depart;
   

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_arrive", type="date", nullable=true)
     */
    private $dateArrive;

    

    /**
     * @var string
     *
     * @ORM\Column(name="suggestion", type="text", length=0, nullable=false)
     */
    private $suggestion;

   

    /**
     * @var string|null
     *
     * @ORM\Column(name="projet", type="text", length=0, nullable=true)
     */
    private $projet;

    /**
     * @var \Niveau
     *
     * @ORM\ManyToOne(targetEntity="Niveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau_actuel_id", referencedColumnName="id")
     * })
     */
    private $niveauActuel;

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
     * @ORM\Column(type="text", nullable=true)
     */
    private $probleme;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cycle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $diplome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specialite;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDiplome::class, inversedBy="fluxes")
     */
    private $typediplome;

    

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepart(): ?\DateTimeInterface
    {
        return $this->depart;
    }

    public function setDepart(\DateTimeInterface $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    
    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->dateArrive;
    }

    public function setDateArrive(?\DateTimeInterface $dateArrive): self
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

   

    public function getSuggestion(): ?string
    {
        return $this->suggestion;
    }

    public function setSuggestion(string $suggestion): self
    {
        $this->suggestion = $suggestion;

        return $this;
    }

   

    public function getProjet(): ?string
    {
        return $this->projet;
    }

    public function setProjet(?string $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    

    public function getNiveauActuel(): ?Niveau
    {
        return $this->niveauActuel;
    }

    public function setNiveauActuel(?Niveau $niveauActuel): self
    {
        $this->niveauActuel = $niveauActuel;

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

    public function getProbleme(): ?string
    {
        return $this->probleme;
    }

    public function setProbleme(?string $probleme): self
    {
        $this->probleme = $probleme;

        return $this;
    }

   

    public function getCycle(): ?string
    {
        return $this->cycle;
    }

    public function setCycle(string $cycle): self
    {
        $this->cycle = $cycle;

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

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getTypediplome(): ?TypeDiplome
    {
        return $this->typediplome;
    }

    public function setTypediplome(?TypeDiplome $typediplome): self
    {
        $this->typediplome = $typediplome;

        return $this;
    }
}
