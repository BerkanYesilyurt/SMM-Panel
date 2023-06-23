<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Events\OrderPlaced;
use App\Http\Filters\OrdersPageFilter;
use App\Http\Requests\NewOrderRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function orderPage(){
        $categories = [];
        $services = [];

        foreach(Category::all() as $category){
            if($category->status == CategoryStatusEnum::ACTIVE->value){
                $categories[$category->id] = $category->name;
                $services[$category->id] = Category::find($category->id)->getServicesWithCategory();
            }
        }

        $count = [
            'myorderscount' => Order::where('user_id','=', auth()->user()->id)->count(),
            'totalorderscount' => Order::count()
        ];

        return view('pages.new-order', compact('services', 'categories', 'count'));
    }

    public function massOrderPage(){
        return view('pages.massorders');
    }

    public function ordersPage(Request $request, OrdersPageFilter $filter){
        $fields = $request->validate([
            'status' => ['nullable', 'integer', Rule::in(OrderStatusEnum::getOnlyValues())]
        ]);
        $orderCount = Order::filterByFunctions($filter)->count();
        $userOrders = Order::with('getServiceName')->filterByFunctions($filter)->paginate(18);

        return view('pages.orders', [
            'statuses' => OrderStatusEnum::values(),
            'userOrders' => $userOrders->appends($fields),
            'orderCount' => $orderCount,
            'currentStatus' => $request->status ?? '-'
        ]);
    }

    public function createNewOrder(NewOrderRequest $request, Order $order){
        $user = User::find(auth()->user()->id);
        $userBalance = (new UserController)->getUserBalance();
        $orderService = Service::whereId($request->services)->first();
        $orderPrice = $orderService->price * (int)$request->quantity / 1000;
        $lastUserBalance = $userBalance - $orderPrice;

        if($request->quantity < 0 || ($request->quantity < $orderService->min) || $orderService->max < $request->quantity){
            return back()->withErrors(['QuantityError' => 'The quantity you entered for this service is not appropriate. Must be between ' . $orderService->min . ' and ' . $orderService->max . '.']);
        }

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
                    //'api_order_id' => null,
                    //'start_count' => null,
                    //'remain' => null,
                    'status' => OrderStatusEnum::PENDING->value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                return $createOrder->id;
            });

            if($orderService->api_provider_id){
                event(new OrderPlaced(Order::find($orderId)));
            }

            return back()
                ->with([
                    'message' => 'You have successfully created order.',
                    'servicename' => $orderService->name,
                    'orderid' => $orderId,
                    'charge' => $orderPrice,
                    'link' => $request->link,
                    'quantity' => (int)$request->quantity,
                ]);

        }else{
            return back()->withErrors(['NotEnoughBalance' => 'Your balance is not enough to place this order.']);
        }
    }
}
