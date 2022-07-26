<?php

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;

use App\Entity\UserOwnedInterface;
use Doctrine\ORM\QueryBuilder;
use ReflectionClass;
use Symfony\Component\Security\Core\Security;

/*

final class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{

    private $security;

    public function __construct(Security $security){

        $this->security = $security;
    }

    public function applyToCollection(
        QueryBuilder $queryBuilder, 
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null
    ){     
        $this->addWhere($resourceClass, $queryBuilder);
    }
    
    public function applyToItem(QueryBuilder $queryBuilder, 
        QueryNameGeneratorInterface $queryNameGenerator, 
        string $resourceClass, 
        array $identifiers, string $operationName = null, 
        array $context = []): void
    {
        $this->addWhere($resourceClass, $queryBuilder);
    }

    private function addWhere(string $resourceClass, QueryBuilder $queryBuilder)
    {

        $reflectionClass = new ReflectionClass($resourceClass);
        if ($reflectionClass->implementsInterface(UserOwnedInterface::class) || $this->security->isGranted('IS_AUTHENTICATED_FULLY') 
        || null === $user = $this->security->getUser()) {
            return;
        }

            $alias = $queryBuilder->getRootAliases()[0];
              $queryBuilder
                  ->andWhere("$alias.user = :current_user")
                  ->setParameter('current_user', $user()->getId());     

    }

}*/