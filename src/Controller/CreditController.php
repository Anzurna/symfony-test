<?php

namespace App\Controller;

use App\Entity\Car;
use App\Services\CreditService\Contracts\CreditServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\SerializerInterface;

class CreditController extends AbstractController
{
    public function __construct(
        private CreditServiceInterface $creditService,
        private EntityManagerInterface $em
    ) {
    }

    public function getSuitableCredit(Request $request): Response
    {
        $carId = $request->query->get('car_id');
        $initialPay = $request->query->get('initial_pay');
        $monthlyPay = $request->query->get('monthly_pay');
        $duration = $request->query->get('duration');

        $carId = filter_var($carId, FILTER_VALIDATE_INT);
        $initialPay = filter_var($initialPay, FILTER_VALIDATE_INT);
        $monthlyPay = filter_var($monthlyPay, FILTER_VALIDATE_INT);
        $duration = filter_var($duration, FILTER_VALIDATE_INT);

        if (
            $carId === false
            || $initialPay === false
            || $monthlyPay === false
            || $duration === false
        ) {
            return new Response("Incorrect params", Response::HTTP_BAD_REQUEST);
        }

        $car = $this->em->getRepository(Car::class)->find($carId);

        if (!$car) {
            throw new NotFoundHttpException("Автомобиль не найден");
        }

        $credit = $this->creditService->selectCredit(
            $car, $initialPay, $monthlyPay, $duration
        );

        if (!$credit) {
            return new Response(Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $this->creditService->getClientData(
                $car,
                $credit,
                $monthlyPay,
                $initialPay,
                $duration
            )
        );
    }

    public function getCredits(SerializerInterface $serializer): JsonResponse
    {
        return JsonResponse::fromJsonString(
            $serializer->serialize($this->creditService->getCredits(), "json")
        );
    }
}
