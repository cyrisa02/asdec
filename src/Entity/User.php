<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 190)]
    private ?string $name = null;

    #[ORM\Column(length: 190)]
    private ?string $firstname = null;

    #[ORM\Column(length: 190)]
    private ?string $address = null;

    #[ORM\Column(length: 10)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 190)]
    private ?string $city = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Birthdate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IsValid = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $job = null;

    #[ORM\Column]
    private ?bool $IsMedical = null;

    #[ORM\Column(length: 190)]
    private ?string $certificatyear = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isRegistered = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Condition $present = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isYoga = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPilate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isChild = null;

    /**
 	*This constructor is for the date
 	*/
 	
 	public function __construct()
    {
        $this->CreatedAt = new \DateTimeImmutable();
           
        
    }

    public function getAge()
     {
        $dateInterval = $this->Birthdate->diff(new \DateTime());
 
         return $dateInterval->y;
     }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
        return $this->Birthdate;
    }

    public function setBirthdate(\DateTimeInterface $Birthdate): self
    {
        $this->Birthdate = $Birthdate;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->IsValid;
    }

    public function setIsValid(?bool $IsValid): self
    {
        $this->IsValid = $IsValid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function isIsMedical(): ?bool
    {
        return $this->IsMedical;
    }

    public function setIsMedical(bool $IsMedical): self
    {
        $this->IsMedical = $IsMedical;

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

    public function isIsRegistered(): ?bool
    {
        return $this->isRegistered;
    }

    public function setIsRegistered(?bool $isRegistered): self
    {
        $this->isRegistered = $isRegistered;

        return $this;
    }

    public function getPresent(): ?Condition
    {
        return $this->present;
    }

    public function setPresent(?Condition $present): self
    {
        $this->present = $present;

        return $this;
    }

    public function isIsYoga(): ?bool
    {
        return $this->isYoga;
    }

    public function setIsYoga(?bool $isYoga): self
    {
        $this->isYoga = $isYoga;

        return $this;
    }

    public function isIsPilate(): ?bool
    {
        return $this->isPilate;
    }

    public function setIsPilate(?bool $isPilate): self
    {
        $this->isPilate = $isPilate;

        return $this;
    }

    public function isIsChild(): ?bool
    {
        return $this->isChild;
    }

    public function setIsChild(?bool $isChild): self
    {
        $this->isChild = $isChild;

        return $this;
    }
}