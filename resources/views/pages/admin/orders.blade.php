@extends('pages.admin.layout')
@section('subTitle', 'Orders')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Orders
        </h4>

        <div class="card">

            <div class="table-responsive text-nowrap">
                <style>
                    table {
                        border-spacing: 0px;
                        table-layout: fixed;
                        margin-left: auto;
                        margin-right: auto;
                    }
                </style>
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
                    @forelse($orders as $order)
                        <tr>
                            <td><center><b>{{$order->id}}</b></center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center><a target="_blank" href="{{$order->link}}">{{$order->link}}</a></center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$order->getServiceName->name}}</center></td>
                            <td><center>{{$order->quantity}}</center></td>
                            <td><center>{{round($order->charge, 4)}}</center></td>
                            <td><center>{{$order->created_at->diffForHumans()}}</center></td>
                            <td><center><span class="badge bg-@php
                    switch($order->status){
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
                    @endphp me-1">{{\App\Enums\OrderStatusEnum::values()[$order->status]}}</span></center></td>
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
                <center>{{ $orders->links() }}</center>
            </div>
        </div>
    </div>
@endsection
