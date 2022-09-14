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

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'sports')]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Timecard::class, mappedBy: 'sports')]
    private Collection $timecards;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->timecards = new ArrayCollection();
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
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addSport($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeSport($this);
        }

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
}