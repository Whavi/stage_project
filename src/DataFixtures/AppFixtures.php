<?php

namespace App\DataFixtures;



use App\Entity\FruitsMix;
use App\Factory\FruitsMixFactory;
use  Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        FruitsMixFactory::createMany(16);
    }
}
