@extends('layout')
@section('subTitle', $paymentMethod->name)
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Add Funds
        </h4>

        <div class="row">
            <div class="col-md-12">
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
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    @foreach($paymentMethods as $item)
                        <li class="nav-item">
                            <a class="nav-link {{$item->slug == $paymentMethod->slug ? 'active' : ''}}" href="/addfunds/{{$item->slug}}">
                                <i class="bx {{$item->icon}} me-1"></i> {{$item->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">{{$paymentMethod->name}}</h5>

                    <div class="card-body">

                            <div class="row">

                                @if(!$paymentMethod->is_manual)
                                <div class="mb-3 col-md-6">
                                    <form action="/addfunds/{{$paymentMethod->slug}}" method="POST">
                                    @csrf
                                    <label for="amount" class="form-label">Amount</label>
                                    <input class="form-control mb-2" type="number" step="0.01" id="amount" name="amount" placeholder="Example: 20" autofocus="">


                                    <span class="badge bg-danger"><b>Minimum Amount: {{$configsArray['currency_symbol'] . $paymentMethod->min_amount}}</b></span>
                                    @if($paymentMethod->max_amount)
                                    <span class="badge bg-success"><b>Maximum Amount: {{$configsArray['currency_symbol'] . $paymentMethod->max_amount}}</b></span>
                                    @endif

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary me-2">PAY</button>
                                    </div>
                                    </form>
                                </div>
                                @endif

                                @if($paymentMethod->content)
                                    <div class="mb-3 col-md-{{$paymentMethod->is_manual ? '12' : '6'}}">
                                        {!! $paymentMethod->content !!}
                                    </div>
                                @endif
                            </div>

                    </div>
                </div>

                <div class="card mb-4">
                    <h5 class="card-header">Payment History</h5>

                    <div class="card-body">

                        <div class="row">
                            <div class="list-group list-group-flush">
                                @foreach(auth()->user()->payment_logs as $paymentLog)
                                    <a class="list-group-item list-group-item-action fs-6">
                                        <b>Payment ID: {{$paymentLog->id}}</b> &nbsp; &raquo; &nbsp;
                                        {{$paymentLog->created_at->format('d F Y - H:i ')}} &nbsp; &raquo; &nbsp;
                                        {{$paymentLog->amount . ' ' . $paymentLog->currency}} &nbsp; &raquo; &nbsp;
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
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
