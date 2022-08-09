<?php

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Customer;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;



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
        string $operationName = null): void
    {     
        $this->addWhere($queryBuilder, $resourceClass);
    }
    
    public function applyToItem(QueryBuilder $queryBuilder, 
        QueryNameGeneratorInterface $queryNameGenerator, 
        string $resourceClass, 
        array $identifiers, string $operationName = null, 
        array $context = []): void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass,): void
    {

      
        if (Customer::class !== $resourceClass || !$this->security->isGranted('IS_AUTHENTICATED_FULLY') 
        || null === $user = $this->security->getUser()) {
           
            return;
        }
           
        $alias = $queryBuilder->getRootAliases()[0];
            
        $queryBuilder->andWhere(sprintf('%s.reseller = :current_user', $alias));
        $queryBuilder->setParameter('current_user', $user);  
      
    }

}