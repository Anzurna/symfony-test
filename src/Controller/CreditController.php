<?php

namespace App\Controller;

use App\Services\CreditService\Contracts\CreditServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreditController extends AbstractController
{
    public function __construct(private CreditServiceInterface $creditService)
    {
    }

    public function getSuitableCredit(Request $request): Response
    {
        $carPrice = $request->query->get('car_price');
        $initialPay = $request->query->get('initial_pay');
        $monthlyPay = $request->query->get('monthly_pay');
        $duration = $request->query->get('duration');

        $carPrice = filter_var($carPrice, FILTER_VALIDATE_INT);
        $initialPay = filter_var($initialPay, FILTER_VALIDATE_INT);
        $monthlyPay = filter_var($monthlyPay, FILTER_VALIDATE_INT);
        $duration = filter_var($duration, FILTER_VALIDATE_INT);

        if (
            $carPrice === false
            || $initialPay === false
            || $monthlyPay === false
            || $duration === false
        ) {
            return new Response("Incorrect params",Response::HTTP_BAD_REQUEST);
        }

        $credit = $this->creditService->selectCredit(
            $carPrice, $initialPay, $monthlyPay, $duration
        );

        if (!$credit) {
            return new Response(Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            [
                "credit_id" => $credit->getId(),
                "cumulative_interest" => $this->creditService->getCumulativeInterest(
                    $carPrice, $monthlyPay, $initialPay, $duration
                ),
                "interest_rate" => $credit->getInterestRate(),
                "monthly_payment" => $credit->getMonthlyPayLowerBound()
            ]
        );
    }

    public function getCredits(SerializerInterface $serializer): JsonResponse
    {
        return JsonResponse::fromJsonString(
            $serializer->serialize($this->creditService->getCredits(), "json")
        );
    }
}
