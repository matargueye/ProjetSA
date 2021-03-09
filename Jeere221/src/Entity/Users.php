<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
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
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pasword;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPasword(): ?string
    {
        return $this->pasword;
    }

    public function setPasword(string $pasword): self
    {
        $this->pasword = $pasword;

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
