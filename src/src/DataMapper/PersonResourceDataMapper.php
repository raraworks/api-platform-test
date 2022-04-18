<?php

namespace App\DataMapper;

use App\ApiResource\ClientObjectResource;
use App\ApiResource\ClientResource;
use App\ApiResource\PersonResource;
use App\Entity\Client;
use App\Entity\Person;
use App\Repository\ClientRepository;

class PersonResourceDataMapper
{
    protected ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function mapToApiResource(string $className, Person $ormEntity): PersonResource
    {
        /** @var PersonResource $resourceInstance */
        $resourceInstance = new $className;
        $resourceInstance->id = $ormEntity->getId();
        $resourceInstance->fullName = "{$ormEntity->getFirstName()} {$ormEntity->getLastName()}";
        $resourceInstance->firstName = $ormEntity->getFirstName();
        $resourceInstance->lastName = $ormEntity->getLastName();
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
        $ormEntity->setFirstName($resourceInstance->firstName);
        $ormEntity->setLastName($resourceInstance->lastName);
        $ormEntity->setEmail($resourceInstance->email);
        $ormEntity->setPhoneNo($resourceInstance->phoneNo);
        foreach ($ormEntity->getClients() as $client) {
            foreach ($resourceInstance->clients as $clientResource) {
                if ($client->getId() === $clientResource->id) {
                    continue 2;
                }
            }
            $ormEntity->removeClient($client);
        }
        foreach ($resourceInstance->clients as $clientResource) {
            if ($clientResource->id === null) {
                $clientEntity = new Client();
                $clientEntity->setTitle($clientResource->title);
                $clientEntity->setAddress($clientResource->address);
                $clientEntity->setRegNo($clientResource->regNo);
                $clientEntity->setBillingAddress($clientResource->billingAddress);
                $clientEntity->setNotes($clientResource->notes);
                $ormEntity->addClient($clientEntity);
            } elseif (!$ormEntity->getClients()->exists(static fn($idx, Client $client) => $client->getId() === $clientResource->id)) {
                $clientEntity = $this->clientRepository->find($clientResource->id);
                if (null !== $clientEntity) {
                    $ormEntity->addClient($clientEntity);
                }
            }
        }
    }
}