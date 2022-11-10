<?php

namespace App\Entity;

use App\Repository\AuthentificationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthentificationRepository::class)
 */
class Authentification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $diplomes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $releve;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bac;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecreate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="authentifications")
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

    public function setReleve(?string $releve): self
    {
        $this->releve = $releve;

        return $this;
    }

    public function getBac(): ?string
    {
        return $this->bac;
    }

    public function setBac(?string $bac): self
    {
        $this->bac = $bac;

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
