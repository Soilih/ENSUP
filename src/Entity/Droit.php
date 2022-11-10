<?php

namespace App\Entity;

use App\Repository\DroitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DroitRepository::class)
 */
class Droit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $inscription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hebergement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $diplomes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $releve;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $charge;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $passport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $visa;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecreate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="droits")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reference;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInscription(): ?string
    {
        return $this->inscription;
    }

    public function setInscription(?string $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getHebergement(): ?string
    {
        return $this->hebergement;
    }

    public function setHebergement(?string $hebergement): self
    {
        $this->hebergement = $hebergement;

        return $this;
    }

    public function getDiplomes(): ?string
    {
        return $this->diplomes;
    }

    public function setDiplomes(string $diplomes): self
    {
        $this->diplomes = $diplomes;

        return $this;
    }

    public function getReleve(): ?string
    {
        return $this->releve;
    }

    public function setReleve(string $releve): self
    {
        $this->releve = $releve;

        return $this;
    }

    public function getCharge(): ?string
    {
        return $this->charge;
    }

    public function setCharge(string $charge): self
    {
        $this->charge = $charge;

        return $this;
    }

    public function getPassport(): ?string
    {
        return $this->passport;
    }

    public function setPassport(?string $passport): self
    {
        $this->passport = $passport;

        return $this;
    }

    public function getVisa(): ?string
    {
        return $this->visa;
    }

    public function setVisa(string $visa): self
    {
        $this->visa = $visa;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDatecreate(): ?\DateTimeInterface
    {
        return $this->datecreate;
    }

    public function setDatecreate(?\DateTimeInterface $datecreate): self
    {
        $this->datecreate = $datecreate;

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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}
