<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
#[ORM\Index(columns: ["email"], name: "idx_person_email")]
#[ORM\Index(columns: ["phone_no"], name: "idx_person_phone_no")]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', unique: true)]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string|null $firstName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string|null $lastName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string|null $email = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string|null $phoneNo = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable|null $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'person', targetEntity: Client::class)]
    private Collection $clients;

    #[ORM\OneToMany(mappedBy: 'person', targetEntity: ClientObject::class)]
    private Collection $clientObjects;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->clientObjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string|null
    {
        return $this->firstName;
    }

    public function setFirstName(string|null $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string|null
    {
        return $this->lastName;
    }

    public function setLastName(string|null $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function setEmail(string|null $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNo(): string|null
    {
        return $this->phoneNo;
    }

    public function setPhoneNo(string|null $phoneNo): self
    {
        $this->phoneNo = $phoneNo;

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

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setPerson($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getPerson() === $this) {
                $client->setPerson(null);
            }
        }

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
            $clientObject->setPerson($this);
        }

        return $this;
    }

    public function removeClientObject(ClientObject $clientObject): self
    {
        if ($this->clientObjects->removeElement($clientObject)) {
            // set the owning side to null (unless already changed)
            if ($clientObject->getPerson() === $this) {
                $clientObject->setPerson(null);
            }
        }

        return $this;
    }
}
