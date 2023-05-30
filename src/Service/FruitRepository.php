<?php

namespace App\Service;
use Psr\Cache\CacheItemInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bridge\Twig\Command\DebugCommand;
class FruitRepository
{
    public function __construct(
        private HttpClientInterface $githubContentClient, 
        private CacheInterface $cache,
        #[Autowire('%kernel.debug%')] private bool $isDebug,
        #[Autowire(service: 'twig.command.debug')] private DebugCommand $twigDebugCommand)
        {

        $this->githubContentClient = $githubContentClient;
        $this->cache = $cache;
        $this->twigDebugCommand = $twigDebugCommand;
        $this->isDebug = $isDebug;
    }

    public function findAll(): array
    {
        return $this->cache->get("fruits_data", function(CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter($this->isDebug ? 5 : 60);
            $response = $this->githubContentClient->request('GET', 'Whavi/stage_project/master/fruits.json');

            return $response->toArray();
        });
    }
}

