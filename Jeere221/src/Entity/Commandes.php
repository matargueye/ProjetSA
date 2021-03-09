<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_Commande;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Livreurs::class, inversedBy="commande")
     * @ORM\JoinColumn(nullable=false)
     */
    private $livreurs;

    /**
     * @ORM\OneToOne(targetEntity=Paniers::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $panier;

    /**
     * @ORM\OneToOne(targetEntity=Factures::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $facture;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->Date_Commande;
    }

    public function setDateCommande(\DateTimeInterface $Date_Commande): self
    {
        $this->Date_Commande = $Date_Commande;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getLivreurs(): ?Livreurs
    {
        return $this->livreurs;
    }

    public function setLivreurs(?Livreurs $livreurs): self
    {
        $this->livreurs = $livreurs;

        return $this;
    }

    public function getPanier(): ?Paniers
    {
        return $this->panier;
    }

    public function setPanier(Paniers $panier): self
    {
        $this->panier = $panier;

        return $this;
    }

    public function getFacture(): ?Factures
    {
        return $this->facture;
    }

    public function setFacture(?Factures $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }
}
