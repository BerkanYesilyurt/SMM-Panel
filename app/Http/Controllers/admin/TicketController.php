<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ticketPage()
    {
        return view('pages.admin.tickets', [
            'tickets' => Ticket::with('ticketMessages', 'user')->get()
        ]);
    }

    public function ticketMessages(Ticket $ticket)
    {
        TicketMessage::where('ticket_id', $ticket->id)->update(['seen_by_support' => 1]);

        return view('pages.admin.ticket', [
            'ticketMessages' => TicketMessage::with('owner')->where('ticket_id', $ticket->id)->orderBy('created_at', 'ASC')->get(),
            'ticket_id' => $ticket->id,
            'status' => $ticket->value('status')
        ]);
    }
}
