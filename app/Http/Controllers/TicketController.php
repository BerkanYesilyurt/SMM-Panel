<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    public function index(Ticket $ticket){
        $tickets = $ticket->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return view('pages.tickets', compact('tickets'));
    }

    public function createTicket(Request $request){
        $fields = $request->validate([
            'subject'            => ['required', Rule::in(['order', 'payment', 'request', 'childpanel', 'other'])],
            'orderid'            => ['required_if:subject,=,order'],
            'order_request'      => ['required_if:subject,=,order', Rule::in(['refill', 'cancel', 'speed-up', 'other'])],
            'payid'              => ['required_if:subject,=,payment'],
            'feature_request'    => ['required_if:subject,=,request', Rule::in(['feature', 'service', 'other'])],
            'message'            => ['required']
        ]);

        $ticket = new Ticket();

        $ticket->user_id = auth()->user()->id;
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;

        if($request->subject == 'order'){
        $ticket->order_id = $request->orderid ?? NULL;
        $ticket->order_request = $request->order_request ?? NULL;
        }

        if($request->subject == 'payment'){
        $ticket->pay_type = $request->payment ?? NULL;
        $ticket->pay_id = $request->payid ?? NULL;
        }

        if($request->subject == 'request'){
            $ticket->feature_request = $request->feature_request ?? NULL;
        }

        $ticket->save();


        $ticketMessages = new TicketMessage();
        $ticketMessages->ticket_id = $ticket->id;
        $ticketMessages->user_id = auth()->user()->id;
        $ticketMessages->message = $request->message;
        $ticketMessages->save();


        alert()->success('Success!','You have successfully created a ticket.')->timerProgressBar();
        return redirect('/tickets');
    }

    public function ticketMessages($ticket_id, Ticket $ticket, TicketMessage $ticketMessage){
        $ownerOfTicket = $ticket->where('id', $ticket_id)->value('user_id');

        if(auth()->user()->id == $ownerOfTicket){
            $ticketMessages = $ticketMessage->where('ticket_id', $ticket_id)->orderBy('created_at', 'DESC')->get();
            return view('pages.ticket-messages', compact('ticketMessages'));
        }else{
            return redirect('/');
        }

    }
}
