@extends('layout')
@section('subTitle', 'Add Funds')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Add Funds
        </h4>

        @forelse($paymentMethods as $paymentMethod)
            <a href="/addfunds/{{$paymentMethod->slug}}">
                <div class="card icon-card cursor-pointer text-center mb-4 mx-2" style="font-size: 1.3rem;">
                    <div class="card-body"> <i class="bx {{$paymentMethod->icon}} mb-2" style="font-size: 2.5rem;"></i>
                        <p class="icon-name text-capitalize text-truncate mb-0">{{$paymentMethod->name}}</p>
                    </div>
                </div>
            </a>
        @empty
            <tr>
                <td colspan="5"><br>
                    <center>
                        <b>No Payment Method Found.</b>
                    </center>
                    <br></td>
            </tr>
        @endforelse

    </div>
@endsection
