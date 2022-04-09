<?php

namespace App\DataFixtures;

use App\Entity\Speciality;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $slugger = new AsciiSlugger();
        for($i = 0; $i < 200; $i++) {
            $speciality = new Speciality();
            $speciality->setTitle($faker->text(50))
                ->setSlug($slugger->slug($speciality->getTitle()))
                ->setDescription($faker->text(200))
                ->setPosition($i)
                ->setIsActive(true)
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());
            $manager->persist($speciality);
        }
        $manager->flush();
    }
}
