<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;

#[ApiResource(shortName: 'person', attributes: ['pagination_fetch_join_collection' => true])]
class PersonResource
{
    #[ApiProperty(identifier: true)]
    public int|null $id = null;
    public string|null $fullName = null;
    public string|null $firstName = null;
    public string|null $lastName = null;
    public string|null $email = null;
    public string|null $phoneNo = null;
    /**
     * @var ClientObjectResource[]|null
     */
    #[ApiProperty(readableLink: true, writableLink: true)]
    public array $clientObjects = [];
    /**
     * @var ClientResource[]|null
     */
    #[ApiProperty(readableLink: true, writableLink: true)]
    public array $clients = [];
    public DateTimeImmutable|null $createdAt = null;
    public DateTimeImmutable|null $updatedAt = null;
}