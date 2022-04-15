<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\ClientObject;
use App\Entity\Person;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 200; $i++) {
            $person = new Person();
            $person->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setEmail($faker->email())
                ->setPhoneNo($faker->phoneNumber())
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());
            $manager->persist($person);
        }
        $manager->flush();
        $people = $manager->getRepository(Person::class)->findAll();
        for ($i = 0; $i < 200; $i++) {
            $client = new Client();
            $client->setPerson($people[array_rand($people)])
                ->setTitle($faker->company())
                ->setAddress($faker->address())
                ->setRegNo($faker->numberBetween(100000000, 999999999))
                ->setBillingAddress($faker->address())
                ->setNotes($faker->text())
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());
            $manager->persist($client);
        }
        $manager->flush();
        $clients = $manager->getRepository(Client::class)->findAll();
        for ($i = 0; $i < 900; $i++) {
            $object = new ClientObject();
            $object->setPerson($people[array_rand($people)])
                ->setClient($clients[array_rand($clients)])
                ->setTitle($faker->words(2, true))
                ->setRegion($faker->city())
                ->setAddress($faker->address())
                ->setContractNo($faker->swiftBicNumber())
                ->setHourlyRate($faker->randomFloat(2, 1, 100))
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());
            $manager->persist($object);
        }
        $manager->flush();
    }
}
