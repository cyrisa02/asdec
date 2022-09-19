<?php

namespace App\Entity;

use App\Repository\TimecardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimecardRepository::class)]
class Timecard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $responsable = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

   

    

    #[ORM\OneToMany(mappedBy: 'timecards', targetEntity: Presence::class)]
    private Collection $presences;

   

    #[ORM\ManyToOne(inversedBy: 'timecards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sport $sport = null;

    /**
 	*This constructor is for the date
 	*/
 	
 	public function __construct()
    {
        $this->CreatedAt = new \DateTimeImmutable();
       
       
        $this->presences = new ArrayCollection();
           
        
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
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    

    

    /**
     * @return Collection<int, Presence>
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): self
    {
        if (!$this->presences->contains($presence)) {
            $this->presences->add($presence);
            $presence->setTimecards($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): self
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getTimecards() === $this) {
                $presence->setTimecards(null);
            }
        }

        return $this;
    }

    

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): self
    {
        $this->sport = $sport;

        return $this;
    }
}