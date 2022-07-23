<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[UniqueEntity(fields: ["email"], message: "Cet email existe déjà")]
#[ApiResource(
    normalizationContext:['groups'=> ['read:Customer']],
    denormalizationContext:['groups'=> ['write:Customer']],
    collectionOperations:[
        'get' => ["normalization_context"=> ['groups'=> ['read:Customer']]],
        'post' => ["denormalization_context" =>['groups'=> ['write:Customer']]],
    ],
    itemOperations:[
        'get'=> ["normalization_context"=> ['groups'=> ['read:Customer']]],
    
        'delete'=> ["denormalization_context" =>['groups'=> ['write:Customer']]],
    ],
    attributes: [
        "pagination_partial" => true,
        "pagination-via-cursor" => ["field" => "id", "direction" => "DESC"],
        "pagination_items_per_page" => 10]
)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:Customer'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Assert\Length(min:3, 
                    max:20,)]
    #[Groups(['read:Customer'])]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Assert\Length(min:3, 
                    max:20,)]
    #[Groups(['read:Customer', 'write:Customer'])]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Assert\Email(
        message: 'Cet e-mail {{ value }} n\'est pas un e-mail valide.',
    )]
    #[Groups(['read:Customer', 'write:Customer'])]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Assert\Email(
        message: 'Cet e-mail {{ value }} n\'est pas un e-mail valide.',
    )]
    private $email;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['read:Customer', 'write:Customer'])]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Groups(['read:Customer', 'write:Customer'])]
    private $adress;

    #[ORM\ManyToOne(targetEntity: Reseller::class, inversedBy: 'customers',  cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:Customer'])]
    private $reseller;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getReseller(): ?Reseller
    {
        return $this->reseller;
    }

    public function setReseller(?Reseller $reseller): self
    {
        $this->reseller = $reseller;

        return $this;
    }
}
