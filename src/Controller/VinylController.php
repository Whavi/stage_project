<?php
namespace App\Controller;

use App\Service\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Contracts\Cache\CacheInterface;
use function Symfony\Component\String\u;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class VinylController extends AbstractController
{

    public function __construct(
        private bool $isDebug,
        private FruitRepository $FruitRepository)
    {
        $this->isDebug = $isDebug;
        $this->FruitRepository = $FruitRepository;

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









    #[Route('/fruit/{slug}', name:'app_page')]
    public function fruit(HttpClientInterface $httpClient, CacheInterface $cache, string $slug = null): Response
    {
        $title = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $fruits = $this->FruitRepository->findAll();


        return $this->render('fruit.html.twig',[
            'title' => $title,
            'mixes' => $fruits,
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