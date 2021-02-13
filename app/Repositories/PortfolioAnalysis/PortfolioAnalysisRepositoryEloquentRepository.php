<?php

namespace App\Repositories\PortfolioAnalysis;

use App\Models\PortfolioAnalysis;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PortfolioAnalysisRepositoryEloquentRepository extends BaseRepository implements PortfolioAnalysisRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return PortfolioAnalysis::class;
    }

    /**
     * save data
     *
     * @param array $params
     * @return bool
     */
    public function saveData($params)
    {
        $user = Auth::user();
        try {
            PortfolioAnalysis::updateOrCreate(
                ['property_id' => $params['property_id'], 'user_id' => $user->isSubUser() ? $user->parent_id : $user->id],
                [
                    'route_price' => $params['route_price'],
                    'land_tax_assessment' => $params['land_tax_assessment'],
                    'estimate_inheritance_tax_valuation' => $params['estimate_inheritance_tax_valuation'],
                    'tax_land_price' => $params['tax_land_price'],
                    'land_evaluation_note' => $params['land_evaluation_note'],
                    'tax_valuation' => $params['tax_valuation'],
                    'building_selection' => $params['building_selection'],
                    'correction_factor' => $params['correction_factor'],
                    'inheritance_tax_valuation' => $params['inheritance_tax_valuation'],
                    'inheritance_tax_debt_balance' => $params['inheritance_tax_debt_balance'],
                    'noi_yield' => $params['noi_yield'],
                    'assessed_amount' => $params['assessed_amount'],
                    'assessed_amount_debt_balance' => $params['assessed_amount_debt_balance'],
                    'acquisition_price_yield' => $params['acquisition_price_yield'],
                ]
            );
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * Move portfolioAnalysis
     *
     * @param $userTo
     * @param $properties
     */
    public function movePortfolioAnalysis($userTo, $properties)
    {
        $this->model->withTrashed()->whereIn('property_id', $properties)->update(['user_id' => $userTo]);
    }
}
