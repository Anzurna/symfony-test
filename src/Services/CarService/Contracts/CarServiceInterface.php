<?php

namespace App\Services\CarService\Contracts;

use App\Entity\Car;

interface CarServiceInterface
{
    /**
     * @param int $id
     *
     * @return Car
     */
    public function getCarById(int $id): Car;

    /**
     * @return array
     */
    public function getCars(): array;
}
