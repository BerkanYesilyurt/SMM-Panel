<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Ticket $ticket){
        $tickets = $ticket->where('user_id', auth()->user()->id)->get();
        return view('pages.tickets', compact('tickets'));
    }
}
