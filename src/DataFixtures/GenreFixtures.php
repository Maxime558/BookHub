<?php


namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $genresData = [
            ['nom' => 'Science-Fiction', 'description' => 'Livres de science-fiction'],
            ['nom' => 'Romance', 'description' => 'Livres romantiques'],
            ['nom' => 'Mystère', 'description' => 'Livres de mystère et suspense'],
            ['nom' => 'Fantasy', 'description' => 'Livres de fantasy'],
            ['nom' => 'Thriller', 'description' => 'Livres de thriller'],
            ['nom' => 'Historique', 'description' => 'Livres historiques'],
            ['nom' => 'Aventure', 'description' => 'Livres d\'aventure'],
            ['nom' => 'Horreur', 'description' => 'Livres d\'horreur'],
            ['nom' => 'Drame', 'description' => 'Livres dramatiques'],
            ['nom' => 'Poésie', 'description' => 'Livres de poésie'],
            ['nom' => 'Comédie', 'description' => 'Livres comiques'],
            ['nom' => 'Biographie', 'description' => 'Livres biographiques'],
            ['nom' => 'Politique', 'description' => 'Livres politiques'],
            ['nom' => 'Philosophie', 'description' => 'Livres de philosophie'],
            ['nom' => 'Cuisine', 'description' => 'Livres de cuisine'],
            ['nom' => 'Art', 'description' => 'Livres d\'art'],
            ['nom' => 'Sport', 'description' => 'Livres sur le sport'],
            ['nom' => 'Musique', 'description' => 'Livres sur la musique'],
            ['nom' => 'Éducation', 'description' => 'Livres éducatifs'],
            ['nom' => 'Religion', 'description' => 'Livres religieux'],
        ];

        foreach ($genresData as $genreData) {
            $genre = new Genre();
            $genre->setNom($genreData['nom']);
            $genre->setDescription($genreData['description']);

            $manager->persist($genre);
            $this->addReference($genreData['nom'], $genre);
        }

        $manager->flush();
    }
}
