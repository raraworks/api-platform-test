<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SpecialityRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialityRepository::class)]
#[ORM\Index(columns: ["position"], name: "idx_speciality_position")]
#[ORM\Index(columns: ["slug"], name: "idx_speciality_slug")]
#[ORM\Index(columns: ["is_active"], name: "idx_speciality_is_active")]
class Speciality
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column(type: 'uuid', unique: true)]
    private string|null $id = null;

    #[ORM\Column(type: 'string', length: 500)]
    private string|null $title = null;

    #[ORM\Column(type: 'string', length: 500)]
    private string|null $slug = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private string|null $description = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int|null $position = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = false;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $updatedAt = null;

    public function getId(): string|null
    {
        return $this->id;
    }

    public function getPosition(): int|null
    {
        return $this->position;
    }

    public function setPosition(int|null $position): self
    {
        $this->position = $position;

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

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function setTitle(string|null $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): string|null
    {
        return $this->slug;
    }

    public function setSlug(string|null $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function setDescription(string|null $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable|null
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable|null $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): DateTimeImmutable|null
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable|null $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
