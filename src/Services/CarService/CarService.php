<?php

namespace App\Services\CarService;

use App\Entity\Car;
use App\Services\CarService\Contracts\CarServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class CarService implements CarServiceInterface
{
    public function __construct(private EntityManagerInterface $em)
    {
    }
    /** @inheritdoc */
    public function getCarById(int $id): Car
    {
        return $this->em->getRepository(Car::class)->find($id);
    }

    /** @inheritdoc */
    public function getCars(): array
    {
        return $this->em->getRepository(Car::class)->findAll();
    }
}
