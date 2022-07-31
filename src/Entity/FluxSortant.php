<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * FluxSortant
 *
 * @ORM\Table(name="flux_sortant", indexes={@ORM\Index(name="IDX_97076445F74A28F3", columns={"typeuniversite_id"}), @ORM\Index(name="IDX_970764457F3310E7", columns={"composant_id"}), @ORM\Index(name="IDX_97076445B3E9C81", columns={"niveau_id"}), @ORM\Index(name="IDX_97076445A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class FluxSortant 
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
     * @ORM\Column(name="date_depart", type="date", nullable=false)
     */
    private $dateDepart;
    /**
     * @var string
     *
     * @ORM\Column(name="filiere", type="string", length=255, nullable=false)
     */
    private $filiere;
    /**
     * @var string
     *
     * @ORM\Column(name="motivation", type="string", length=255, nullable=false)
     */
    private $motivation;

    

    /**
     * @var \Composant
     *
     * @ORM\ManyToOne(targetEntity="Composant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="composant_id", referencedColumnName="id")
     * })
     */
    private $composant;

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
     * @var \TypeUniversite
     *
     * @ORM\ManyToOne(targetEntity="TypeUniversite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="typeuniversite_id", referencedColumnName="id")
     * })
     */
    private $typeuniversite;

    

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
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $universite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $moyen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cycle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeuniversit;

    public function getId(): ?int
    {
        return $this->id;
    }

   

  
    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

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

   

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }

   

    public function getComposant(): ?Composant
    {
        return $this->composant;
    }

    public function setComposant(?Composant $composant): self
    {
        $this->composant = $composant;

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

    public function getTypeuniversite(): ?TypeUniversite
    {
        return $this->typeuniversite;
    }

    public function setTypeuniversite(?TypeUniversite $typeuniversite): self
    {
        $this->typeuniversite = $typeuniversite;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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

    public function getUniversite(): ?string
    {
        return $this->universite;
    }

    public function setUniversite(string $universite): self
    {
        $this->universite = $universite;

        return $this;
    }

    public function getMoyen(): ?string
    {
        return $this->moyen;
    }

    public function setMoyen(string $moyen): self
    {
        $this->moyen = $moyen;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getTypeuniversit(): ?string
    {
        return $this->typeuniversit;
    }

    public function setTypeuniversit(?string $typeuniversit): self
    {
        $this->typeuniversit = $typeuniversit;

        return $this;
    }
}
