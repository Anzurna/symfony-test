<?php

namespace App\Controller;

use App\Services\CarService\Contracts\CarServiceInterface;
use App\Transformer\CarTransformer;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CarsController extends AbstractController
{
    public function __construct(
        private CarServiceInterface $carService,
        private CarTransformer $transformer
    ) {
    }

    public function getCars(Request $request): JsonResponse
    {
        return new JsonResponse(
            array_map(function ($car) {
                return $this->transformer->transform($car);
            }, $this->carService->getCars())
        );
    }
}
