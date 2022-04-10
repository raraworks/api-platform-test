<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
#[ORM\Index(columns: ["start_at"], name: "idx_consultation_start_at")]
#[ORM\Index(columns: ["end_at"], name: "idx_consultation_end_at")]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column(type: 'uuid', unique: true)]
    private string|null $id = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $startAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $endAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: Speciality::class, inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private Speciality|null $speciality = null;

    #[ORM\ManyToOne(targetEntity: Specialist::class, inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private Specialist|null $specialist = null;

    public function getId(): string|null
    {
        return $this->id;
    }

    public function getStartAt(): DateTimeImmutable|null
    {
        return $this->startAt;
    }

    public function setStartAt(DateTimeImmutable|null $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): DateTimeImmutable|null
    {
        return $this->endAt;
    }

    public function setEndAt(DateTimeImmutable|null $endAt): self
    {
        $this->endAt = $endAt;

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

    public function getSpeciality(): Speciality|null
    {
        return $this->speciality;
    }

    public function setSpeciality(Speciality|null $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getSpecialist(): Specialist|null
    {
        return $this->specialist;
    }

    public function setSpecialist(Specialist|null $specialist): self
    {
        $this->specialist = $specialist;

        return $this;
    }
}
