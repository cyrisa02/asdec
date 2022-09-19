<?php

namespace App\Entity;

use App\Repository\Timecard1Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Timecard1Repository::class)]
class Timecard1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $responsable = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_At = null;

    #[ORM\ManyToOne(inversedBy: 'timecard1s')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sport $sports = null;

    #[ORM\OneToMany(mappedBy: 'timecards1', targetEntity: Presence1::class)]
    private Collection $presence1s;


    /**
 	*This constructor is for the date
 	*/
 	
 	public function __construct()
    {
        $this->created_At = new \DateTimeImmutable();
        $this->presence1s = new ArrayCollection();          
        
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    public function setResponsable(string $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_At;
    }

    public function setCreatedAt(\DateTimeImmutable $created_At): self
    {
        $this->created_At = $created_At;

        return $this;
    }

    public function getSports(): ?Sport
    {
        return $this->sports;
    }

    public function setSports(?Sport $sports): self
    {
        $this->sports = $sports;

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
            $presence1->setTimecards1($this);
        }

        return $this;
    }

    public function removePresence1(Presence1 $presence1): self
    {
        if ($this->presence1s->removeElement($presence1)) {
            // set the owning side to null (unless already changed)
            if ($presence1->getTimecards1() === $this) {
                $presence1->setTimecards1(null);
            }
        }

        return $this;
    }
}