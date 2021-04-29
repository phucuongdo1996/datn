<?php

namespace App\Repositories;

use App\Models\AdminRevenue;
use Illuminate\Support\Facades\DB;

class AdminRevenueEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return AdminRevenue::class;
    }

    public function getDataRevenue()
    {
        $sql = "select DATE_FORMAT(created_at,'%m-%Y') as month_year , SUM(CASE type WHEN 1 THEN value ELSE 0 END) AS revenue_agency, SUM(CASE type WHEN 2 THEN value ELSE 0 END) AS revenue_steam_code, SUM(CASE type WHEN 3 THEN value ELSE 0 END) AS revenue_recharge_money 
                from admin_revenue
                group by DATE_FORMAT(created_at,'%m-%Y')";
        $result = DB::select($sql);
        return collect($result);
    }
}
