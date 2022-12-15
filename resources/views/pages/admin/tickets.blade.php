@extends('pages.admin.layout')
@section('subTitle', 'Tickets')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Tickets
        </h4>
        <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th><center>TICKET ID</center></th>
                        <th><center>SUBJECT</center></th>
                        <th><center>STATUS</center></th>
                        <th><center>DATE</center></th>
                        <th><center>ACTIONS</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($tickets as $ticket)
                        <tr>
                            <td><center><i class="fab fa-angular fa-lg text-danger me-3"></i> <a href="/admin/ticket/{{$ticket->id}}"><strong>{{$ticket->id}}</strong></a></center></td>
                            <td><center>{{ucfirst($ticket->subject)}}
                                    @foreach($ticket->ticketMessages->all() as $ticketMessage)
                                        @if($ticketMessage->seen_by_support == 0)
                                            <b>(New Messages)</b>
                                            @break
                                        @endif
                                    @endforeach</center></td>
                            <td><center><span class="badge bg-@php
                    switch($ticket->status){
                        case 'ACTIVE':
                        echo 'success';
                        break;

                        case 'CLOSED':
                        echo 'danger';
                        break;

                        default:
                        echo 'primary';
                    }
                    @endphp me-1">{{$ticket->status}}</span></center></td>
                            <td><center>{{$ticket->created_at->diffForHumans()}}</center></td>
                            <td>
                                <center>
                                    <a class="btn btn-info" href="/admin/ticket/{{$ticket->id}}">Show Ticket</a>
                                </center>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><br>
                                <center>
                                    <b>No Tickets Found.</b>
                                </center>
                                <br></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
