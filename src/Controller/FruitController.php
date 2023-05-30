<?php
namespace App\Controller;

use App\Entity\FruitsMix;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class FruitController extends AbstractController
{
    #[Route('/fruit/new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $fruit = new FruitsMix();

        $fruits =["pomme", "poire", "pastèque"];
        $fruit->setTitle($fruits[array_rand($fruits)]);

        $fruit->setDescription('Un fruit juteux et sucré dans une bonne saison');

        $pays =["France", "Espagne", "Portugal"];
        $fruit->setPays($pays[array_rand($pays)]);

        $fruit->setImportAt(new \DateTimeImmutable());
        $fruit->setIdCount(rand(5, 20));
        $fruit->setVotes(rand(-50, 50));
        $entityManager->persist($fruit);
        $entityManager->flush();
        

        return new Response(sprintf(
            'Le fruit %d est %d venu d\'un autre pays comme ce pays.',
            $fruit->getId(),
            $fruit->getIdCount()
    ));

        
    }
}

