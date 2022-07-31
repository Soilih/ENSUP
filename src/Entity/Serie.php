<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SerieRepository::class)
 */
class Serie
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
    private $libelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detail;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="serie")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=InformationBac::class, mappedBy="serie")
     */
    private $informationBacs;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->informationBacs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setSerie($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getSerie() === $this) {
                $user->setSerie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InformationBac[]
     */
    public function getInformationBacs(): Collection
    {
        return $this->informationBacs;
    }

    public function addInformationBac(InformationBac $informationBac): self
    {
        if (!$this->informationBacs->contains($informationBac)) {
            $this->informationBacs[] = $informationBac;
            $informationBac->setSerie($this);
        }

        return $this;
    }

    public function removeInformationBac(InformationBac $informationBac): self
    {
        if ($this->informationBacs->removeElement($informationBac)) {
            // set the owning side to null (unless already changed)
            if ($informationBac->getSerie() === $this) {
                $informationBac->setSerie(null);
            }
        }

        return $this;
    }

}

    


