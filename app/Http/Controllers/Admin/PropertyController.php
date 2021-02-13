<?php

namespace App\Http\Controllers\Admin;

use App\Api\AddressApi;
use App\Events\EditProperty;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use Illuminate\Support\Facades\Session;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\LandRight\LandRightRepositoryInterface;
use App\Repositories\TypeRental\TypeRentalRepositoryInterface;
use App\Repositories\BuildingRight\BuildingRightRepositoryInterface;
use App\Repositories\HouseMaterial\HouseMaterialRepositoryInterface;
use App\Repositories\HouseRoofType\HouseRoofTypeRepositoryInterface;
use App\Repositories\RealEstateType\RealEstateTypeRepositoryInterface;
use App\Repositories\DetailRealEstateType\DetailRealEstateTypeRepositoryInterface;

class PropertyController extends Controller
{
    /**
     * Variable property repository
     *
     * @var \App\Repositories\Property\PropertyEloquentRepository;
     */
    private $propertyRepository;

    /**
     * Variable real estate type repository
     *
     * @var \App\Repositories\RealEstateType\RealEstateTypeEloquentRepository
     */
    private $realEstateTypeRepository;

    /**
     * Variable detail real estate type repository
     *
     * @var \App\Repositories\DetailRealEstateType\DetailRealEstateTypeEloquentRepository
     */
    private $detailRealEstateTypeRepository;

    /**
     * Variable building right repository
     *
     * @var \App\Repositories\BuildingRight\BuildingRightEloquentRepository
     */
    private $buildingRightRepository;

    /**
     * Variable land right repository
     *
     * @var \App\Repositories\LandRight\LandRightEloquentRepository
     */
    private $landRightRepository;

    /**
     * Variable house roof type repository
     *
     * @var \App\Repositories\HouseRoofType\HouseRoofTypeEloquentRepository
     */
    private $houseRoofTypeRepository;

    /**
     * Variable house material repository
     *
     * @var \App\Repositories\HouseMaterial\HouseMaterialEloquentRepository
     */
    private $houseMaterialRepository;

    /**
     * Variable type rental repository
     *
     * @var \App\Repositories\TypeRental\TypeRentalEloquentRepository
     */
    private $typeRentalRepository;

    /**
     * Variable user repository
     *
     * @var \App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * PropertyController constructor.
     *
     * @param PropertyRepositoryInterface $propertyRepository
     * @param RealEstateTypeRepositoryInterface $realEstateTypeRepository
     * @param DetailRealEstateTypeRepositoryInterface $detailRealEstateTypeRepository
     * @param BuildingRightRepositoryInterface $buildingRightRepository
     * @param LandRightRepositoryInterface $landRightRepository
     * @param HouseRoofTypeRepositoryInterface $houseRoofTypeRepository
     * @param HouseMaterialRepositoryInterface $houseMaterialRepository
     * @param TypeRentalRepositoryInterface $typeRentalRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        RealEstateTypeRepositoryInterface $realEstateTypeRepository,
        DetailRealEstateTypeRepositoryInterface $detailRealEstateTypeRepository,
        BuildingRightRepositoryInterface $buildingRightRepository,
        LandRightRepositoryInterface $landRightRepository,
        HouseRoofTypeRepositoryInterface $houseRoofTypeRepository,
        HouseMaterialRepositoryInterface $houseMaterialRepository,
        TypeRentalRepositoryInterface $typeRentalRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->propertyRepository = $propertyRepository;
        $this->realEstateTypeRepository = $realEstateTypeRepository;
        $this->detailRealEstateTypeRepository = $detailRealEstateTypeRepository;
        $this->buildingRightRepository = $buildingRightRepository;
        $this->landRightRepository = $landRightRepository;
        $this->houseRoofTypeRepository = $houseRoofTypeRepository;
        $this->houseMaterialRepository = $houseMaterialRepository;
        $this->typeRentalRepository = $typeRentalRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $propertyId
     * @param  $addressApi
     * @return mixed
     */
    public function edit($propertyId, AddressApi $addressApi)
    {
        $property = $this->propertyRepository->getObjectById($propertyId);

        return view('backend.admin.property.edit', [
            'property' => $property,
            'userOwner' => $this->userRepository->getById($property['user_id'], ['id', 'role']),
            'listProperty' =>  $this->propertyRepository->getListNameByUserId($property['user_id'], $propertyId),
            'listReadEstateType' => $this->realEstateTypeRepository->getAll(),
            'listDetailReadEstateType' => $this->detailRealEstateTypeRepository->getAll(),
            'listHouseMaterial' => $this->houseMaterialRepository->getAll(),
            'listHouseRoofType' => $this->houseRoofTypeRepository->getAll(),
            'listBuildingRight' => $this->buildingRightRepository->getAll(),
            'listLandRight' => $this->landRightRepository->getAll(),
            'listTypeRental' => $this->typeRentalRepository->getAll(),
            'prefectures' => $addressApi->getDataPrefecture(),
            'districts' => $addressApi->getDataDistrict(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function update(PropertyRequest $request)
    {
        $propertyData = $request->convertDateProperty();
        $propertyData['rental_percentage'] = preg_replace('[%]', '', $propertyData['rental_percentage']);
        $property = $this->propertyRepository->findOrFail($propertyData['property_id']);
        if (date_format($property->updated_at, 'Y/m/d H:i:s') > $propertyData['time_open_page']) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['updated' => false]);
        }
        $propertyOld = $this->propertyRepository->getDataPropertyWithUserProfile($propertyData['property_id']);
        $result = $this->propertyRepository->updateRecord($property, $propertyData);
        if ($result) {
            $dataDirty = $result->getChanges();
            $dataDirty['bank_name'] = $propertyData['bank_name'];
            $dataDirty['loan_bank_branch_name'] = $propertyData['loan_bank_branch_name'];
            event(new EditProperty($dataDirty, $this->propertyRepository->getDataPropertyWithUserProfile($propertyData['property_id']), $propertyOld));
            return response()->json(['updated' => true, 'redirect' => route(ADMIN_MANAGE_USER_DETAIL_INDEX, $property->user_id)]);
        }
        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return response()->json(['message' => 'Update data fail.']);
    }
}
