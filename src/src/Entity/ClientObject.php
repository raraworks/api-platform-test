<?php

namespace App\Entity;

use App\Repository\ClientObjectRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientObjectRepository::class)]
#[ORM\Index(columns: ["contract_no"], name: "idx_client_object_contract_no")]
class ClientObject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', unique: true)]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string|null $title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private string|null $notes = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string|null $region = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string|null $address = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string|null $contractNo = null;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 2)]
    private float|null $hourlyRate = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $updatedAt = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int|null $personId = null;

    #[ORM\ManyToOne(targetEntity: Person::class, inversedBy: 'clientObjects')]
    #[ORM\JoinColumn(name: 'person_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Person|null $person = null;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'clientObjects')]
    #[ORM\JoinColumn(nullable: false)]
    private Client|null $client = null;

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getNotes(): string|null
    {
        return $this->notes;
    }

    public function setNotes(string|null $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getRegion(): string|null
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getAddress(): string|null
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getContractNo(): string|null
    {
        return $this->contractNo;
    }

    public function setContractNo(string|null $contractNo): self
    {
        $this->contractNo = $contractNo;

        return $this;
    }

    public function getHourlyRate(): float|null
    {
        return $this->hourlyRate;
    }

    public function setHourlyRate(float $hourlyRate): self
    {
        $this->hourlyRate = $hourlyRate;

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

    public function getPersonId(): int|null
    {
        return $this->personId;
    }

    public function setPersonId(int|null $personId): self
    {
        $this->personId = $personId;

        return $this;
    }

    public function getPerson(): Person|null
    {
        return $this->person;
    }

    public function setPerson(Person|null $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getClient(): Client|null
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
