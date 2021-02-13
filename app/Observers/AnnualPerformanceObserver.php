<?php

namespace App\Observers;

use App\Models\AnnualPerformance;
use App\Repositories\Tax\TaxRepositoryInterface;
use App\Repositories\TaxProperty\TaxPropertyRepositoryInterface;

class AnnualPerformanceObserver
{
    /**
     * Variable property repository
     *
     * @var \App\Repositories\Tax\TaxEloquentRepository;
     */
    private $taxRepository;

    /**
     * Variable property repository
     *
     * @var \App\Repositories\TaxProperty\TaxPropertyEloquentRepository;
     */
    private $taxPropertyRepository;

    /**
     * AnnualPerformanceObserver constructor.
     *
     * @param TaxRepositoryInterface $taxRepository
     * @param TaxPropertyRepositoryInterface $taxPropertyRepository
     */
    public function __construct(
        TaxRepositoryInterface $taxRepository,
        TaxPropertyRepositoryInterface $taxPropertyRepository
    ) {
        $this->taxRepository = $taxRepository;
        $this->taxPropertyRepository = $taxPropertyRepository;
    }

    /**
     * Handle the annual performance "updated" event.
     *
     * @param  \App\Models\AnnualPerformance  $annualPerformance
     * @return void
     */
    public function updated(AnnualPerformance $annualPerformance)
    {
        $oldData = (array) json_decode(request()->old_data);
        $this->taxRepository->autoUpdateData($annualPerformance->toArray(), $oldData, $this->taxPropertyRepository->getRecordsUpdate($oldData['property_id'], $oldData['year'], $annualPerformance->property->date_month_registration_revenue));
    }

    /**
     * Handle the annual performance "deleted" event.
     *
     * @param  \App\Models\AnnualPerformance  $annualPerformance
     * @return void
     */
    public function deleted(AnnualPerformance $annualPerformance)
    {
        $oldData = (array) json_decode(request()->old_data);
        $oldData['delete'] = true;
        $this->taxRepository->autoUpdateData(DEFAULT_PARAMS_TAX, $oldData, $this->taxPropertyRepository->getRecordsUpdate($oldData['property_id'], $oldData['year'], $annualPerformance->property->date_month_registration_revenue));
    }
}
