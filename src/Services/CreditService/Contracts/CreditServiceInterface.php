<?php

namespace App\Services\CreditService\Contracts;

use App\Entity\Car;
use App\Entity\Credit;

interface CreditServiceInterface
{
    /**
     * @param Car $car
     * @param int $initialPay
     * @param int $monthlyPay
     * @param int $duration Измеряется в месяцах
     *
     * @return Credit|null
     */
    public function selectCredit(
        Car $car,
        int $initialPay,
        int $monthlyPay,
        int $duration
    ): ?Credit;

    /**
     * @return array
     */
    public function getCredits(): array;

    /**
     * @param Car    $car
     * @param Credit $credit
     * @param int    $monthlyPay
     * @param int    $initialPay
     * @param int    $duration
     *
     * @return array
     */
    public function getClientData(
        Car $car,
        Credit $credit,
        int $monthlyPay,
        int $initialPay,
        int $duration,
    ): array;
}
