<?php

namespace App\Http\View;
use App\Models\{Announcement,
    Api,
    ApiResponseLog,
    Category,
    ErrorLog,
    Faq,
    Order,
    PaymentLog,
    PaymentMethod,
    Service,
    ServiceUpdate,
    Ticket,
    User};

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
            'payment_logs' => PaymentLog::count(),
            'announcements' => Announcement::count(),
            'tickets' => Ticket::count(),
            'faq' => Faq::count(),
            'errors' => ErrorLog::count(),
            'api' => Api::count(),
            'api_response_logs' => ApiResponseLog::count()
        ]);
    }
}
