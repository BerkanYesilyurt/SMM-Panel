@extends('pages.admin.layout')
@section('subTitle', 'Tickets')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Tickets
        </h4>

        @if(session('message'))
            <div class="alert alert-success alert-dismissible">
                <ul style="margin-bottom: 1px; color:#478924;">
                    <b>{{session('message')}}</b>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif

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
                                    @if($ticket->unseenMessageBySupport())
                                        <b>(New Messages)</b>
                                    @endif</center></td>
                            <td><center><span class="badge bg-@php
                    switch($ticket->status){
                        case \App\Enums\TicketStatusEnum::ACTIVE->value:
                        echo 'success';
                        break;

                        case \App\Enums\TicketStatusEnum::CLOSED->value:
                        echo 'danger';
                        break;

                        default:
                        echo 'primary';
                    }
                    @endphp me-1">{{\App\Enums\TicketStatusEnum::from($ticket->status)->name}}</span></center></td>
                            <td><center>{{$ticket->created_at->diffForHumans()}}</center></td>
                            <td>
                                <center>
                                    <button type="button" onclick="prepareForDelete(this)" data-ticketid="{{$ticket->id}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenterDeleteTicket">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                                    <a class="btn btn-info" href="/admin/ticket/{{$ticket->id}}">Show Ticket</a>
                                    <a href="/admin/user/{{$ticket->user_id}}/edit" target="_blank" class="btn btn-primary"
                                            data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="right" data-bs-html="true"
                                            title=""
                                            data-bs-original-title="<i class='bx bx-face' ></i><br><span>{{$ticket->user->name}}</span><br><br><i class='bx bx-envelope' ></i><br> <span>{{$ticket->user->email}}</span>">
                                        <i class='bx bx-user' ></i>
                                    </a>
                                    <a href="/admin/ban/{{$ticket->user->id}}/ticket" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="right" data-bs-html="true"
                                            title=""
                                            data-bs-original-title="<span>Ban this user from using a ticket.</span>">
                                        <i class='bx bx-block' ></i>
                                    </a>
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
        <center><br>{{ $tickets->links() }}</center>
    </div>

    <div class="modal fade" id="modalCenterDeleteTicket" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="deleteticket" action="/admin/delete-ticket">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">

                        <div class="col mb-3">
                            <span id="prepareForDelete"></span>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-danger" onclick="deleteTicket(); this.disabled = true;" style="color: white; width: 100%;">Delete Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function prepareForDelete(element){
            document.getElementById('delete_id').value = element.dataset.ticketid;
            document.getElementById('prepareForDelete').innerHTML = '<b>(ID: ' + element.dataset.ticketid + ') </b>ticket and all related messages will be deleted. Are you sure?';
        }
        function deleteTicket(){
            document.getElementById("deleteticket").submit();
        }
    </script>
@endsection
