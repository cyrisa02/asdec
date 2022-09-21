<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportRepository::class)]
class Sport
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

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $start = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $end = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $peopleNbr = null;

    

    #[ORM\ManyToMany(targetEntity: Timecard::class, mappedBy: 'sports')]
    private Collection $timecards;

    #[ORM\OneToMany(mappedBy: 'sports', targetEntity: Timecard1::class)]
    private Collection $timecard1s;

    #[ORM\OneToMany(mappedBy: 'sports', targetEntity: SportUser::class)]
    private Collection $sportUsers;

    public function __toString()
     {
       return $this->title;
     }


    public function __construct()
    {
        
        $this->timecards = new ArrayCollection();
        $this->timecard1s = new ArrayCollection();
        $this->sportUsers = new ArrayCollection();
    }

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

    public function setStart(?string $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?string
    {
        return $this->end;
    }

    public function setEnd(?string $end): self
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

    

    /**
     * @return Collection<int, Timecard>
     */
    public function getTimecards(): Collection
    {
        return $this->timecards;
    }

    public function addTimecard(Timecard $timecard): self
    {
        if (!$this->timecards->contains($timecard)) {
            $this->timecards->add($timecard);
            $timecard->addSport($this);
        }

        return $this;
    }

    public function removeTimecard(Timecard $timecard): self
    {
        if ($this->timecards->removeElement($timecard)) {
            $timecard->removeSport($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Timecard1>
     */
    public function getTimecard1s(): Collection
    {
        return $this->timecard1s;
    }

    public function addTimecard1(Timecard1 $timecard1): self
    {
        if (!$this->timecard1s->contains($timecard1)) {
            $this->timecard1s->add($timecard1);
            $timecard1->setSports($this);
        }

        return $this;
    }

    public function removeTimecard1(Timecard1 $timecard1): self
    {
        if ($this->timecard1s->removeElement($timecard1)) {
            // set the owning side to null (unless already changed)
            if ($timecard1->getSports() === $this) {
                $timecard1->setSports(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SportUser>
     */
    public function getSportUsers(): Collection
    {
        return $this->sportUsers;
    }

    public function addSportUser(SportUser $sportUser): self
    {
        if (!$this->sportUsers->contains($sportUser)) {
            $this->sportUsers->add($sportUser);
            $sportUser->setSports($this);
        }

        return $this;
    }

    public function removeSportUser(SportUser $sportUser): self
    {
        if ($this->sportUsers->removeElement($sportUser)) {
            // set the owning side to null (unless already changed)
            if ($sportUser->getSports() === $this) {
                $sportUser->setSports(null);
            }
        }

        return $this;
    }
}