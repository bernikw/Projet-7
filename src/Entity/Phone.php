<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
#[ApiResource(  
    collectionOperations:[
        'get'=> ["normalization_context"=> ['groups'=> ['read:Phone']]],
    ],
    itemOperations:[
        'get'=> ["normalization_context"=> ['groups'=> ['read:Phone']]],
    ],
    attributes: ["pagination_items_per_page" => 5]
)]
class Phone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:Phone'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Phone'])]
    private $name;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Phone'])]
    private $price;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Phone'])]
    private $reference;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Phone'])]
    private $brand;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Phone'])]
    private $color;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Phone'])]
    private $screenSize;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Phone'])]
    private $weight;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Phone'])]
    private $operatingSystem;

    #[ORM\Column(type: 'boolean')]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Phone'])]
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getScreenSize(): ?int
    {
        return $this->screenSize;
    }

    public function setScreenSize(int $screenSize): self
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getOperatingSystem(): ?string
    {
        return $this->operatingSystem;
    }

    public function setOperatingSystem(string $operatingSystem): self
    {
        $this->operatingSystem = $operatingSystem;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
