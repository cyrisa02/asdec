<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $articleNr = null;

    #[ORM\Column(length: 190)]
    private ?string $title = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(length: 190)]
    private ?string $customer = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IsSended = null;

    /**
 	*This constructor is for the date
 	*/
 	
 	public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
           
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleNr(): ?string
    {
        return $this->articleNr;
    }

    public function setArticleNr(string $articleNr): self
    {
        $this->articleNr = $articleNr;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): self
    {
        $this->customer = $customer;

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

    public function isIsSended(): ?bool
    {
        return $this->IsSended;
    }

    public function setIsSended(?bool $IsSended): self
    {
        $this->IsSended = $IsSended;

        return $this;
    }
}