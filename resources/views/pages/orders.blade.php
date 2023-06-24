@extends('layout')
@section('subTitle', 'Orders')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <form action="{{route('orders')}}" method="POST">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Orders
                @csrf
                <select class="form-select" name="status" onchange="this.form.submit()" style="float:right; width: 200px;">
                    <option value="all">All Orders</option>
                    @foreach($statuses as $statusKey => $statusValue)
                        <option value="{{$statusKey}}" @selected($statusKey == $currentStatus)>{{$statusValue}}</option>
                    @endforeach
                </select>
        </h4>
        </form>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 8%;"><center>ORDER ID</center></th>
                        <th style="width: 26%;"><center>LINK</center></th>
                        <th style="width: 26%;"><center>SERVICE NAME</center></th>
                        <th style="width: 8%;"><center>QUANTITY</center></th>
                        <th style="width: 10%;"><center>CHARGE</center></th>
                        <th style="width: 12%;"><center>DATE</center></th>
                        <th style="width: 10%;"><center>STATUS</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($userOrders as $userOrder)
                                <tr>
                                    <td><center><b>{{$userOrder->id}}</b></center></td>
                                    <td style="white-space:pre-wrap; word-wrap:break-word;"><center><a target="_blank" href="{{$userOrder->link}}">{{$userOrder->link}}</a></center></td>
                                    <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$userOrder->getServiceName->name}}</center></td>
                                    <td><center>{{$userOrder->quantity}}</center></td>
                                    <td><center>{{$configsArray['currency_symbol']}}{{round($userOrder->charge, 4)}}</center></td>
                                    <td><center>{{$userOrder->created_at->diffForHumans()}}</center></td>
                                    <td><center><span class="badge bg-@php
                    switch($userOrder->status){
                        case \App\Enums\OrderStatusEnum::COMPLETED->value:
                        echo 'success';
                        break;

                        case \App\Enums\OrderStatusEnum::INPROGRESS->value:
                        echo 'info';
                        break;

                        case \App\Enums\OrderStatusEnum::PARTIAL->value:
                        echo 'warning';
                        break;

                        case \App\Enums\OrderStatusEnum::CANCELED->value:
                        echo 'danger';
                        break;

                        default:
                        echo 'primary';
                    }
                    @endphp me-1">{{\App\Enums\OrderStatusEnum::values()[$userOrder->status]}}</span></center></td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="7"><br>
                                <center>
                                    <b>No Orders Found.</b>
                                </center>
                                <br></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                @if($orderCount > 0)
                <div class="divider divider-primary">
                    <div class="divider-text"><b>Total Orders: {{$orderCount}}</b></div>
                </div>
                @endif
                <center>{{ $userOrders->links() }}</center>
            </div>
        </div>
    </div>
@endsection
