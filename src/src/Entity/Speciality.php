<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SpecialityRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialityRepository::class)]
#[ORM\Index(columns: ["position"], name: "idx_speciality_position")]
#[ORM\Index(columns: ["slug"], name: "idx_speciality_slug")]
#[ORM\Index(columns: ["active"], name: "idx_speciality_active")]
class Speciality
{
    /**
     * @var string|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column(type: 'uuid', unique: true)]
    private string|null $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 500)]
    private string|null $title = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 500)]
    private string|null $slug = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'text', nullable: true)]
    private string|null $description = null;

    /**
     * @var int|null
     */
    #[ORM\Column(type: 'integer', nullable: true)]
    private int|null $position = null;

    /**
     * @var bool
     */
    #[ORM\Column(type: 'boolean')]
    private bool $active = false;

    /**
     * @var DateTimeInterface|null
     */
    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface|null $createdAt = null;

    /**
     * @var DateTimeInterface|null
     */
    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface|null $updatedAt = null;

    /**
     * @return string|null
     */
    public function getId(): string|null
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getPosition(): int|null
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     * @return $this
     */
    public function setPosition(int|null $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return $this
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): string|null
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return $this
     */
    public function setTitle(string|null $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): string|null
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return $this
     */
    public function setSlug(string|null $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): string|null
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(string|null $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): DateTimeInterface|null
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface|null $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface|null $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): DateTimeInterface|null
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTimeInterface|null $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
