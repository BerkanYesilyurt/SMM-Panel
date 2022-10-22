<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
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
        $this->count['opentickets'] = Ticket::whereNot('status', '=', 'CLOSED')->count();
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

    private function countRevenue(){
        $this->count['revenue'] = Order::whereNot('status','=','CANCELED')->sum('charge');
    }
}
