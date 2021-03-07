<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientsRepository;
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
}
