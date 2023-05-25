<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatusEnum;
use App\Http\Requests\CreateTicketRequest;
use App\Models\PaymentMethod;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('isticketbanned');
        $this->middleware(function($request, $next){
            if(configValue('ticket_status')){
                return $next($request);
            }
            return redirect('/');
        });
    }

    public function index(Ticket $ticket){
        $tickets = $ticket->with('ticketMessages')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at')
            ->paginate(15);
        return view('pages.tickets', [
            'tickets' => $tickets,
            'paymentMethods' => PaymentMethod::all()
        ]);
    }

    public function createTicket(CreateTicketRequest $request){
        $openTicketCount = Ticket::where('user_id', auth()->user()->id)
            ->where('status', TicketStatusEnum::ACTIVE->value)
            ->count();
        if($openTicketCount+1 <= configValue('max_open_ticket')){
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

            return back()->with('message', 'You have successfully created a ticket.');
        }
        return back()->withErrors(["tooMuchTickets" => "You cannot create a new ticket because you have too many open tickets.
        Please wait for your existing tickets to be answered."]);
    }

    public function ticketMessages(Ticket $ticket){
        if(auth()->user()->id == $ticket->user_id){
            TicketMessage::where('ticket_id', $ticket->id)->update(['seen_by_user' => 1]);
            return view('pages.ticket-messages', [
                'ticketMessages' => $ticket->ticketMessages,
                'ticket_id' => $ticket->id,
                'status' => $ticket->status
            ]);
        }else{
            return redirect('/');
        }

    }

    public function newTicketMessage(Request $request, Ticket $ticket){
            $request->validate([
                'ticket_id'            => ['required', 'digits_between:1,10'],
                'message'            => ['required', 'max:5000']
            ]);

        $lastestMessageTime = TicketMessage::where('user_id', auth()->user()->id)->orderByDesc('created_at')->first()->created_at;
        $currentTime = Carbon::now();
        $newMessageTime = $lastestMessageTime ? $lastestMessageTime->addMinutes(configValue('time_between_messages_tickets')) : NULL;

        if($lastestMessageTime && $newMessageTime && $currentTime <= $newMessageTime){
            $minutes = $currentTime->diffInMinutes($newMessageTime);
            return back()->withErrors(["tooFastTickets" => "You need to wait $minutes minutes to send a new message."]);
        }

        $relatedTicket = $ticket->where('id', $request->ticket_id)->first();
        if(auth()->user()->id == $relatedTicket->user_id && $relatedTicket->status != TicketStatusEnum::CLOSED->value){
            $ticketMessages = new TicketMessage();
            $ticketMessages->ticket_id = $request->ticket_id;
            $ticketMessages->user_id = auth()->user()->id;
            $ticketMessages->message = $request->message;
            $ticketMessages->seen_by_user = 1;
            $ticketMessages->seen_by_support = 0;
            $ticketMessages->save();

            return back()->with('message', 'You have successfully sent the message.');
        }else{
            return redirect('/');
        }
    }
}
