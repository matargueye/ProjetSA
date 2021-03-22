<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreursRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ApiResource(iri="http://schema.org/Produits")
 * @ORM\Entity(repositoryClass=LivreursRepository::class)
 */
class Livreurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     *
     * @var MediaObject|null
     * 
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @ORM\JoinColumn(nullable=true)
     * @ORM\Column(type="integer")
     * @ApiProperty(iri="http://schema.org/image")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse_Livreur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Tel_Livreur;

    /**
     * @ORM\OneToMany(targetEntity=Commandes::class, mappedBy="livreurs")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="livreur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    public function __construct()
    {
        $this->commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAdresseLivreur(): ?string
    {
        return $this->Adresse_Livreur;
    }

    public function setAdresseLivreur(string $Adresse_Livreur): self
    {
        $this->Adresse_Livreur = $Adresse_Livreur;

        return $this;
    }

    public function getTelLivreur(): ?string
    {
        return $this->Tel_Livreur;
    }

    public function setTelLivreur(string $Tel_Livreur): self
    {
        $this->Tel_Livreur = $Tel_Livreur;

        return $this;
    }

    /**
     * @return Collection|Commandes[]
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commandes $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
            $commande->setLivreurs($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLivreurs() === $this) {
                $commande->setLivreurs(null);
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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
