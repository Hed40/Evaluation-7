<?php

namespace App\Entity;

use App\Repository\SpecialityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialityRepository::class)]
class Speciality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Missions::class, mappedBy: 'specialties')]
    private Collection $missions;

    #[ORM\ManyToMany(targetEntity: Agents::class, mappedBy: 'specialties')]
    private Collection $agents;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
        $this->agents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Missions>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Missions $mission): static
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
            $mission->addSpecialty($this);
        }

        return $this;
    }

    public function removeMission(Missions $mission): static
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeSpecialty($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Agents>
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agents $agent): static
    {
        if (!$this->agents->contains($agent)) {
            $this->agents->add($agent);
            $agent->addSpecialty($this);
        }

        return $this;
    }

    public function removeAgent(Agents $agent): static
    {
        if ($this->agents->removeElement($agent)) {
            $agent->removeSpecialty($this);
        }

        return $this;
    }
}
