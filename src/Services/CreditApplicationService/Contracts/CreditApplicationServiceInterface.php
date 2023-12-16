<?php

namespace App\Services\CreditApplicationService\Contracts;

interface CreditApplicationServiceInterface
{
    /**
     * @param int $carId
     * @param int $creditId
     * @param int $initialPay
     * @param int $monthlyPay
     * @param int $duration
     *
     * @return void
     */
    public function apply(
        int $carId,
        int $creditId,
        int $initialPay,
        int $monthlyPay,
        int $duration
    ): void;

    /**
     * @return array
     */
    public function getApplications(): array;
}
