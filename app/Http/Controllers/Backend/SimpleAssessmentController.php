<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SimpleAssessmentRequest;
use App\Repositories\AnnualPerformance\AnnualPerformanceRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\SimpleAssessment\SimpleAssessmentRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyRepositoryInterface;
use App\Traits\UrlRedirectCustom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SimpleAssessmentController extends Controller
{
    use UrlRedirectCustom;

    /**
     * Variable simple assessment repository
     *
     * @var \App\Repositories\SimpleAssessment\SimpleAssessmentEloquentRepository;
     */
    private $simpleAssessmentRepository;

    /**
     * Variable property repository
     *
     * @var \App\Repositories\Property\PropertyEloquentRepository;
     */
    private $propertyRepository;

    /**
     * @var SubUserPropertyRepositoryInterface
     */
    private $subUserPropertyRepository;

    /**
     * @var AnnualPerformanceRepositoryInterface
     */
    private $annualPerformanceRepository;

    /**
     * SimpleAssessmentController constructor.
     * @param SimpleAssessmentRepositoryInterface $simpleAssessmentRepository
     * @param PropertyRepositoryInterface $propertyRepository
     * @param SubUserPropertyRepositoryInterface $subUserPropertyRepository
     * @param AnnualPerformanceRepositoryInterface $annualPerformanceRepository
     */
    public function __construct(
        SimpleAssessmentRepositoryInterface $simpleAssessmentRepository,
        PropertyRepositoryInterface $propertyRepository,
        SubUserPropertyRepositoryInterface $subUserPropertyRepository,
        AnnualPerformanceRepositoryInterface $annualPerformanceRepository
    ) {
        $this->simpleAssessmentRepository = $simpleAssessmentRepository;
        $this->propertyRepository = $propertyRepository;
        $this->subUserPropertyRepository = $subUserPropertyRepository;
        $this->annualPerformanceRepository = $annualPerformanceRepository;
    }

    /**
     * Show the form for editing the simple assessment of property resourc
     *
     * @param Request $request
     * @param $propertyId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createOrEditSimpleAssessment(Request $request, $propertyId)
    {
        $params = $request->all();
        $property = $this->propertyRepository->getObjectPropertyAndSimpleAssessmentById($propertyId);
        abort_if(!$property, 404);
        $property['noi_yield'] = divisionNumber($property['total_revenue'] - $property['total_cost'], $property['money_receive_house']) * 100;
        $property['amount_assessed_taxing'] = divisionNumber($property['noi_yield'], $property['net_profit']);
        $simpleAssessment = $property['simple_assessment'];
        if (!isset($params['year'])) {
            $params['year'] = isset($simpleAssessment['year']) ? $simpleAssessment['year'] : null;
        }
        $listAnnualPerformance = $this->annualPerformanceRepository->getListYearAnnualPerformance($propertyId);
        $annualPerformance = isset($listAnnualPerformance[$params['year']]) ? $listAnnualPerformance[$params['year']] : [];
        return view('backend.report.simple_assessment.addOrEdit', compact('property', 'simpleAssessment', 'listAnnualPerformance', 'annualPerformance', 'params'));
    }

    /**
     * Update the simple assessment resource in storage.
     *
     * @param SimpleAssessmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeOrUpdateSimpleAssessment(SimpleAssessmentRequest $request)
    {
        $simpleAssessmentData = $request->validatedForm();
        $updatedAt = $this->simpleAssessmentRepository->find($simpleAssessmentData['property_id']);
        if ($updatedAt) {
            if (date_format($updatedAt['updated_at'], 'Y/m/d H:i:s') > $simpleAssessmentData['time_open_page']) {
                Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
                return redirect()->back();
            }
        }

        if ($this->simpleAssessmentRepository->saveData($simpleAssessmentData)) {
            return $this->hasScreenParam()
                ? redirect($this->setPerPage()->setNumberPage($simpleAssessmentData['property_id'])->buildUrlRedirect())
                : redirect(route(USER_REPORT));
        }

        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return redirect()->back();
    }
}
