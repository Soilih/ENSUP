<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DoctrineExtensions\Query\Mysql\Date;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Votre compte existe dejà")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @Assert\Length(min = 6, max = 12, minMessage = "votre mot de passe doit avoir 6 caractere min ", maxMessage = "votre mot de passe doit avoir ne doit pas depasser  caractere 12 caracteres ")
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

  

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $Nom;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="user")
     */
    private $etudiants;

    

    /**
     * @ORM\OneToMany(targetEntity=ParcoursUniversitaire::class, mappedBy="user")
     */
    private $parcoursUniversitaires;

    /**
     * @ORM\OneToMany(targetEntity=Langue::class, mappedBy="user")
     */
    private $langues;

    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="user")
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity=Responsable::class, mappedBy="user")
     */
    private $responsables;

       /**
     * @ORM\OneToMany(targetEntity=Flux::class, mappedBy="user")
     */
    private $fluxes;
    
    /**
     * @ORM\OneToMany(targetEntity=Bourse::class, mappedBy="user")
     */
    private $bourses;
    

    /**
     * @ORM\OneToMany(targetEntity=FluxSortant::class, mappedBy="user")
     */
    private $fluxSortants;

    /**
     * @ORM\OneToMany(targetEntity=Candidature::class, mappedBy="user")
     */
    private $candidatures;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    

    /**
     * @ORM\Column(type="float")
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 5,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $Numerocarte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $session;

    /**
     * @ORM\OneToMany(targetEntity=Diplome::class, mappedBy="user")
     */
    private $diplomes;

    /**
     * @ORM\OneToMany(targetEntity=InformationBac::class, mappedBy="user")
     */
    private $informationBacs;

    
public function __construct()
    {
        $this->etudiants = new ArrayCollection();
       
        $this->parcoursUniversitaires = new ArrayCollection();
        $this->langues = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->responsables = new ArrayCollection();
        $this->bourses = new ArrayCollection();
      
        $this->fluxes = new ArrayCollection();
        $this->fluxSortants = new ArrayCollection();
        
        $this->candidatures = new ArrayCollection();
        $this->diplomes = new ArrayCollection();
        $this->informationBacs = new ArrayCollection();
       
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setUser($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getUser() === $this) {
                $etudiant->setUser(null);
            }
        }

        return $this;
    }

   

    /**
     * @return Collection|ParcoursUniversitaire[]
     */
    public function getparcours_universitaires(): Collection
    {
        return $this->parcoursUniversitaires;
    }

    public function addParcoursUniversitaire(ParcoursUniversitaire $parcoursUniversitaire): self
    {
        if (!$this->parcoursUniversitaires->contains($parcoursUniversitaire)) {
            $this->parcoursUniversitaires[] = $parcoursUniversitaire;
            $parcoursUniversitaire->setUser($this);
        }

        return $this;
    }

    public function removeParcoursUniversitaire(ParcoursUniversitaire $parcoursUniversitaire): self
    {
        if ($this->parcoursUniversitaires->removeElement($parcoursUniversitaire)) {
            // set the owning side to null (unless already changed)
            if ($parcoursUniversitaire->getUser() === $this) {
                $parcoursUniversitaire->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Langue[]
     */
    public function getLangues(): Collection
    {
        return $this->langues;
    }

    public function addLangue(Langue $langue): self
    {
        if (!$this->langues->contains($langue)) {
            $this->langues[] = $langue;
            $langue->setUser($this);
        }

        return $this;
    }

    public function removeLangue(Langue $langue): self
    {
        if ($this->langues->removeElement($langue)) {
            // set the owning side to null (unless already changed)
            if ($langue->getUser() === $this) {
                $langue->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setUser($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getUser() === $this) {
                $experience->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Responsable[]
     */
    public function getResponsables(): Collection
    {
        return $this->responsables;
    }

    public function addResponsable(Responsable $responsable): self
    {
        if (!$this->responsables->contains($responsable)) {
            $this->responsables[] = $responsable;
            $responsable->setUser($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getUser() === $this) {
                $responsable->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bourse[]
     */
    public function getBourses(): Collection
    {
        return $this->bourses;
    }

    public function addBourse(Bourse $bourse): self
    {
        if (!$this->bourses->contains($bourse)) {
            $this->bourses[] = $bourse;
            $bourse->setUser($this);
        }

        return $this;
    }

    public function removeBourse(Bourse $bourse): self
    {
        if ($this->bourses->removeElement($bourse)) {
            // set the owning side to null (unless already changed)
            if ($bourse->getUser() === $this) {
                $bourse->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flux[]
     */
    public function getfluxes(): Collection
    {
        return $this->fluxes;
    }

    public function addFlux(Flux $fluxes): self
    {
        if (!$this->fluxes->contains($fluxes)) {
            $this->fluxes[] = $fluxes;
            $fluxes->setUser($this);
        }

        return $this;
    }

    public function removeFlux(Flux $fluxes): self
    {
        if ($this->langues->removeElement($fluxes)) {
            // set the owning side to null (unless already changed)
            if ($fluxes->getUser() === $this) {
                $fluxes->setUser(null);
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
            $fluxSortant->setUser($this);
        }

        return $this;
    }

    public function removeFluxSortant(FluxSortant $fluxSortant): self
    {
        if ($this->fluxSortants->removeElement($fluxSortant)) {
            // set the owning side to null (unless already changed)
            if ($fluxSortant->getUser() === $this) {
                $fluxSortant->setUser(null);
            }
        }

        return $this;
    }



    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    /**
     * @return Collection|ParcoursUniversitaire[]
     */
    public function getParcoursUniversitaires(): Collection
    {
        return $this->parcoursUniversitaires;
    }

    

    /**
     * @return Collection|Candidature[]
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures[] = $candidature;
            $candidature->setUser($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getUser() === $this) {
                $candidature->setUser(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

   

    public function getNumerocarte(): ?float
    {
        return $this->Numerocarte;
    }

    public function setNumerocarte(float $Numerocarte): self
    {
        $this->Numerocarte = $Numerocarte;

        return $this;
    }

    public function getNin(): ?string
    {
        return $this->Nin;
    }

    public function setNin(string $Nin): self
    {
        $this->Nin = $Nin;

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
            $diplome->setUser($this);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): self
    {
        if ($this->diplomes->removeElement($diplome)) {
            // set the owning side to null (unless already changed)
            if ($diplome->getUser() === $this) {
                $diplome->setUser(null);
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
            $informationBac->setUser($this);
        }

        return $this;
    }

    public function removeInformationBac(InformationBac $informationBac): self
    {
        if ($this->informationBacs->removeElement($informationBac)) {
            // set the owning side to null (unless already changed)
            if ($informationBac->getUser() === $this) {
                $informationBac->setUser(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->name;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getUser() === $this) {
                $contact->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(self $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
          
        }

        return $this;
    }

   
   
}
