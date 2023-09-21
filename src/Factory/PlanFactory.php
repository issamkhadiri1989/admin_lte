<?php

namespace App\Factory;

use App\Entity\Plan;
use App\Repository\PlanRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Plan>
 *
 * @method        Plan|Proxy                     create(array|callable $attributes = [])
 * @method static Plan|Proxy                     createOne(array $attributes = [])
 * @method static Plan|Proxy                     find(object|array|mixed $criteria)
 * @method static Plan|Proxy                     findOrCreate(array $attributes)
 * @method static Plan|Proxy                     first(string $sortedField = 'id')
 * @method static Plan|Proxy                     last(string $sortedField = 'id')
 * @method static Plan|Proxy                     random(array $attributes = [])
 * @method static Plan|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PlanRepository|RepositoryProxy repository()
 * @method static Plan[]|Proxy[]                 all()
 * @method static Plan[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Plan[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Plan[]|Proxy[]                 findBy(array $attributes)
 * @method static Plan[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Plan[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class PlanFactory extends ModelFactory
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
            'label' => self::faker()->text(255),
            'price' => self::faker()->randomFloat(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Plan $plan): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Plan::class;
    }
}
