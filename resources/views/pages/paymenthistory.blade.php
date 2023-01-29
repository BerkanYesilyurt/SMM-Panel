@extends('layout')
@section('subTitle', 'Payment History')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Payment History
        </h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    @foreach($paymentMethods as $item)
                        @if($item->status == \App\Enums\ActiveInactiveState::ACTIVE->value)
                            <li class="nav-item">
                                <a class="nav-link" href="/addfunds/{{$item->slug}}">
                                    <i class="bx {{$item->icon}} me-1"></i> {{$item->name}}
                                </a>
                            </li>
                        @endif
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link active" href="/addfunds/history">
                            <i class="bx bx-history me-1"></i> Payment History
                        </a>
                    </li>
                </ul>

                <div class="card mb-4">
                    <h5 class="card-header">Payment History</h5>

                    <div class="card-body">

                        <div class="row">
                            <div class="list-group list-group-flush">
                                @forelse($paymentLogs as $paymentLog)
                                    <a class="list-group-item list-group-item-action fs-6">
                                        <b>Payment ID: {{$paymentLog->id}}</b> &nbsp; &raquo; &nbsp;
                                        {{$paymentLog->created_at->format('d F Y - H:i ')}} &nbsp; &raquo; &nbsp;
                                        {{floatval($paymentLog->amount) . ' ' . $paymentLog->currency}} &nbsp; &raquo; &nbsp;
                                        <span class="badge bg-@php
                                        switch($paymentLog->status){
                                            case \App\Enums\PaymentStatusEnum::COMPLETED->value:
                                            echo 'success';
                                            break;

                                            case \App\Enums\PaymentStatusEnum::PENDING->value:
                                            echo 'warning';
                                            break;

                                            default:
                                            echo 'danger';
                                        }
                                        @endphp
                                        ">
                                        {{\App\Enums\PaymentStatusEnum::from($paymentLog->status)->name}}</span>
                                    </a>
                                    </div></div>
                                @empty
                                    </div></div>
                                    You have not made any payments.
                                @endforelse
                    </div>
                </div>

                <center>{{ $paymentLogs->links() }}</center>

            </div>
        </div>
    </div>
@endsection
