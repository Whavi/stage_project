<?php
namespace App\Controller;

use App\Repository\FruitsMixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Contracts\Cache\CacheInterface;
use function Symfony\Component\String\u;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;

class VinylController extends AbstractController
{

    public function __construct(
        private bool $isDebug,)
    {
        $this->isDebug = $isDebug;
    }



    #[Route('/', name:'app_homepage')]
    public function homepage(): Response
    {
        
        $fruits = [
            ['fruit' => 'Pastèque', 'pays' => 'France'],
            ['fruit' => 'Orange', 'pays' => 'France'],
            ['fruit' => 'Poire', 'pays' => 'Espagne'],
            ['fruit' => 'Pomme', 'pays' => 'Espagne'],
        ];

        return $this->render('homepage.html.twig',[
            'title' => 'Fruit du monde',
            'fruit' => $fruits,
        ]);

    }


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




    #[Route('/pagetest', name:'app_pagetest')]
    public function pagetest(): Response
    {
        $fruits = [
            ['fruit' => 'Pastèque', 'pays' => 'France'],
            ['fruit' => 'Orange', 'pays' => 'France'],
            ['fruit' => 'Poire', 'pays' => 'Espagne'],
            ['fruit' => 'Pomme', 'pays' => 'Espagne'],
        ];

        return $this->render('test.html.twig',[
            'title' => 'Test',
            'fruit' => $fruits,
        ]);
    }


    #[Route('/lucky/number/{max}', name: 'app_lucky_number')]
    public function number(int $max): Response
    {
        $number = random_int(0, $max);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

}