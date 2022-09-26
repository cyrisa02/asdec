<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;

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

    

    #[ORM\Column(nullable: true)]
    private ?bool $isYoga = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPilate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isChild = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $picture = null;

    #[ORM\ManyToMany(targetEntity: Sport::class, inversedBy: 'users')]
    private Collection $sports;

    

    #[ORM\Column(nullable: true)]
    private ?bool $isPresent = null;

    

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: Presence1::class)]
    private Collection $presence1s;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'users')]
    private Collection $categories;

    #[ORM\Column(nullable: true, unique: true)]
    private ?int $cardnr = null;

    
    
    public function __toString()
     {
       return $this->email;
     }
     
   

    /**
 	*This constructor is for the date
 	*/
 	
 	public function __construct()
    {
        $this->CreatedAt = new \DateTimeImmutable();
        $this->sports = new ArrayCollection();        
        $this->presence1s = new ArrayCollection();
        $this->categories = new ArrayCollection();          
        
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
     * @return Collection<int, Sport>
     */
    public function getSports(): Collection
    {
        return $this->sports;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sports->contains($sport)) {
            $this->sports->add($sport);
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
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

    
    /**
     * @return Collection<int, Presence1>
     */
    public function getPresence1s(): Collection
    {
        return $this->presence1s;
    }

    public function addPresence1(Presence1 $presence1): self
    {
        if (!$this->presence1s->contains($presence1)) {
            $this->presence1s->add($presence1);
            $presence1->setUsers($this);
        }

        return $this;
    }

    public function removePresence1(Presence1 $presence1): self
    {
        if ($this->presence1s->removeElement($presence1)) {
            // set the owning side to null (unless already changed)
            if ($presence1->getUsers() === $this) {
                $presence1->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addUser($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeUser($this);
        }

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