<?php

namespace App\Entity;

use App\Repository\GoodiesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoodiesRepository::class)]
class Goodies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $Title = null;

    #[ORM\Column(length: 190)]
    private ?string $Price = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $Color = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $Size = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $picture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->Color;
    }

    public function setColor(?string $Color): self
    {
        $this->Color = $Color;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->Size;
    }

    public function setSize(?string $Size): self
    {
        $this->Size = $Size;

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
}
