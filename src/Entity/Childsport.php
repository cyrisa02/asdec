<?php

namespace App\Entity;

use App\Repository\ChildsportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChildsportRepository::class)]
class Childsport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $title = null;

    #[ORM\Column(length: 190)]
    private ?string $place = null;

    #[ORM\Column(length: 190)]
    private ?string $day = null;

    #[ORM\Column(length: 190)]
    private ?string $start = null;

    #[ORM\Column(length: 190)]
    private ?string $end = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $peopleNbr = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?string
    {
        return $this->end;
    }

    public function setEnd(string $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getPeopleNbr(): ?string
    {
        return $this->peopleNbr;
    }

    public function setPeopleNbr(?string $peopleNbr): self
    {
        $this->peopleNbr = $peopleNbr;

        return $this;
    }
}
