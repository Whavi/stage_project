<?php

namespace App\DataFixtures;



use App\Entity\FruitsMix;
use  Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fruit = new FruitsMix();

        $fruits =["Pomme", "Poire", "Pastèque"];
        $fruit->setTitle($fruits[array_rand($fruits)]);

        $fruit->setDescription('Un fruit juteux et sucré dans une bonne saison');

        $pays =["France", "Espagne", "Portugal"];
        $fruit->setPays($pays[array_rand($pays)]);


        $fruit->setImportAt(new \DateTimeImmutable());
        $fruit->setIdCount(rand(5, 20));
        $fruit->setVotes(rand(-50, 50));
        
        $manager->persist($fruit);
        $manager->flush();
    }
}
