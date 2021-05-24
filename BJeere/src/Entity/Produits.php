<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitsRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(iri="http://schema.org/Produits",
 * normalizationContext={"groups"={"produit:read"}})
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"produit:read"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"produit:read"})
     */
    private $nom_produit;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"produit:read"})
     */
    private $prix_unitaire;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"produit:read"})
     */

    private $quantite_stock;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"produit:read"})
     */
    private $caracteristique;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"produit:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Groups({"produit:read"})
     */
    private $date_ajout;

    /**
     * @ORM\ManyToOne(targetEntity=Vendeurs::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"produit:read"})
     */
    private $vendeur;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieProdui::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $categorie;


    /**
     * @ORM\Column(type="boolean")
     * @Groups({"produit:read"})
     * 
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProduit::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     * 
     * 
     */
    private $type_produit;

    /**
     * @ORM\Column(type="blob")
     * @Groups({"produit:read"})
     * 
     */
    private $image;


    public function __construct()
    {
        $this->paniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nom_produit;
    }

    public function setNomProduit(string $nom_produit): self
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    public function getPrixUnitaire(): ?string
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(string $prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getQuantiteStock(): ?string
    {
        return $this->quantite_stock;
    }

    public function setQuantiteStock(string $quantite_stock): self
    {
        $this->quantite_stock = $quantite_stock;

        return $this;
    }

    public function getCaracteristique(): ?string
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(string $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    
    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTimeInterface $date_ajout): self
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }

    public function getVendeur(): ?Vendeurs
    {
        return $this->vendeur;
    }

    public function setVendeur(?Vendeurs $vendeur): self
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    public function getCategorie(): ?CategorieProdui
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieProdui $categorie): self	
    
    {
        $this->categorie = $categorie;

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

    public function getTypeProduit(): ?TypeProduit
    {
        return $this->type_produit;
    }

    public function setTypeProduit(?TypeProduit $type_produit): self
    {
        $this->type_produit = $type_produit;

        return $this;
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

   
}
