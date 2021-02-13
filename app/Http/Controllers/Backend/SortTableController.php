<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Property\PropertyEloquentRepository;
use App\Repositories\Property\PropertyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SortTableController extends Controller
{
    /**
     * Variable property repository
     *
     * @var PropertyEloquentRepository
     */
    private $propertyRepository;

    /**
     * SortTableController constructor.
     *
     * @param PropertyRepositoryInterface $propertyRepository
     */
    public function __construct(
        PropertyRepositoryInterface $propertyRepository
    ) {
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View;
     */
    public function index()
    {
        $user = Auth::user();
        abort_if($user->isSubUser(), 404);
        $listProperty = $this->propertyRepository->getListByCondition($user->id);
        return view('backend.property.sort_table', compact('listProperty'));
    }

    /**
     * update order property
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrderProperty(Request $request)
    {
        $params = $request->all();
        $result = $this->propertyRepository->updateOrder($params);

        if ($result == true) {
            return response()->json(['updated' => true]);
        } else {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['updated' => false]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
