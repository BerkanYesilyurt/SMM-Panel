@extends('layout')
@section('subTitle', 'Service Updates')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Service Updates
        </h4>
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="demo-inline-spacing mt-3">
                            <div class="list-group">
                                @forelse($serviceupdates as $serviceupdate)
                                    @if(($serviceupdate->description || (isset($serviceupdate->old_price) && isset($serviceupdate->new_price))) && $serviceupdate->public)
                                        <label class="list-group-item">
                                            <small class="text-{{$serviceupdate->new_price > $serviceupdate->old_price ? 'success' : ($serviceupdate->old_price > $serviceupdate->new_price ? 'danger' : 'warning')}} fw-semibold">
                                                <i class="bx bx-{{$serviceupdate->new_price > $serviceupdate->old_price ? 'up-arrow-alt' : ($serviceupdate->old_price > $serviceupdate->new_price ? 'down-arrow-alt' : 'minus')}}"></i>
                                            </small>
                                            {{$serviceupdate->service->name}} (ID: {{$serviceupdate->service_id}})
                                            @if($serviceupdate->old_price && $serviceupdate->new_price && $serviceupdate->show_price_changes)
                                                price <b>{{$serviceupdate->new_price > $serviceupdate->old_price ? 'increased to' : 'reduced to'}}</b>
                                                {{$configsArray['currency_symbol'] . floatval($serviceupdate->new_price)}}.
                                            @endif
                                            @if($serviceupdate->description)
                                                <br><i class="bx bx-chevrons-right"></i><b>Additional:</b> {!! $serviceupdate->description !!}
                                            @endif
                                        </label>
                                    @endif
                                @empty
                                    <center>
                                        <b>No Updates Found.</b>
                                    </center>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
