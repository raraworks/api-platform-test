<?php

namespace App\Entity;

use App\Repository\SpecialistRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialistRepository::class)]
#[ORM\Index(columns: ["is_active"], name: "idx_specialist_is_active")]
class Specialist
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column(type: 'uuid', unique: true)]
    private string|null $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string|null $firstName = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string|null $lastName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string|null $subtitle = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string|null $image = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = false;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'specialist', targetEntity: Consultation::class)]
    private Collection $consultations;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
    }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getFirstName(): string|null
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string|null
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSubtitle(): string|null
    {
        return $this->subtitle;
    }

    public function setSubtitle(string|null $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getImage(): string|null
    {
        return $this->image;
    }

    public function setImage(string|null $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable|null
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): DateTimeImmutable|null
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, Consultation>
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): self
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations[] = $consultation;
            $consultation->setSpecialist($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getSpecialist() === $this) {
                $consultation->setSpecialist(null);
            }
        }

        return $this;
    }
}
