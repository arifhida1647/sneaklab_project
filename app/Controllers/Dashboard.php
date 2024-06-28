<?php

namespace App\Controllers;

use App\Models\ModelOrders;

use App\Models\ModelUsers;
class Dashboard extends BaseController
{
    public function index(): string
    {
        $model = new ModelOrders();
        $modelUsers = new ModelUsers();

        $totalUsers = $modelUsers->select('COUNT(user_id) as total_user')->first();

        $topOrders = $model->select('order_date, SUM(total_amount) as total_amount,COUNT(order_id) as order_count,  COUNT(DISTINCT user_id) as user_count')
            ->groupBy('order_date')
            ->orderBy('order_date', 'DESC')
            ->limit(5)
            ->findAll();

        $sumAmount = $model->select('SUM(total_amount) as total_amount_sum')->first();


        $topOrdersWithItems = $model->select('orders.order_date, SUM(orders.total_amount) as total_amount, COUNT(orders.order_id) as order_count, COUNT(DISTINCT orders.user_id) as user_count, GROUP_CONCAT(laundry_items.item_name SEPARATOR ", ") as item_names')
            ->join('laundry_items', 'laundry_items.item_id = orders.item_id')
            ->groupBy('orders.order_date')
            ->orderBy('orders.order_date', 'DESC')
            ->limit(5)
            ->findAll();

        $orderCounts = $model->select('COUNT(order_id) as total_orders,
            COUNT(CASE WHEN status = "pending" THEN 1 END) as pending_orders,
            COUNT(CASE WHEN status = "in progress" THEN 1 END) as in_progress_orders')
            ->first();

        $data['orders'] = [
            'topOrders' => $topOrders,
            'sumAmount' => $sumAmount['total_amount_sum'],
            'orderCounts' => $orderCounts,
            'totalUsers' => $totalUsers['total_user'],
        ];
        $data['tableOrders'] = [
            'topOrdersWithItems' => $topOrdersWithItems
        ];


        return view('dashboard_view', $data);
    }
}