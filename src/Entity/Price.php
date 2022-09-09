<?php

namespace App\Entity;

use App\Repository\PriceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PriceRepository::class)]
class Price
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $adult = null;

    #[ORM\Column(length: 190)]
    private ?string $child = null;

    #[ORM\Column(length: 190)]
    private ?string $year = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isTicket = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdult(): ?string
    {
        return $this->adult;
    }

    public function setAdult(string $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getChild(): ?string
    {
        return $this->child;
    }

    public function setChild(string $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function isIsTicket(): ?bool
    {
        return $this->isTicket;
    }

    public function setIsTicket(?bool $isTicket): self
    {
        $this->isTicket = $isTicket;

        return $this;
    }
}