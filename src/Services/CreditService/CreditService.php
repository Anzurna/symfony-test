<?php

namespace App\Services\CreditService;

use App\Entity\Car;
use App\Entity\Credit;
use App\Entity\PushHistory;
use App\Services\CreditService\Contracts\CreditServiceInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreditService implements CreditServiceInterface
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    /**
     * @inheritDoc
     */
    public function selectCredit(
        Car $car,
        int $initialPay,
        int $monthlyPay,
        int $duration
    ): ?Credit {
        $criteria = Criteria::create();
        $expr = $criteria::expr();

        $criteria->andWhere($criteria::expr()->lte("carPriceLowerBound", $car->getPrice()));
        $criteria->andWhere($criteria::expr()->gte("carPriceUpperBound", $car->getPrice()));

        $criteria->andWhere($expr->lte("initialPayLowerBound", $initialPay));
        $criteria->andWhere($expr->gte("initialPayUpperBound", $initialPay));

        $criteria->andWhere($expr->lte("monthlyPayLowerBound", $monthlyPay));
        $criteria->andWhere($expr->gte("monthlyPayUpperBound", $monthlyPay));

        $criteria->andWhere($expr->lte("durationLowerBound", $duration));
        $criteria->andWhere($expr->gte("durationUpperBound", $duration));

        $credits = $this->em->getRepository(Credit::class)->matching($criteria);

        $highestPriorityCredit = null;
        foreach ($credits as $credit) {
            if (
                !$highestPriorityCredit
                || $credit->getPriority() > $highestPriorityCredit->getPriority()
            ) {
                $highestPriorityCredit = $credit;
            }
        }

        return $highestPriorityCredit;
    }

    public function getCumulativeInterest(
        Car $car,
        int $monthlyPay,
        int $initialPay,
        int $duration
    ): int {
        return ($monthlyPay * $duration) - ($car->getPrice() - $initialPay);
    }

    public function getCredits(): array
    {
        return $this->em->getRepository(Credit::class)->findAll();
    }

    #[ArrayShape([
        "credit_id" => "int|null",
        "cumulative_interest" => "mixed",
        "interest_rate" => "float|null",
        "monthly_payment" => "int|null"
    ])]
    public function getClientData(
        Car $car,
        Credit $credit,
        int $monthlyPay,
        int $initialPay,
        int $duration,
    ): array {
        return [
            "credit_id" => $credit->getId(),
            "cumulative_interest" => $this->getCumulativeInterest(
                $car, $monthlyPay, $initialPay, $duration
            ),
            "interest_rate" => $credit->getInterestRate(),
            "monthly_payment" => $credit->getMonthlyPayLowerBound()
        ];
    }
}
