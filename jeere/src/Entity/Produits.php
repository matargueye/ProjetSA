<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(iri="http://schema.org/Produits")
 * @Vich\Uploadable
 * 
 * 
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
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
    private $nom_produit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix_unitaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quantite_stock;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caracteristique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $date_ajout;

    /**
     * @ORM\ManyToOne(targetEntity=Vendeurs::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vendeur;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieProdui::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;



      /**
     *
     * @var MediaObject|null
     * 
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProduit::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_produit;


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

   
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

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

   
}
