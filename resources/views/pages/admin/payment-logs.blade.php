@extends('pages.admin.layout')
@section('subTitle', 'Payment Logs')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Payment Logs
        </h4>

        <form action="/admin/payment-logs" method="POST">
            @csrf
            <div class="input-group mb-3">
                <select name="action" class="form-select form-select-lg">
                    <option value="cancel_all">Change Selected Logs' Statuses As Canceled</option>
                </select>
                <button type="submit" class="btn btn-primary">
                    <span class="tf-icons bx bx-right-arrow"></span>&nbsp; Submit
                </button>
            </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="list-group list-group-flush">
                    @forelse($paymentLogs as $paymentLog)
                        <a class="list-group-item list-group-item-action" style="font-size: 90% !important;">
                            <input class="form-check-input me-1" type="checkbox" name="id[]" value="{{$paymentLog->id}}" @disabled($paymentLog->status != \App\Enums\PaymentStatusEnum::PENDING->value)>
                            <b>Payment ID: {{$paymentLog->id}}</b> &nbsp; &raquo; &nbsp;
                            {{$paymentLog->user->email}} &nbsp; &raquo; &nbsp;
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
                    @empty
                        No payment logs founds.
                    @endforelse
                </div>
            </div>
        </div>
        </div>
        <center>{{ $paymentLogs->links() }}</center>
    </div>
    </form>
@endsection
