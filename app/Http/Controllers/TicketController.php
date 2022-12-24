<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatusEnum;
use App\Enums\UserAuthorityEnum;
use App\Http\Requests\CreateTicketRequest;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('isticketbanned');
    }

    public function index(Ticket $ticket){
        $tickets = $ticket->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return view('pages.tickets', compact('tickets'));
    }

    public function createTicket(CreateTicketRequest $request){

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
        $ticketMessages->seen_by_user = 1;
        $ticketMessages->seen_by_support = 0;
        $ticketMessages->save();


        alert()->success('Success!','You have successfully created a ticket.')->timerProgressBar();
        return redirect('/tickets');
    }

    public function ticketMessages($ticket_id, Ticket $ticket, TicketMessage $ticketMessage){
        $relatedTicket = $ticket->where('id', $ticket_id)->first();

        if(auth()->user()->id == $relatedTicket->user_id){
            $ticketMessages = $ticketMessage->where('ticket_id', $ticket_id)->orderBy('created_at', 'ASC')->get();
            TicketMessage::where('ticket_id', $ticket_id)->update(['seen_by_user' => 1]);

            return view('pages.ticket-messages', compact('ticketMessages'))
                ->with('ticket_id', $ticket_id)
                ->with('status', $relatedTicket->status);
        }else{
            return redirect('/');
        }

    }

    public function newTicketMessage(Request $request, Ticket $ticket){
        $request->validate([
            'ticket_id'            => ['required', 'digits_between:1,10'],
            'message'            => ['required', 'max:5000']
        ]);

        $relatedTicket = $ticket->where('id', $request->ticket_id)->first();
        if(auth()->user()->id == $relatedTicket->user_id && $relatedTicket->status != TicketStatusEnum::CLOSED->value){
        $ticketMessages = new TicketMessage();
        $ticketMessages->ticket_id = $request->ticket_id;
        $ticketMessages->user_id = auth()->user()->id;
        $ticketMessages->message = $request->message;
        $ticketMessages->seen_by_user = 1;
        $ticketMessages->seen_by_support = 0;
        $ticketMessages->save();

        alert()->success('Success!','You have successfully sent the message.')->timerProgressBar();
        return back();
        }else{
            return redirect('/');
        }
    }
}
