<?php

namespace App\Http\Controllers\admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Filters\OrdersPageFilter;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function ordersPage(Request $request, OrdersPageFilter $filter, $status = NULL)
    {
        $request->validate([
            'search' => 'nullable|min:1|max:500'
        ]);

        return view('pages.admin.orders', [
            'statuses' => OrderStatusEnum::values(),
            'orders' => Order::with(['service', 'user'])->filterByFunctions($filter, ['status' => $status])->paginate(50)->withQueryString(),
            'orderCount' => Order::filterByFunctions($filter, ['status' => $status])->count(),
            'currentStatus' => $status ?? '-'
        ]);
    }
}
