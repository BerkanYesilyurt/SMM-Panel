<?php

namespace App\Http\Controllers\admin;

use App\Enums\OrderStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CountController extends Controller
{
    public array $count = [];

    public function countAll(){
        foreach(get_class_methods($this) as $class){
            if($class != 'countAll' && Str::startsWith($class, 'count')){
               $this->$class();
            }
        }
        return $this->count;
    }

    private function countUsers(){
        $this->count['users'] = User::count();
    }

    private function countTickets(){
        $this->count['tickets'] = Ticket::count();
        $this->count['opentickets'] = Ticket::whereNot('status', '=', TicketStatusEnum::CLOSED->value)->count();
    }

    private function countOrders(){
        $this->count['orders'] = Order::count();
    }

    private function countServices(){
        $this->count['services'] = Service::count();
    }

    private function countCategories(){
        $this->count['categories'] = Category::count();
    }

    private function countAnnouncements(){
        $this->count['announcements'] = Announcement::count();
    }

    private function countTotalRevenue(){
        $this->count['revenue']['total'] = Order::whereNot('status','=',OrderStatusEnum::CANCELED->value)->sum('charge');
    }

    private function countRevenue(){
       $this->count['revenue']['last30days'] = Order::whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->whereNot('status','=', OrderStatusEnum::CANCELED->value)->sum('charge');
       $this->count['revenue']['last90days'] = Order::whereBetween('created_at', [Carbon::now()->subDays(90), Carbon::now()])->whereNot('status','=', OrderStatusEnum::CANCELED->value)->sum('charge');
       $this->count['revenue']['last180days'] = Order::whereBetween('created_at', [Carbon::now()->subDays(180), Carbon::now()])->whereNot('status','=', OrderStatusEnum::CANCELED->value)->sum('charge');
       $this->count['revenue']['last365days'] = Order::whereBetween('created_at', [Carbon::now()->subDays(365), Carbon::now()])->whereNot('status','=', OrderStatusEnum::CANCELED->value)->sum('charge');
    }

    private function countNumberOfUsers(){
        //Last 12 Months
        for($month = 12; $month >= 1; $month--){
            $this->count['numberofusers'][Carbon::now()->subMonths($month-1)->format('F')] = User::whereBetween('created_at', [Carbon::now()->subMonths($month), Carbon::now()->subMonths($month-1)])->count();
        }
    }

    private function countNumberOfOrders(){
        //Last 12 Months
        for($month = 12; $month >= 1; $month--){
            $this->count['numberoforders'][Carbon::now()->subMonths($month-1)->format('F')] = Order::whereBetween('created_at', [Carbon::now()->subMonths($month), Carbon::now()->subMonths($month-1)])->count();
        }
    }
}
