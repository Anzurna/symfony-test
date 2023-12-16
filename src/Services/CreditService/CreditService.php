<?php

namespace App\Services\CreditService;

use App\Entity\Credit;
use App\Entity\PushHistory;
use App\Services\CreditService\Contracts\CreditServiceInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

class CreditService implements CreditServiceInterface
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    /**
     * @inheritDoc
     */
    public function selectCredit(
        int $carPrice,
        int $initialPay,
        int $monthlyPay,
        int $duration
    ): ?Credit {
        $criteria = Criteria::create();
        $expr = $criteria::expr();

        $criteria->andWhere($criteria::expr()->lte("carPriceLowerBound", $carPrice));
        $criteria->andWhere($criteria::expr()->gte("carPriceUpperBound", $carPrice));

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
        int $carPrice,
        int $monthlyPay,
        int $initialPay,
        int $duration
    ): int {
        return ($monthlyPay * $duration) - ($carPrice - $initialPay);
    }

    public function getCredits(): array
    {
        return $this->em->getRepository(Credit::class)->findAll();
    }
}
