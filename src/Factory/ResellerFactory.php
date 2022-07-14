<?php

namespace App\Factory;

use App\Entity\Reseller;
use App\Repository\ResellerRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ModelFactory<Reseller>
 *
 * @method static Reseller|Proxy createOne(array $attributes = [])
 * @method static Reseller[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Reseller|Proxy find(object|array|mixed $criteria)
 * @method static Reseller|Proxy findOrCreate(array $attributes)
 * @method static Reseller|Proxy first(string $sortedField = 'id')
 * @method static Reseller|Proxy last(string $sortedField = 'id')
 * @method static Reseller|Proxy random(array $attributes = [])
 * @method static Reseller|Proxy randomOrCreate(array $attributes = [])
 * @method static Reseller[]|Proxy[] all()
 * @method static Reseller[]|Proxy[] findBy(array $attributes)
 * @method static Reseller[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Reseller[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ResellerRepository|RepositoryProxy repository()
 * @method Reseller|Proxy create(array|callable $attributes = [])
 */
final class ResellerFactory extends ModelFactory
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->passwordHasher = $passwordHasher;

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'email' => self::faker()->email(),
            'roles' => [],
            'pleinPassword' => 'tada',
            'company' => self::faker()->company('name'),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
             ->afterInstantiate(function(Reseller $reseller) {
                if ($reseller->getPleinPassword()) {
                    $reseller->setPassword(
                        $this->passwordHasher->hashPassword($reseller, $reseller->getPleinPassword())
                    );
                }
             })
        ;
    }

    protected static function getClass(): string
    {
        return Reseller::class;
    }
}
