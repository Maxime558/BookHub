<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user
            ->setEmail($faker->email)
            ->setRoles(['ROLE_USER'])
            ->setPassword(password_hash($this->generateRandomPassword(), PASSWORD_BCRYPT))
            ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeThisMonth()))
            ->setNom($faker->lastName)
            ->setPrenom($faker->firstName)
            ->setTelephone((int)$faker->numerify('######'))
            ->setImageprofil($faker->imageUrl());

            $manager->persist($user);
        }

        $manager->flush(); 
    }

    private function generateRandomPassword($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
