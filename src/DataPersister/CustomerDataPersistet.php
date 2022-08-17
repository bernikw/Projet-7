<?php

namespace App\DataPersister;

use App\Entity\Customer;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class CustomerDataPersister extends AbstractController implements ContextAwareDataPersisterInterface
{

    private $decorated;

    public function __construct(DataPersisterInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Customer;
    }

    public function persist($data, array $context = [])
    {
        $data->setReseller($this->getUser());
        $this->decorated->persist($data);      
       
    }

    public function remove($data, array $context = [])
    {
        $this->decorated->remove($data);
       
    }
}