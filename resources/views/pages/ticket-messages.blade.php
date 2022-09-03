@extends('layout')
@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">SMM-Panel /</span> Tickets / {{$ticket_id}}
                <button type="button" class="btn btn-primary" onclick="history.back()" style="float:right;">
                    <span class="tf-icons bx bx-arrow-back"></span>&nbsp; Go Back
                </button>
            </h4>
            @if($status == "CLOSED")
                <span class="badge bg-danger" style="width: 100%; padding-top: 30px; padding-bottom: 30px; margin-bottom: 30px;">
                        No further messages are accepted as this ticket is closed.
                    </span>
            @endif
            <div class="row" data-masonry='{"percentPosition": true }' style="display: block; position: relative;">

                @forelse($ticketMessages as $ticketMessage)
                <div class="col-sm-6 col-lg-4 mb-4" style="
                @if(auth()->user()->id == $ticketMessage->user_id)
                    float: inline-start;
                    @else
                    float: right;
                    @endif
                ">
                    <div class="card
                    @if(auth()->user()->id == $ticketMessage->user_id)
                    bg-primary
                    @else
                    bg-dark
                    @endif text-white text-center p-3">
                        <figure class="mb-0">
                            <blockquote class="blockquote">
                                <p>{{$ticketMessage->message}}</p>
                            </blockquote>


                            <figcaption class="mb-0 text-white" style="font-size: 85%;">
                               @if(auth()->user()->id == $ticketMessage->user_id)
                                    {{auth()->user()->name}}
                                @else
                                    Support Member
                               @endif &nbsp;-&nbsp; {{$ticketMessage->created_at->diffForHumans()}}
                            </figcaption>
                        </figure>
                    </div>
                </div><div style="clear:both; margin-bottom: 10px;"></div>
                @empty
                    <span class="badge bg-danger" style="padding-top: 30px; padding-bottom: 30px;">
                        No Messages Found.
                        <br><br><br>
                        If you think there is an error, please contact the site owner.
                    </span><br><br>
                @endforelse


            </div>
            @if($status != "CLOSED")
            <form action="/ticket_message" method="POST">
                @csrf
            <div class="input-group">
                <span class="input-group-text">New Message</span>
                <textarea class="form-control" maxlength="5000" name="message" style="width: 75%; resize: none;" aria-label="With textarea" placeholder="Repeatedly sending messages to same ticket will increase the response time."></textarea>
                <input type="hidden" name="ticket_id" value="{{$ticket_id}}" />
                <button type="submit" class="btn btn-primary" onclick="history.back()" style="float:right;">
                    <span class="tf-icons bx bx-send"></span>&nbsp; Send
                </button>
            </div>
            </form>
            @endif
            <!--/ Card layout -->

@endsection
