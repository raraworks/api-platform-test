<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\SortFilter;
use DateTimeImmutable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'person',
    attributes: ['pagination_fetch_join_collection' => true],
    denormalizationContext: ['groups' => ['person:write']],
    normalizationContext: ['groups' => ['person:read']])
]
#[ApiFilter(SortFilter::class, properties: ['id',
    'firstName' => 'firstName',
    'lastName' => 'lastName',
    'email' => 'email',
    'createdAt' => 'createdAt',
    'updatedAt' => 'updatedAt',
])]
class PersonResource
{
    #[ApiProperty(identifier: true), Groups(['person:read'])]
    public int|null $id = null;
    #[Groups(['person:read']), Assert\Type(type: 'string')]
    public string|null $fullName = null;
    #[Assert\NotBlank, Assert\Type(type: 'string'), Assert\Length(max: 255), Groups(['person:read', 'person:write'])]
    public string|null $firstName = null;
    #[Assert\NotBlank, Assert\Type(type: 'string'), Assert\Length(max: 255), Groups(['person:read', 'person:write'])]
    public string|null $lastName = null;
    #[Assert\NotBlank, Assert\Type(type: 'string'), Assert\Email, Assert\Length(max: 255), Groups(['person:read', 'person:write'])]
    public string|null $email = null;
    #[Assert\NotBlank, Assert\Type(type: 'string'), Assert\Length(max: 255), Groups(['person:read', 'person:write'])]
    public string|null $phoneNo = null;
    /**
     * @var ClientObjectResource[]|null
     */
    //TODO: Create dataProvider/dataPersister
    #[Groups(['person:read']), Assert\Valid]
    public array $clientObjects = [];
    /**
     * @var ClientResource[]|null
     */
    #[Groups(['person:read', 'person:write']), Assert\Valid]
    public array $clients = [];
    #[Groups(['person:read'])]
    public DateTimeImmutable|null $createdAt = null;
    #[Groups(['person:read'])]
    public DateTimeImmutable|null $updatedAt = null;
}