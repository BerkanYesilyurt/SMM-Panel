<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function ordersPage()
    {
        return view('pages.admin.orders', [
            'orders' => Order::with('getServiceName')->paginate(50),
            'orderCount' => Order::count()
        ]);
    }
}
