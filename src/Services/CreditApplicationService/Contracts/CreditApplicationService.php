<?php

namespace App\Services\CreditApplicationService\Contracts;

use App\Entity\Car;
use App\Entity\Credit;
use App\Entity\CreditApplication;
use App\Services\CreditService\Contracts\CreditServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreditApplicationService implements CreditApplicationServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private CreditServiceInterface $creditService
    )
    {
    }

    public function apply(
        int $carId,
        int $creditId,
        int $initialPay,
        int $monthlyPay,
        int $duration
    ): void {
        $car = $this->em->getRepository(Car::class)->find($carId);

        if (!$car) {
            throw new NotFoundHttpException("Автомобиль не найден");
        }

        $selectedCredit = $this->em->getRepository(Credit::class)->find($creditId);
        $creditByParams = $this->creditService->selectCredit(
            $car->getPrice(),
            $initialPay,
            $monthlyPay,
            $duration
        );

        if ($selectedCredit !== $creditByParams) {
            throw new NotFoundHttpException("Произошла ошибка");
        }

        $creditApplication = new CreditApplication();

        $creditApplication
            ->setCar($car)
            ->setCredit($selectedCredit)
            ->setInitialPay($initialPay)
            ->setMonthlyPay($monthlyPay)
            ->setDuration($duration)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());

        $this->em->persist($creditApplication);
        $this->em->flush();
    }

    public function getApplications(): array
    {
        return $this->em->getRepository(CreditApplication::class)->findAll();
    }
}
