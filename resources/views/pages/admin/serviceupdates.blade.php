@extends('pages.admin.layout')
@section('subTitle', 'Service Updates')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Service Updates
        </h4>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 1px;">
                    @foreach ($errors->all() as $error)
                        <li><b>{{$error}}</b></li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('message'))
            <div class="alert alert-success alert-dismissible">
                <ul style="margin-bottom: 1px; color:#478924;">
                    <b>{{session('message')}}</b>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- List group checkbox -->
                <div class="col-lg-12">
                    <small class="text-light fw-semibold">The portion of the service updates that will be displayed to the user is set here.</small>
                    <div class="demo-inline-spacing mt-3">
                        <div class="list-group">
                            @foreach($serviceupdates as $serviceupdate)
                                @if(isset($serviceupdate->old_price) && isset($serviceupdate->new_price))
                                <label class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="{{$serviceupdate->id}}">
                                    {{$serviceupdate->service->name}} (ID: {{$serviceupdate->service_id}})
                                    @if($serviceupdate->old_price && $serviceupdate->new_price)
                                        price <b>{{$serviceupdate->new_price > $serviceupdate->old_price ? 'increased to' : 'reduced to'}}</b>
                                        {{floatval($serviceupdate->new_price)}}
                                    @endif
                                </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--/ List group checkbox -->
            </div>
        </div>
    </div>

@endsection
