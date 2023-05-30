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
        $fruit->setTitle('Pomme');
        $fruit->setDescription('Un fruit juteux et sucré dans une bonne saison');
        $fruit->setPays('Espagne');
        $fruit->setImportAt(new \DateTimeImmutable());
        $fruit->setIdCount(rand(5, 20));
        $fruit->setVotes(rand(-50, 50));
        $entityManager->persist($fruit);
        $entityManager->flush();
        

        return new Response(sprintf(
            'Le fruit %d est %d venu d\'un autre pays que l\'espagne',
            $fruit->getId(),
            $fruit->getIdCount()
    ));

        
    }
}

