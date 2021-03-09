<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 */
class Clients
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
    private $Adresse_Client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Tel_Client;

    /**
     * @ORM\OneToMany(targetEntity=Commandes::class, mappedBy="client")
     */
    private $commandes;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresseClient(): ?string
    {
        return $this->Adresse_Client;
    }

    public function setAdresseClient(string $Adresse_Client): self
    {
        $this->Adresse_Client = $Adresse_Client;

        return $this;
    }

    public function getTelClient(): ?string
    {
        return $this->Tel_Client;
    }

    public function setTelClient(string $Tel_Client): self
    {
        $this->Tel_Client = $Tel_Client;

        return $this;
    }

    /**
     * @return Collection|Commandes[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commandes $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }
}
