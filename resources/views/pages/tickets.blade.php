@extends('layout')
@section('subTitle', 'Tickets')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Tickets
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter" style="float:right;">
                <span class="tf-icons bx bx-plus"></span>&nbsp; New Ticket
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
                    <td><center><i class="fab fa-angular fa-lg text-danger me-3"></i> <a href="/ticket/{{$ticket->id}}"><strong>{{$ticket->id}}</strong></a></center></td>
                    <td><center>{{ucfirst($ticket->subject)}}
                                @if($ticket->unseenMessageByUser())
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
                                <a class="btn btn-info" href="/ticket/{{$ticket->id}}">Show Ticket</a>
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

    <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Create New Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form" action="/tickets">
                    @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
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
                            <label for="subject" class="form-label">SUBJECT:</label>
                            <select id="subject" class="form-control" name="subject" placeholder="Subject" onchange="handleOrderType(this)">
                                <option value="order" selected> Order</option>
                                <option value="payment">Payment</option>
                                <option value="request">Request</option>
                                <option value="childpanel">Child Panel</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="divider">
                        <div class="divider-text">
                            <i class="bx bx-star"></i>
                        </div>
                    </div>
                    <div class="row g-2">

                        <div class="mt-3" id="order-group">
                            <label for="orderid" class="form-label">ORDER ID:</label>
                            <input type="text" id="orderid" name="orderid" class="form-control" placeholder="ORDERS ID" maxlength="180" required>
                        </div>
                        <div class="mt-3" id="type-group">
                            <label for="order_request" class="form-label">REQUEST:</label>
                            <select id="order_request" name="order_request" class="form-control" placeholder="REQUEST">
                                <option value="refill" selected="">Refill</option>
                                <option value="cancel">Cancel</option>
                                <option value="speed-up">Speed Up</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mt-3" id="payment-group" style="display: none;">
                            <label for="payment" class="form-label">PAYMENT:</label>
                            <select id="payment" name="payment" class="form-control" placeholder="Payment">
                                @foreach($paymentMethods as $paymentMethod)
                                <option value="{{$paymentMethod->slug}}" selected="">{{$paymentMethod->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3" id="paymentid-group" style="display: none;">
                            <label for="payid" class="form-label">PAY ID:</label>
                            <input type="text" id="payid" name="payid" maxlength="100" class="form-control" placeholder="PAY ID" required>
                        </div>
                        <div class="mt-3" id="request-group" style="display: none;">
                            <label for="feature_request" class="form-label">TYPE:</label>
                            <select id="feature_request" name="feature_request" class="form-control" placeholder="Feature Request">
                                <option value="feature" selected="">A Feature</option>
                                <option value="service">A Service</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="message" class="form-label">MESSAGE:</label>
                            <textarea name="message" id="message" maxlength="5000" cols="30" rows="10" class="form-control" placeholder="Your Message" required></textarea>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="submit(); this.disabled = true;" style="color: white;" id="submitbutton">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function handleOrderType(selectObject) {
            var element = document.getElementById("order-group");
            var element2 = document.getElementById("payment-group");
            var element3 = document.getElementById("request-group");
            var element4 = document.getElementById("type-group");
            var element5 = document.getElementById('paymentid-group');

            if (selectObject.value.indexOf("order") >= 0) {
                element.style.display = "block";
                element2.style.display = "none";
                element3.style.display = "none";
                element4.style.display = "block";
                element5.style.display = "none";
            } else if (selectObject.value.indexOf("payment") >= 0) {
                element.style.display = "none";
                element2.style.display = "block";
                element3.style.display = "none";
                element4.style.display = "none";
                element5.style.display = "block";
            } else if (selectObject.value.indexOf("other") >= 0) {
                element.style.display = "none";
                element2.style.display = "none";
                element3.style.display = "none";
                element4.style.display = "none";
                element5.style.display = "none";
            } else if (selectObject.value.indexOf("request") >= 0) {
                element.style.display = "none";
                element2.style.display = "none";
                element3.style.display = "block";
                element4.style.display = "none";
                element5.style.display = "none";
            } else if (selectObject.value.indexOf("childpanel") >= 0) {
                element.style.display = "none";
                element2.style.display = "none";
                element3.style.display = "none";
                element4.style.display = "none";
                element5.style.display = "none";
            }
        }

        function submit(){
            document.getElementById("form").submit();
        }

    </script>
@endsection
