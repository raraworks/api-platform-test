<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(shortName: 'client-object')]
class ClientObjectResource
{
    #[ApiProperty(identifier: true), Groups(['person:read'])]
    public int|null $id = null;
    #[Groups(['person:read'])]
    public string|null $title = null;
    #[Groups(['person:read'])]
    public string|null $notes = null;
    #[Groups(['person:read'])]
    public string|null $region = null;
    #[Groups(['person:read'])]
    public string|null $address = null;
    #[Groups(['person:read'])]
    public string|null $contractNo = null;
    #[Groups(['person:read'])]
    public float|null $hourlyRate = null;
    public PersonResource|null $person = null;
    #[Groups(['person:read'])]
    public ClientResource|null $client = null;
    #[Groups(['person:read'])]
    public DateTimeImmutable|null $createdAt = null;
    #[Groups(['person:read'])]
    public DateTimeImmutable|null $updatedAt = null;
}