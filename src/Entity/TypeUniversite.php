<?php

namespace App\Entity;

use App\Repository\TypeUniversiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeUniversiteRepository::class)
 */
class TypeUniversite
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
     * @ORM\OneToMany(targetEntity=Flux::class, mappedBy="typeUniversite")
     */
    private $fluxes;

    /**
     * @ORM\OneToMany(targetEntity=FluxSortant::class, mappedBy="typeuniversite")
     */
    private $fluxSortants;

    /**
     * @ORM\OneToMany(targetEntity=ParcoursUniversitaire::class, mappedBy="typeUniversite")
     */
    private $parcoursUniversitaires;

    /**
     * @ORM\OneToMany(targetEntity=Diplome::class, mappedBy="typeuniversite")
     */
    private $diplomes;

    public function __construct()
    {
      
        $this->fluxes = new ArrayCollection();
        $this->fluxSortants = new ArrayCollection();
        $this->parcoursUniversitaires = new ArrayCollection();
        $this->diplomes = new ArrayCollection();
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

   
    /**
     * @return Collection|Flux[]
     */
    public function getFluxes(): Collection
    {
        return $this->fluxes;
    }

    public function addFlux(Flux $flux): self
    {
        if (!$this->fluxes->contains($flux)) {
            $this->fluxes[] = $flux;
            $flux->setTypeUniversite($this);
        }

        return $this;
    }

    public function removeFlux(Flux $flux): self
    {
        if ($this->fluxes->removeElement($flux)) {
            // set the owning side to null (unless already changed)
            if ($flux->getTypeUniversite() === $this) {
                $flux->setTypeUniversite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FluxSortant[]
     */
    public function getFluxSortants(): Collection
    {
        return $this->fluxSortants;
    }

    public function addFluxSortant(FluxSortant $fluxSortant): self
    {
        if (!$this->fluxSortants->contains($fluxSortant)) {
            $this->fluxSortants[] = $fluxSortant;
            $fluxSortant->setTypeuniversite($this);
        }

        return $this;
    }

    public function removeFluxSortant(FluxSortant $fluxSortant): self
    {
        if ($this->fluxSortants->removeElement($fluxSortant)) {
            // set the owning side to null (unless already changed)
            if ($fluxSortant->getTypeuniversite() === $this) {
                $fluxSortant->setTypeuniversite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ParcoursUniversitaire[]
     */
    public function getParcoursUniversitaires(): Collection
    {
        return $this->parcoursUniversitaires;
    }

    public function addParcoursUniversitaire(ParcoursUniversitaire $parcoursUniversitaire): self
    {
        if (!$this->parcoursUniversitaires->contains($parcoursUniversitaire)) {
            $this->parcoursUniversitaires[] = $parcoursUniversitaire;
            $parcoursUniversitaire->setTypeUniversite($this);
        }

        return $this;
    }

    public function removeParcoursUniversitaire(ParcoursUniversitaire $parcoursUniversitaire): self
    {
        if ($this->parcoursUniversitaires->removeElement($parcoursUniversitaire)) {
            // set the owning side to null (unless already changed)
            if ($parcoursUniversitaire->getTypeUniversite() === $this) {
                $parcoursUniversitaire->setTypeUniversite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Diplome[]
     */
    public function getDiplomes(): Collection
    {
        return $this->diplomes;
    }

    public function addDiplome(Diplome $diplome): self
    {
        if (!$this->diplomes->contains($diplome)) {
            $this->diplomes[] = $diplome;
            $diplome->setTypeuniversite($this);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): self
    {
        if ($this->diplomes->removeElement($diplome)) {
            // set the owning side to null (unless already changed)
            if ($diplome->getTypeuniversite() === $this) {
                $diplome->setTypeuniversite(null);
            }
        }

        return $this;
    }
}
