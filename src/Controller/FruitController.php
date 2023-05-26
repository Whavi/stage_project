<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FruitController extends AbstractController
{
    #[Route('/api/fruits/{id<\d+>}', methods: ["GET"], name: "app_fruit_getFuit")]
    public function getFruit(int $id, LoggerInterface $logger): Response
    {
        // TODO query the data base
        $fruits = [
            'id' => $id,
            'name' => 'Pomme',
            'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ];

        $logger->info("Retourner la réponse de l'API pour le fruit {fruits}",[
            'fruits' => $id,
        ]);

     

        return $this->json($fruits);
    }

}
