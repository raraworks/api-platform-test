<?php

namespace App\DataMapper;

use App\ApiResource\ClientResource;
use App\ApiResource\PersonResource;
use App\Entity\Client;

class ClientResourceDataMapper
{
    public function mapToApiResource(string $className, Client $ormEntity): ClientResource
    {
        /** @var ClientResource $resourceInstance */
        $resourceInstance = new $className;
        $resourceInstance->id = $ormEntity->getId();
        $resourceInstance->title = $ormEntity->getTitle();
        $resourceInstance->notes = $ormEntity->getNotes();
        $resourceInstance->regNo = $ormEntity->getRegNo();
        $resourceInstance->address = $ormEntity->getAddress();
        $resourceInstance->billingAddress = $ormEntity->getBillingAddress();
        $resourceInstance->createdAt = $ormEntity->getCreatedAt();
        $resourceInstance->updatedAt = $ormEntity->getUpdatedAt();
        $personEntity = $ormEntity->getPerson();
        if (null !== $personEntity) {
            $personResource = new PersonResource();
            $personResource->id = $personEntity->getId();
            $personResource->fullName = "{$personEntity->getFirstName()} {$personEntity->getLastName()}";
            $personResource->firstName = $personEntity->getFirstName();
            $personResource->lastName = $personEntity->getLastName();
            $personResource->email = $personEntity->getEmail();
            $personResource->phoneNo = $personEntity->getPhoneNo();
            $personResource->createdAt = $personEntity->getCreatedAt();
            $personResource->updatedAt = $personEntity->getUpdatedAt();
            $resourceInstance->person = $personResource;
        }
        return $resourceInstance;
    }

    public function mapToOrmEntity(Client $ormEntity, ClientResource $resourceInstance): void
    {
//        $ormEntity->setFirstName($resourceInstance->firstName);
//        $ormEntity->setLastName($resourceInstance->lastName);
//        $ormEntity->setEmail($resourceInstance->email);
//        $ormEntity->setPhoneNo($resourceInstance->phoneNo);
    }
}