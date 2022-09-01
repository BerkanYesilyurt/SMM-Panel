@extends('layout')
@section('content')


    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">SMM-Panel /</span> Tickets
                <button type="button" class="btn btn-primary" onclick="history.back()" style="float:right;">
                    <span class="tf-icons bx bx-arrow-back"></span>&nbsp; Go Back
                </button>
            </h4>

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
                </div>
                @empty
                    <span class="badge bg-danger" style="padding-top: 30px; padding-bottom: 30px;">
                        No Messages Found.
                        <br><br><br>
                        If you think there is an error, please contact the site owner.
                    </span>
                @endforelse


            </div>
            <!--/ Card layout -->

@endsection
