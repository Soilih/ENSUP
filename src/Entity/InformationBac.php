<?php

namespace App\Entity;

use App\Repository\InformationBacRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=InformationBacRepository::class)
 * @ORM\Entity
 * @Vich\Uploadable
 */
class InformationBac
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
    private $ecole;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $moyenne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mention;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $attestation;


    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $releve;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $session;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $cursus;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="informationBacs")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Serie::class, inversedBy="informationBacs")
     */
    private $serie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEcole(): ?string
    {
        return $this->ecole;
    }

    public function setEcole(string $ecole): self
    {
        $this->ecole = $ecole;

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

    public function getMention(): ?string
    {
        return $this->mention;
    }

    public function setMention(string $mention): self
    {
        $this->mention = $mention;

        return $this;
    }

    public function getAttestation(): ?string
    {
        return $this->attestation;
    }

    public function setAttestation(string $attestation): self
    {
        $this->attestation = $attestation;

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

    public function getSession(): ?string
    {
        return $this->session;
    }

    public function setSession(string $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getCursus(): ?string
    {
        return $this->cursus;
    }

    public function setCursus(?string $cursus): self
    {
        $this->cursus = $cursus;

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
    
    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }


}
