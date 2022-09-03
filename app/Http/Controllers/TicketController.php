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
            'subject'            => ['required', 'max:100', Rule::in(['order', 'payment', 'request', 'childpanel', 'other'])],
            'orderid'            => ['required_if:subject,=,order', 'max:180'],
            'order_request'      => ['required_if:subject,=,order', 'max:100', Rule::in(['refill', 'cancel', 'speed-up', 'other'])],
            'payid'              => ['required_if:subject,=,payment', 'max:100'],
            'feature_request'    => ['required_if:subject,=,request', 'max:100', Rule::in(['feature', 'service', 'other'])],
            'message'            => ['required', 'max:5000']
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
        $relatedTicket = $ticket->where('id', $ticket_id);

        if(auth()->user()->id == $relatedTicket->value('user_id')){
            $ticketMessages = $ticketMessage->where('ticket_id', $ticket_id)->orderBy('created_at', 'ASC')->get();
            return view('pages.ticket-messages', compact('ticketMessages'))
                ->with('ticket_id', $ticket_id)
                ->with('status', $relatedTicket->value('status'));
        }else{
            return redirect('/');
        }

    }

    public function newTicketMessage(Request $request, Ticket $ticket){
        $request->validate([
            'ticket_id'            => ['required', 'digits_between:1,10'],
            'message'            => ['required', 'max:5000']
        ]);

        $relatedTicket = $ticket->where('id', $request->ticket_id);
        if(auth()->user()->id == $relatedTicket->value('user_id')){
        $ticketMessages = new TicketMessage();
        $ticketMessages->ticket_id = $request->ticket_id;
        $ticketMessages->user_id = auth()->user()->id;
        $ticketMessages->message = $request->message;
        $ticketMessages->save();

        alert()->success('Success!','You have successfully sent the message.')->timerProgressBar();
        return back();
        }else{
            return redirect('/');
        }
    }
}
