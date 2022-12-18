@extends('pages.admin.layout')
@section('subTitle', 'Ticket')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Admin Panel /</span> Tickets / {{$ticket_id}}
                <button type="button" class="btn btn-primary" onclick="location.href = '/admin/tickets'" style="float:right;">
                    <span class="tf-icons bx bx-arrow-back"></span>&nbsp; Go Back
                </button>
            </h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom: 1px;">
                        @foreach ($errors->all() as $error)
                            <li><b>{{$error}}</b></li>
                        @endforeach
                    </ul>
                </div>
                <br>
            @endif
            @if(session('message'))
                <div class="alert alert-success alert-dismissible">
                    <ul style="margin-bottom: 1px; color:#478924;">
                        <b>{{session('message')}}</b>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif
            @if($status == \App\Enums\TicketStatusEnum::CLOSED->value)
                <span class="badge bg-danger" style="width: 100%; padding-top: 30px; padding-bottom: 30px; margin-bottom: 30px;">
                    THE STATUS OF THIS TICKET IS CLOSED. WHEN SENDING A NEW MESSAGE, YOU MUST CONSIDER THAT THE USER CANNOT ANSWER IT.
                    </span>
            @endif
            <div class="row" data-masonry='{"percentPosition": true }' style="display: block; position: relative;">

                @forelse($ticketMessages as $ticketMessage)
                    <div class="col-sm-6 col-lg-4 mb-4" style="
                @if($ticketMessage->owner->authority != \App\Enums\UserAuthorityEnum::none->value)
                    float: inline-start;
                    @else
                    float: right;
                    @endif
                ">
                        <div class="card
                    @if($ticketMessage->owner->authority != \App\Enums\UserAuthorityEnum::none->value)
                    bg-primary
                    @else
                    bg-dark
                    @endif text-white text-center p-3">
                            <figure class="mb-0">
                                <blockquote class="blockquote">
                                    <p>{{$ticketMessage->message}}</p>
                                </blockquote>


                                <figcaption class="mb-0 text-white" style="font-size: 85%;">
                                        {{$ticketMessage->owner->name}}
                                        &nbsp;-&nbsp; {{$ticketMessage->created_at->diffForHumans()}}
                                </figcaption>
                            </figure>
                        </div>
                    </div><div style="clear:both; margin-bottom: 10px;"></div>
                @empty
                    <span class="badge bg-danger" style="padding-top: 30px; padding-bottom: 30px;">
                        No Messages Found.
                    </span><br><br>
                @endforelse


            </div>

            <form action="/admin/ticket_message" method="POST">
                @csrf
                <div class="input-group">
                    <span class="input-group-text">New Message</span>
                    <textarea class="form-control" maxlength="5000" name="message" style="width: 75%; resize: none;" aria-label="With textarea"></textarea>
                    <input type="hidden" name="ticket_id" value="{{$ticket_id}}" />
                    <button type="submit" class="btn btn-primary" onclick="history.back()" style="float:right;">
                        <span class="tf-icons bx bx-send"></span>&nbsp; Send
                    </button>
                </div>
            </form>
            <!--/ Card layout -->

@endsection
