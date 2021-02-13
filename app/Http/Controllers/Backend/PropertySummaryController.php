<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\AnnualPerformance\AnnualPerformanceRepositoryInterface;
use App\Repositories\GeneralImagesProperty\GeneralImagesPropertyRepositoryInterface;
use App\Repositories\GeneralInfoProperty\GeneralInfoPropertyRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyRepositoryInterface;
use App\Traits\UrlRedirectCustom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PropertySummaryController extends Controller
{
    use UrlRedirectCustom;

    /**
     * @var GeneralInfoPropertyRepositoryInterface
     */
    private $generalInfoPropertyRepository;

    /**
     * @var GeneralImagesPropertyRepositoryInterface
     */
    private $generalImagesPropertyRepository;

    /**
     * @var PropertyRepositoryInterface
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
     * PropertySummaryController constructor.
     * @param GeneralInfoPropertyRepositoryInterface $generalInfoPropertyRepository
     * @param GeneralImagesPropertyRepositoryInterface $generalImagesPropertyRepository
     * @param PropertyRepositoryInterface $propertyRepository
     * @param SubUserPropertyRepositoryInterface $subUserPropertyRepository
     * @param AnnualPerformanceRepositoryInterface $annualPerformanceRepository
     */
    public function __construct(
        GeneralInfoPropertyRepositoryInterface $generalInfoPropertyRepository,
        GeneralImagesPropertyRepositoryInterface $generalImagesPropertyRepository,
        PropertyRepositoryInterface $propertyRepository,
        SubUserPropertyRepositoryInterface $subUserPropertyRepository,
        AnnualPerformanceRepositoryInterface $annualPerformanceRepository
    ) {
        $this->generalInfoPropertyRepository = $generalInfoPropertyRepository;
        $this->generalImagesPropertyRepository = $generalImagesPropertyRepository;
        $this->propertyRepository = $propertyRepository;
        $this->subUserPropertyRepository = $subUserPropertyRepository;
        $this->annualPerformanceRepository = $annualPerformanceRepository;
    }

    /**
     * @param $propertyId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function create($propertyId, Request $request)
    {
        $params = $request->all();
        if (!$this->subUserPropertyRepository->handleCheckPermission($propertyId, REPORT_SCREEN)) {
            return redirect()->route(USER_REPORT)->with(STR_ERROR_FLASH, trans('messages.sub_user.report_permission_denied'));
        }
        $property = $this->propertyRepository->find($propertyId);
        $generalInfo = $this->generalInfoPropertyRepository
            ->findByAttribute('property_id', $propertyId);
        $generalImages = $this->generalImagesPropertyRepository->getImages($propertyId);
        if ($generalInfo) {
            $generalInfo = $generalInfo->toArray();
        }
        $property = $property
            ->load('detailRealEstateType', 'realEstateType', 'houseMaterial', 'houseRoofType', 'landRight', 'typeRental', 'buildingRight')
            ->toArray();
        if (!isset($params['year'])) {
            $params['year'] = isset($generalInfo['year']) ? $generalInfo['year'] : null;
        }
        $listAnnualPerformance = $this->annualPerformanceRepository->getListYearAnnualPerformance($propertyId);
        $annualPerformance = isset($listAnnualPerformance[$params['year']]) ? $listAnnualPerformance[$params['year']] : [];
//dd($annualPerformance);
        return view(
            'backend.property.essential',
            compact('property', 'generalInfo', 'generalImages', 'listAnnualPerformance', 'annualPerformance', 'params')
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (!$this->subUserPropertyRepository->handleCheckPermission($request->property_id, REPORT_SCREEN)) {
            return redirect()->route(USER_REPORT)->with(STR_ERROR_FLASH, trans('messages.sub_user.report_permission_denied'));
        }
        $property = $this->propertyRepository->find($request->property_id);
        abort_if(!$property, 404);
        $generalInfo = $this->generalInfoPropertyRepository->createRecord($request->all());
        if ($generalInfo) {
            return $this->hasScreenParam()
                ? redirect($this->setPerPage()->setNumberPage($property->id, targetUserId())->buildUrlRedirect())
                : redirect(route(USER_PROPERTY_INDEX));
        } else {
            Session::flash(
                STR_ERROR_FLASH,
                trans('attributes.common.system_error_messages')
            );
            return redirect()->back();
        }
    }
}
