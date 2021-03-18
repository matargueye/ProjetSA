<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VendeursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=VendeursRepository::class)
 */
class Vendeurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $Photo_CNI_V;

    /**
     * @ORM\Column(type="blob")
     */
    private $Logo_Vendeur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse_Vendeur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Tel_Vendeur;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="vendeur")
     */
    private $produits;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="vendeur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoCNIV()
    {
        return $this->Photo_CNI_V;
    }

    public function setPhotoCNIV($Photo_CNI_V): self
    {
        $this->Photo_CNI_V = $Photo_CNI_V;

        return $this;
    }

    public function getLogoVendeur()
    {
        return $this->Logo_Vendeur;
    }

    public function setLogoVendeur($Logo_Vendeur): self
    {
        $this->Logo_Vendeur = $Logo_Vendeur;

        return $this;
    }

    public function getAdresseVendeur(): ?string
    {
        return $this->Adresse_Vendeur;
    }

    public function setAdresseVendeur(string $Adresse_Vendeur): self
    {
        $this->Adresse_Vendeur = $Adresse_Vendeur;

        return $this;
    }

    public function getTelVendeur(): ?string
    {
        return $this->Tel_Vendeur;
    }

    public function setTelVendeur(string $Tel_Vendeur): self
    {
        $this->Tel_Vendeur = $Tel_Vendeur;

        return $this;
    }

    /**
     * @return Collection|Produits[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setVendeur($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getVendeur() === $this) {
                $produit->setVendeur(null);
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
