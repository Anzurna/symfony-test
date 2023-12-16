<?php

namespace App\Controller;

use App\Entity\CreditApplication;
use App\Services\CreditApplicationService\Contracts\CreditApplicationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class CreditApplicationController extends AbstractController
{
    public function __construct(private CreditApplicationServiceInterface $creditApplicationService)
    {
    }

    public function apply(Request $request): Response
    {
        $creditId = $request->request->get('credit_id');
        $carId = $request->request->get('car_id');
        $initialPay = $request->request->get('initial_pay');
        $monthlyPay = $request->request->get('monthly_pay');
        $duration = $request->request->get('duration');

        $creditId = filter_var($creditId, FILTER_VALIDATE_INT);
        $carId = filter_var($carId, FILTER_VALIDATE_INT);
        $initialPay = filter_var($initialPay, FILTER_VALIDATE_INT);
        $monthlyPay = filter_var($monthlyPay, FILTER_VALIDATE_INT);
        $duration = filter_var($duration, FILTER_VALIDATE_INT);

        if (
            $creditId === false
            || $carId === false
            || $initialPay === false
            || $monthlyPay === false
            || $duration === false
        ) {
            return new Response("Incorrect params", Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->creditApplicationService
                ->apply(
                    $carId,
                    $creditId,
                    $initialPay,
                    $monthlyPay,
                    $duration
                );
        } catch (HttpException $exception) {
            return new Response($exception->getMessage(), $exception->getStatusCode());
        }

        return new Response();
    }

    public function getApplications(): JsonResponse
    {
        return new JsonResponse(array_map(static function (CreditApplication $application) {
            return [
                "id" => $application->getId(),
                "car_id" => $application->getCar()->getId(),
                "initial_pay" => $application->getInitialPay(),
                "montly_pay" => $application->getMonthlyPay(),
                "duration" => $application->getDuration(),
                "created_at" => $application->getCreatedAt()->getTimestamp()
            ];
        }, $this->creditApplicationService->getApplications()));
    }
}
