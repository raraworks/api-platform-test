<?php

namespace App\DataMapper;

use App\ApiResource\ClientObjectResource;
use App\ApiResource\ClientResource;
use App\ApiResource\PersonResource;
use App\Entity\Person;

class PersonResourceDataMapper
{
    public function mapToApiResource(string $className, Person $ormEntity): PersonResource
    {
        /** @var PersonResource $resourceInstance */
        $resourceInstance = new $className;
        $resourceInstance->id = $ormEntity->getId();
        $resourceInstance->fullName = "{$ormEntity->getFirstName()} {$ormEntity->getLastName()}";
        $resourceInstance->email = $ormEntity->getEmail();
        $resourceInstance->phoneNo = $ormEntity->getPhoneNo();
        $resourceInstance->createdAt = $ormEntity->getCreatedAt();
        $resourceInstance->updatedAt = $ormEntity->getUpdatedAt();
        foreach ($ormEntity->getClientObjects() as $clientObject) {
            $clientObjectResource = new ClientObjectResource();
            $clientObjectResource->id = $clientObject->getId();
            $clientObjectResource->person = $resourceInstance;
            $clientObjectResource->title = $clientObject->getTitle();
            $clientObjectResource->notes = $clientObject->getNotes();
            $clientObjectResource->region = $clientObject->getRegion();
            $clientObjectResource->address = $clientObject->getAddress();
            $clientObjectResource->contractNo = $clientObject->getContractNo();
            $clientObjectResource->hourlyRate = $clientObject->getHourlyRate();
            $clientObjectResource->createdAt = $clientObject->getCreatedAt();
            $clientObjectResource->updatedAt = $clientObject->getUpdatedAt();
            $resourceInstance->clientObjects[] = $clientObjectResource;
        }
        foreach ($ormEntity->getClients() as $client) {
            $clientResource = new ClientResource();
            $clientResource->id = $client->getId();
            $clientResource->person = $resourceInstance;
            $clientResource->title = $client->getTitle();
            $clientResource->notes = $client->getNotes();
            $clientResource->regNo = $client->getRegNo();
            $clientResource->address = $client->getAddress();
            $clientResource->billingAddress = $client->getBillingAddress();
            $clientResource->createdAt = $client->getCreatedAt();
            $clientResource->updatedAt = $client->getUpdatedAt();
            $resourceInstance->clients[] = $clientResource;
        }
        return $resourceInstance;
    }

    public function mapToOrmEntity(Person $ormEntity, PersonResource $resourceInstance): void
    {
    }
}