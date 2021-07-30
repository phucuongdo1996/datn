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

    /**
     * Lấy data tạo biểu đồ doanh thu.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getDataRevenue()
    {
        $sql = "SELECT DATE_FORMAT(created_at,'%m-%Y') as month_year , SUM(CASE type WHEN 1 THEN value ELSE 0 END) AS revenue_agency, SUM(CASE type WHEN 2 THEN value ELSE 0 END) AS revenue_steam_code, SUM(CASE type WHEN 3 THEN value ELSE 0 END) AS revenue_recharge_money 
                FROM admin_revenue
                GROUP BY DATE_FORMAT(created_at,'%m-%Y')";
        $result = DB::select($sql);
        return collect($result);
    }

    /**
     * Lấy data tạo biểu đồ sản phẩm bán chạy.
     * @return \Illuminate\Support\Collection
     */
    public function getDataTopSeller()
    {
        $sql = "SELECT products_base.id, products_base.name, count(market.product_id) as 'y'
                FROM products_base, market, products 
                WHERE market.product_id = products.id AND products.product_base_id = products_base.id AND market.status = 2
                GROUP BY market.product_id
                ORDER BY count(market.product_id) DESC
                LIMIT 10
                ";
        $result = DB::select($sql);
        return collect($result);
    }
}
