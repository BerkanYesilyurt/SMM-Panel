<?php

namespace App\Http\Controllers\admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Filters\OrdersPageFilter;
use App\Models\Order;

class OrderController extends Controller
{
    public function ordersPage(OrdersPageFilter $filter, $status = NULL)
    {
        if($status && !in_array($status, OrderStatusEnum::getOnlyNames(true)->toArray())){
            return redirect()->route('admin-orders');
        }

        return view('pages.admin.orders', [
            'statuses' => OrderStatusEnum::values(),
            'orders' => Order::with('getServiceName')->filterByFunctions($filter, ['status' => $status])->paginate(50)->withQueryString(),
            'orderCount' => Order::filterByFunctions($filter, ['status' => $status])->count(),
            'currentStatus' => $status ?? '-'
        ]);
    }
}
