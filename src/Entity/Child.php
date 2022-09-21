<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChildRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ChildRepository::class)]
class Child
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 190)]
    private ?string $name = null;

    #[ORM\Column(length: 190)]
    private ?string $firstname = null;

    #[ORM\Column(length: 190)]
    private ?string $address = null;

    #[ORM\Column(length: 190)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 190)]
    private ?string $city = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column]
    private ?bool $isValid = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $isMedical = null;

    #[ORM\Column(length: 190)]
    private ?string $certificatyear = null;

    

    #[ORM\Column(length: 190)]
    private ?string $parentname = null;

    #[ORM\Column(length: 190)]
    private ?string $parentfirstname = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $picture = null;

    #[ORM\ManyToMany(targetEntity: Childsport::class, inversedBy: 'children')]
    private Collection $sports;

    #[ORM\Column(nullable: true)]
    private ?bool $isPresent = null;

    #[ORM\Column(nullable: true, unique: true)]
    private ?int $cardnr = null;

    

    

    
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->sports = new ArrayCollection();
             
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

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

    public function isIsMedical(): ?bool
    {
        return $this->isMedical;
    }

    public function setIsMedical(bool $isMedical): self
    {
        $this->isMedical = $isMedical;

        return $this;
    }

    public function getCertificatyear(): ?string
    {
        return $this->certificatyear;
    }

    public function setCertificatyear(string $certificatyear): self
    {
        $this->certificatyear = $certificatyear;

        return $this;
    }

    

    public function getParentname(): ?string
    {
        return $this->parentname;
    }

    public function setParentname(string $parentname): self
    {
        $this->parentname = $parentname;

        return $this;
    }

    public function getParentfirstname(): ?string
    {
        return $this->parentfirstname;
    }

    public function setParentfirstname(string $parentfirstname): self
    {
        $this->parentfirstname = $parentfirstname;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Childsport>
     */
    public function getSports(): Collection
    {
        return $this->sports;
    }

    public function addSport(Childsport $sport): self
    {
        if (!$this->sports->contains($sport)) {
            $this->sports->add($sport);
        }

        return $this;
    }

    public function removeSport(Childsport $sport): self
    {
        $this->sports->removeElement($sport);

        return $this;
    }

    public function isIsPresent(): ?bool
    {
        return $this->isPresent;
    }

    public function setIsPresent(?bool $isPresent): self
    {
        $this->isPresent = $isPresent;

        return $this;
    }

    public function getCardnr(): ?int
    {
        return $this->cardnr;
    }

    public function setCardnr(?int $cardnr): self
    {
        $this->cardnr = $cardnr;

        return $this;
    }

   

   

    
}