<?php

namespace App\Entity;

use App\Repository\LivreursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="blob")
     */
    private $Photo_CNI_L;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse_Livreur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Tel_Livreur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoCNIL()
    {
        return $this->Photo_CNI_L;
    }

    public function setPhotoCNIL($Photo_CNI_L): self
    {
        $this->Photo_CNI_L = $Photo_CNI_L;

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
}
