<?php

namespace App\DataFixtures;

use App\Entity\Livres;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LivresFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $genres = $manager->getRepository('App\Entity\Genre')->findAll();

        for ($i = 0; $i < 200; $i++) {
            $livre = new Livres();
            $livre->setTitre($faker->sentence(3));
            $livre->setEditeur($faker->company);
            $livre->setAuteur($faker->name);
            $isbn = $faker->numberBetween(0, 99999);
            $livre->setIsbn($isbn);
            $livre->setDatePublication($faker->dateTimeThisCentury);
        
            $randomImageNumber = $faker->numberBetween(1, 16);
            $livre->setImage("image{$randomImageNumber}.jpg");
        
            $livre->setResume($faker->paragraph);
    
            $randomGenresCount = $faker->numberBetween(1, 3);
            $randomGenres = $faker->randomElements($genres, $randomGenresCount);

            foreach ($randomGenres as $genre) {
                $livre->addGenre($genre);
            }
        
            $manager->persist($livre);
        }
        
        $manager->flush();
    }
}