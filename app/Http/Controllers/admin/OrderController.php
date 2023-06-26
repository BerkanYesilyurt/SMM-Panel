<?php

namespace App\Http\Controllers\admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Filters\OrdersPageFilter;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function ordersPage(Request $request, OrdersPageFilter $filter)
    {
        $fields = $request->validate([
            'status' => ['nullable', Rule::in(array_merge(OrderStatusEnum::getOnlyValues()->toArray(), ['all']))]
        ]);

        return view('pages.admin.orders', [
            'statuses' => OrderStatusEnum::values(),
            'orders' => Order::with('getServiceName')->filterByFunctions($filter)->paginate(50)->appends($fields),
            'orderCount' => Order::filterByFunctions($filter)->count(),
            'currentStatus' => $request->status ?? '-'
        ]);
    }
}
