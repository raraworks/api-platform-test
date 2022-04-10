<?php

namespace App\DataFixtures;

use App\Entity\Consultation;
use App\Entity\Specialist;
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
        for($i = 0; $i < 200; $i++) {
            $specialist = new Specialist();
            $specialist->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setSubtitle($faker->text(255))
                ->setImage($faker->imageUrl())
                ->setIsActive(true)
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());
            $manager->persist($specialist);
        }
        $manager->flush();
        $specialists = $manager->getRepository(Specialist::class)->findAll();
        $specialities = $manager->getRepository(Speciality::class)->findAll();
        for($i = 0; $i < 200; $i++) {
            $consultation = new Consultation();
            $consultation->setSpecialist($specialists[array_rand($specialists)])
                ->setSpeciality($specialities[array_rand($specialities)])
                ->setStartAt(new DateTimeImmutable())
                ->setEndAt($consultation->getStartAt()?->modify('+1 hour'))
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());
            $manager->persist($consultation);
        }
        $manager->flush();
    }
}
