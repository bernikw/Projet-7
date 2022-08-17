<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ORM\UniqueConstraint(fields: ["email", "reseller"])]
#[UniqueEntity(fields: ["email", "reseller"], message: "Cet email existe déjà")]
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
        "pagination_items_per_page" => 2,
        "route_prefix" => "/v1"],
        security: "is_granted('ROLE_USER')",
    cacheHeaders:  [
        "max_age" => 60,
        "shared_max_age" => 120,
        "vary" => ["Authorization", "Accept-Language"]]    
)]
class Customer 
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:Customer'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.')]
    #[Assert\Length(min:3, 
                    max:20,)]
    #[Groups(['read:Customer','write:Customer'])]
    #[Assert\Regex(
        pattern: '^(?=.*[A-Z])(?=.*[a-z]).{3,}$^',
        message: 'Le prénom peut contenir seulement des lettes !',
    )]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.')]
    #[Assert\Length(min:3, 
                    max:20,)]
    #[Groups(['read:Customer', 'write:Customer'])]
    #[Assert\Regex(
        pattern: '^(?=.*[A-Z])(?=.*[a-z]).{3,}$^',
        message: 'Le nom peut contenir seulement des lettes !',
    )]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.')]
    #[Assert\Email(
        message: 'Cet e-mail {{ value }} n\'est pas un e-mail valide.',
    )]
    #[Groups(['read:Customer', 'write:Customer'])]
    private $email;


    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.')]
    #[Groups(['read:Customer', 'write:Customer'])]
    private $adress;

    #[ORM\ManyToOne(targetEntity: Reseller::class, inversedBy: 'customers',  cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:Customer', 'write:Customer'])]
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
