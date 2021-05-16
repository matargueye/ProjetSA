<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Unique;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;





/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users  implements UserInterface
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
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Unique(message="The {{ username }} username is repeated.")
     */
    private $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Vendeurs::class, mappedBy="users")
     */
    private $vendeur;

    /**
     * @ORM\OneToMany(targetEntity=Livreurs::class, mappedBy="users")
     */
    private $livreur;

    /**
     * @ORM\OneToMany(targetEntity=Clients::class, mappedBy="users")
     */
    private $client;

    public function __construct()
    {
        
      
        $this->isActive = true;
        $this->vendeur = new ArrayCollection();
        $this->livreur = new ArrayCollection();
        $this->client = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    
    public function setUsername(string $username): self
    {
        $this->username= $username;

        return $this;
    }

   

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    
    public function getRoles(): array
    {
        
        return [strtoupper($this->role->getLibelle())];
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    /**
     * @return Collection|Vendeurs[]
     */
    public function getVendeur(): Collection
    {
        return $this->vendeur;
    }

    public function addVendeur(Vendeurs $vendeur): self
    {
        if (!$this->vendeur->contains($vendeur)) {
            $this->vendeur[] = $vendeur;
            $vendeur->setUsers($this);
        }

        return $this;
    }

    public function removeVendeur(Vendeurs $vendeur): self
    {
        if ($this->vendeur->removeElement($vendeur)) {
            // set the owning side to null (unless already changed)
            if ($vendeur->getUsers() === $this) {
                $vendeur->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Livreurs[]
     */
    public function getLivreur(): Collection
    {
        return $this->livreur;
    }

    public function addLivreur(Livreurs $livreur): self
    {
        if (!$this->livreur->contains($livreur)) {
            $this->livreur[] = $livreur;
            $livreur->setUsers($this);
        }

        return $this;
    }

    public function removeLivreur(Livreurs $livreur): self
    {
        if ($this->livreur->removeElement($livreur)) {
            // set the owning side to null (unless already changed)
            if ($livreur->getUsers() === $this) {
                $livreur->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Clients[]
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Clients $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client[] = $client;
            $client->setUsers($this);
        }

        return $this;
    }

    public function removeClient(Clients $client): self
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getUsers() === $this) {
                $client->setUsers(null);
            }
        }

        return $this;
    }
}
