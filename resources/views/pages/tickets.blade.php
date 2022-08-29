@extends('layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Tickets
            <button type="button" class="btn btn-primary" style="float:right;">
                <span class="tf-icons bx bx-plus"></span>&nbsp; New Ticket
            </button>
        </h4>
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>TICKET ID</th>
                    <th>SUBJECT</th>
                    <th>STATUS</th>
                    <th>DATE</th>
                    <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($tickets as $ticket)
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$ticket->id}}</strong></td>
                    <td>{{$ticket->subject}}</td>
                    <td><span class="badge bg-label-primary me-1">{{$ticket->status}}</span></td>
                    <td>{{$ticket->created_at}}</td>
                    <td>

                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>

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
