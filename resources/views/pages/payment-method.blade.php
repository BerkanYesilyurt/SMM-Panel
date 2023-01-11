@extends('layout')
@section('subTitle', $paymentMethod->name)
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Add Funds
        </h4>

        <div class="row">
            <div class="col-md-12">
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
                                <div class="mb-3 col-md-6">
                                    <form action="/addfunds/{{$paymentMethod->slug}}" method="POST">
                                    @csrf
                                    <label for="amount" class="form-label">Amount</label>
                                    <input class="form-control" type="number" step="0.01" id="amount" name="amount" placeholder="Example: 50" autofocus="">

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary me-2">PAY</button>
                                    </div>
                                    </form>
                                </div>
                                @if($paymentMethod->content)
                                    <div class="mb-3 col-md-6">
                                        {!! $paymentMethod->content !!}
                                    </div>
                                @endif
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
