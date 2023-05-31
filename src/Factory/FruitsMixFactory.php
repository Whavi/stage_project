<?php

namespace App\Factory;

use App\Entity\FruitsMix;
use App\Repository\FruitsMixRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<FruitsMix>
 *
 * @method        FruitsMix|Proxy create(array|callable $attributes = [])
 * @method static FruitsMix|Proxy createOne(array $attributes = [])
 * @method static FruitsMix|Proxy find(object|array|mixed $criteria)
 * @method static FruitsMix|Proxy findOrCreate(array $attributes)
 * @method static FruitsMix|Proxy first(string $sortedField = 'id')
 * @method static FruitsMix|Proxy last(string $sortedField = 'id')
 * @method static FruitsMix|Proxy random(array $attributes = [])
 * @method static FruitsMix|Proxy randomOrCreate(array $attributes = [])
 * @method static FruitsMixRepository|RepositoryProxy repository()
 * @method static FruitsMix[]|Proxy[] all()
 * @method static FruitsMix[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static FruitsMix[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static FruitsMix[]|Proxy[] findBy(array $attributes)
 * @method static FruitsMix[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static FruitsMix[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FruitsMixFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            
            'idCount' => self::faker()->numberBetween(5,20),
            'importAt' => self::faker()->dateTime(),
            'pays' => self::faker()->country(),
            'description' => self::faker()->paragraph(),
            'slug' => self::faker()->text(),
            'title' => self::faker()->randomElement(["Pastèque","Pomme","Poire"]),
            'votes' => self::faker()->numberBetween(-50,50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(FruitsMix $fruitsMix): void {})
        ;
    }

    protected static function getClass(): string
    {
        return FruitsMix::class;
    }
}
