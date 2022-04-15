<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ClientRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ORM\Index(columns: ["title"], name: "idx_client_title")]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', unique: true)]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string|null $title = null;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private string|null $address = null;

    #[ORM\Column(type: 'string', length: 11, unique: true, nullable: true)]
    private string|null $regNo = null;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private string|null $billingAddress;

    #[ORM\Column(type: 'text', nullable: true)]
    private string|null $notes = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $updatedAt = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int|null $personId;

    #[ORM\ManyToOne(targetEntity: Person::class, inversedBy: 'clients')]
    #[ORM\JoinColumn(name: 'person_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Person|null $person;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: ClientObject::class, orphanRemoval: true)]
    private $clientObjects;

    public function __construct()
    {
        $this->clientObjects = new ArrayCollection();
    }

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

    public function getAddress(): string|null
    {
        return $this->address;
    }

    public function setAddress(string|null $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getRegNo(): string|null
    {
        return $this->regNo;
    }

    public function setRegNo(string|null $regNo): self
    {
        $this->regNo = $regNo;

        return $this;
    }

    public function getBillingAddress(): string|null
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(string|null $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

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

    /**
     * @return Collection<int, ClientObject>
     */
    public function getClientObjects(): Collection
    {
        return $this->clientObjects;
    }

    public function addClientObject(ClientObject $clientObject): self
    {
        if (!$this->clientObjects->contains($clientObject)) {
            $this->clientObjects[] = $clientObject;
            $clientObject->setClient($this);
        }

        return $this;
    }

    public function removeClientObject(ClientObject $clientObject): self
    {
        if ($this->clientObjects->removeElement($clientObject)) {
            // set the owning side to null (unless already changed)
            if ($clientObject->getClient() === $this) {
                $clientObject->setClient(null);
            }
        }

        return $this;
    }
}
