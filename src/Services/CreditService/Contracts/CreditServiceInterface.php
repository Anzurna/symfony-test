<?php

namespace App\Services\CreditService\Contracts;

use App\Entity\Credit;

interface CreditServiceInterface
{
    /**
     * @param int $carPrice
     * @param int $initialPay
     * @param int $monthlyPay
     * @param int $duration Измеряется в месяцах
     *
     * @return Credit|null
     */
    public function selectCredit(
        int $carPrice,
        int $initialPay,
        int $monthlyPay,
        int $duration
    ): ?Credit;

    /**
     * @return array
     */
    public function getCredits(): array;
}
