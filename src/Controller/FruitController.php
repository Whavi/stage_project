<?php
namespace App\Controller;

use App\Entity\FruitsMix;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FruitsMixRepository;
use Symfony\Component\HttpFoundation\Request;


class FruitController extends AbstractController
{
    #[Route('/fruit/new')]
    public function new(EntityManagerInterface $entityManager): Response
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
        $entityManager->persist($fruit);
        $entityManager->flush();
        

        return new Response(sprintf(
            'Le fruit %d est %d venu d\'un autre pays comme ce pays.',
            $fruit->getId(),
            $fruit->getIdCount()
    ));
}
    
    #[Route('/fruitsShoot/{id}', name:'app_show_id')]
        public function show($id, FruitsMixRepository $FruitRepository): Response 
    { 
        $frt = $FruitRepository->find($id);

        if (!$frt) {
            throw $this->createNotFoundException('Mix not found');
        }

        return $this->render('frt/show.html.twig', [
            'mix' => $frt,
            
        ]);
    }

    #[Route('/fruitsShoot/{id}/vote', name:'app_vote_id', methods: ["POST"])]
        public function vote(FruitsMix $fruitsMix, Request $request, EntityManagerInterface $entityManager): Response 
    { 
        $direction = $request->request->get('direction', 'up');
        if ($direction === 'up') {
            $fruitsMix->upVotes();
        } else {
            $fruitsMix->downVotes();
        }

        $entityManager->flush();
        $this->addFlash('success', 'Vote réussi !');

        return $this->redirectToRoute('app_show_id',[
            'id' => $fruitsMix->getId(),
        ]);
    }
}
    


