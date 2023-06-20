<?php

namespace App\Entity;

use App\Repository\MissionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionsRepository::class)]
class Missions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $codeName = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $requiredSpeciality = null;

    #[ORM\ManyToMany(targetEntity: Contacts::class, inversedBy: 'Missions')]
    private Collection $Contacts;

    #[ORM\ManyToMany(targetEntity: Agents::class, inversedBy: 'Missions')]
    private Collection $Agents;


    public function __construct()
    {
        $this->Contacts = new ArrayCollection();
        $this->Agents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCodeName(): ?string
    {
        return $this->codeName;
    }

    public function setCodeName(string $codeName): static
    {
        $this->codeName = $codeName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getRequiredSpeciality(): ?string
    {
        return $this->requiredSpeciality;
    }

    public function setRequiredSpeciality(string $requiredSpeciality): static
    {
        $this->requiredSpeciality = $requiredSpeciality;

        return $this;
    }

    /**
     * @return Collection<int, Contacts>
     */
    public function getContacts(): Collection
    {
        return $this->Contacts;
    }

    public function addContact(Contacts $contact): static
    {
        if (!$this->Contacts->contains($contact)) {
            $this->Contacts->add($contact);
        }

        return $this;
    }

    public function removeContact(Contacts $contact): static
    {
        $this->Contacts->removeElement($contact);

        return $this;
    }

    /**
     * @return Collection<int, Agents>
     */
    public function getAgents(): Collection
    {
        return $this->Agents;
    }

    public function addAgent(Agents $agent): static
    {
        if (!$this->Agents->contains($agent)) {
            $this->Agents->add($agent);
        }

        return $this;
    }

    public function removeAgent(Agents $agent): static
    {
        $this->Agents->removeElement($agent);

        return $this;
    }
}
