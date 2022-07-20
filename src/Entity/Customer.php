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
    normalizationContext:['groups'=> ['customer:read']],
    denormalizationContext:['groups'=> ['customer:write']],
    collectionOperations:[
        'get' => ["normalization_context"=> ['groups'=> ['customer:read']]],//=>['security'=> 'is_granted("ROLE_USER") and object.owner == user',
       // 'security_message' => 'Connectez-vous pour acceder à cette ressources'
   // ],
        'post'
    ],
    itemOperations:[
        'get'=> ["normalization_context"=> ['groups'=> ['customer:read']]],//=>['security'=> 'is_granted("ROLE_USER") and object.owner == user',
        //'security_message' => 'Connectez-vous pour acceder à cette ressources'
    //],
        'delete'//=>['security'=> 'is_granted("ROLE_USER") and object.owner == user'],
        //'security_message' => 'Connectez-vous pour acceder à cette ressources'
    ],
    attributes: ["pagination_items_per_page" => 10]
)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['customer:read'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Assert\Length(min:3, 
                    max:20,)]
    #[Groups(['customer:read'])]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank (message: 'Cet champs ne peut pas être vide.',)]
    #[Assert\Length(min:3, 
                    max:20,)]
    #[Groups(['customer:read', 'customer:write'])]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Email(
        message: 'Cet e-mail {{ value }} n\'est pas un e-mail valide.',
    )]
    #[Groups(['customer:read', 'customer:write'])]
    private $email;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['customer:read', 'customer:write'])]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['customer:read', 'customer:write'])]
    private $adress;

    #[ORM\ManyToOne(targetEntity: Reseller::class, inversedBy: 'customers',  cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
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
