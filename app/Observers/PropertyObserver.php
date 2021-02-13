<?php

namespace App\Observers;

use App\Models\Property;
use App\Repositories\GeneralImagesProperty\GeneralImagesPropertyRepositoryInterface;
use App\Repositories\GeneralInfoProperty\GeneralInfoPropertyRepositoryInterface;

class PropertyObserver
{
    /**
     * @var \App\Repositories\GeneralInfoProperty\GeneralInfoPropertyEloquentRepository
     */
    private $generalInfoProperty;

    /**
     * @var \App\Repositories\GeneralImagesProperty\GeneralImagesPropertyEloquentRepository
     */
    private $generalImagesProperty;

    /**
     * PropertyObserver constructor.
     *
     * @param GeneralInfoPropertyRepositoryInterface $generalInfoProperty
     * @param GeneralImagesPropertyRepositoryInterface $generalImagesProperty
     */
    public function __construct(
        GeneralInfoPropertyRepositoryInterface $generalInfoProperty,
        GeneralImagesPropertyRepositoryInterface $generalImagesProperty
    ) {
        $this->generalInfoProperty = $generalInfoProperty;
        $this->generalImagesProperty = $generalImagesProperty;
    }

    /**
     * Handle the user "deleting" event.
     *
     * @param Property $property
     */
    public function deleting(Property $property)
    {
        $property->update(['unblock_status' => true]);
        $property->annualPerformances()->update(['unblock_status' => true]);
        $property->portfolioAnalysis()->update(['unblock_status' => true]);
        $property->simpleAssessment()->update(['unblock_status' => true]);
        $property->repairHistory()->update(['unblock_status' => true]);
        $property->rentRolls()->update(['unblock_status' => true]);
        $property->businessPlan()->update(['unblock_status' => true]);
        $property->monthlyBalances()->update(['unblock_status' => true]);
        $property->generalInfo()->update(['unblock_status' => true]);
        $property->generalImagesProperty()->update(['unblock_status' => true]);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param Property $property
     * @return void
     */
    public function deleted(Property $property)
    {
        $property->annualPerformances()->delete();
        $property->portfolioAnalysis()->delete();
        $property->simpleAssessment()->delete();
        $property->repairHistory()->delete();
        $property->rentRolls()->delete();
        $property->businessPlan()->delete();
        $property->monthlyBalances()->delete();
        $property->generalInfo()->delete();
        $property->generalImagesProperty()->delete();
    }
}
