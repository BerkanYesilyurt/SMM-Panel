<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ticketPage()
    {
        return view('pages.admin.tickets', [
            'tickets' => Ticket::with('ticketMessages')->get()
        ]);
    }
}
