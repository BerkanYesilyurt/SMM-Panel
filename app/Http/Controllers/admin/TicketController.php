<?php

namespace App\Http\Controllers\admin;

use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class TicketController extends Controller
{
    public function ticketPage()
    {
        return view('pages.admin.tickets', [
            'tickets' => Ticket::with('ticketMessages', 'user')->orderBy('created_at', 'DESC')->paginate(25)
        ]);
    }

    public function ticketMessages(Ticket $ticket)
    {
        TicketMessage::where('ticket_id', $ticket->id)->update(['seen_by_support' => 1]);

        return view('pages.admin.ticket', [
            'ticket' => $ticket,
            'ticketMessages' => TicketMessage::with('owner')->where('ticket_id', $ticket->id)->orderBy('created_at', 'ASC')->get(),
            'ticket_id' => $ticket->id,
            'status' => $ticket->status
        ]);
    }

    public function newTicketMessage(Request $request){
        $request->validate([
            'ticket_id'            => ['required', 'digits_between:1,10', 'exists:tickets,id'],
            'message'            => ['required', 'max:5000']
        ]);

        $ticketMessages = new TicketMessage();
        $ticketMessages->ticket_id = $request->ticket_id;
        $ticketMessages->user_id = auth()->user()->id;
        $ticketMessages->message = $request->message;
        $ticketMessages->seen_by_user = 0;
        $ticketMessages->seen_by_support = 1;
        $ticketMessages->save();

        return back()->with('message', 'You have successfully sent the message!');
    }

    public function updateTicketStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => ['required', new Enum(TicketStatusEnum::class)]
        ]);

        $ticket->update(['status' => $request->status]);
        return back()->with('message', 'You have successfully updated the ticket status!');
    }

    public function deleteTicketAndRelatedMessages(Request $request)
    {
        $request->validate([
            'delete_id' => 'required|numeric|exists:tickets,id',
        ]);

        DB::transaction(function () use($request){
            Ticket::where('id', $request->delete_id)->delete();
            TicketMessage::where('ticket_id', $request->delete_id)->delete();
        });

        return back()->with('message', 'You have successfully deleted ticket and related messages.');

    }
}
