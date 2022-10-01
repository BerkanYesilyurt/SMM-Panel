<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewOrderRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderPage(){
        $categories = [];
        $services = [];

        foreach(Category::all() as $category){
            $categories[$category->id] = $category->name;
            $services[$category->id] = Category::find($category->id)->getServicesWithCategory();
        }

        return view('pages.new-order', compact('services', 'categories'));
    }

    public function massOrderPage(){
        return view('pages.massorders');
    }

    public function ordersPage(){
        return view('pages.orders');
    }

    public function createNewOrder(NewOrderRequest $request, Order $order){
        $user = User::find(auth()->user()->id);
        $userBalance = (new UserController)->getUserBalance();
        $orderService = Service::whereId($request->services)->first();
        $orderPrice = $orderService->price * $request->quantity / 1000;

        $lastUserBalance = $userBalance - $orderPrice;

        if($userBalance >= $orderPrice && $lastUserBalance >= 0){
            $orderId = DB::transaction(function () use($request, $user, $order, $orderService, $orderPrice, $lastUserBalance) {
                $user->update(['balance' => $lastUserBalance]);
                $createOrder = $order->create([
                    'user_id' => auth()->user()->id,
                    'service_id' => $orderService->id,
                    'link' => $request->link,
                    'quantity' => $request->quantity,
                    'charge' => $orderPrice,
                    'type' => $orderService->api_provider_id ? 'api' : 'manual',
                    'api_provider_id' => $orderService->api_provider_id ?? null,
                    'api_service_id' => $orderService->api_service_id ?? null,
                    'api_order_id' => null,
                    'status' => 'PENDING',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                return $createOrder->id;
            });

            return back()
                ->with([
                    'message' => 'You have successfully created order.',
                    'servicename' => $orderService->name,
                    'orderid' => $orderId,
                    'charge' => $orderPrice,
                    'link' => $request->link,
                    'quantity' => $request->quantity,
                ]);

        }else{
            return back()->withErrors(['NotEnoughBalance' => 'Your balance is not enough to place this order.']);
        }
    }
}
