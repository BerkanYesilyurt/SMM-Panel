<?php

namespace App\Http\View;
use App\Models\{Announcement, Api, Category, ErrorLog, Faq, Order, PaymentMethod, Service, ServiceUpdate, Ticket, User};

use Illuminate\View\View;
class AdminMenuCountsComposer
{
    public function compose(View $view)
    {
        $view->with('__menuCounts', [
            'users' => User::count(),
            'orders' => Order::count(),
            'categories' => Category::count(),
            'services' => Service::count(),
            'service_updates' => ServiceUpdate::count(),
            'payment_methods' => PaymentMethod::count(),
            'announcements' => Announcement::count(),
            'tickets' => Ticket::count(),
            'faq' => Faq::count(),
            'errors' => ErrorLog::count(),
            'api' => Api::count()
        ]);
    }
}
