@extends('pages.admin.layout')
@section('subTitle', $title)
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> {{$title}}
        </h4>

        <div class="row">
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
            @if(session('message'))
                <div class="alert alert-success alert-dismissible">
                    <ul style="margin-bottom: 1px; color:#478924;">
                        <b>{{session('message')}}</b>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif

            <div class="card mb-4">
                <h5 class="card-header">{{$title}}</h5>
                <div class="card-body">
                    <form action="/admin/{{$path ?? 'api'}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">API Name:</label>
                                <input class="form-control" type="text" id="name" name="name"
                                       value="{{$api->name ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="url" class="form-label">API URL:</label>
                                <input class="form-control" type="text" id="url" name="url"
                                       value="{{$api->url ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="key" class="form-label">API Key:</label>
                                <input class="form-control" type="text" id="key" name="key"
                                       value="{{$api->key ?? ''}}">
                            </div>

                            <div class="divider divider-dashed"></div>
                            <h5>Service</h5>

                            <div class="mb-3 col-md-6">
                                <label for="services_action" class="form-label">Services Action:</label>
                                <input class="form-control" type="text" id="services_action" name="services_action"
                                       value="{{$api->services_action ?? ''}}">
                            </div>

                            <div class="divider divider-dashed"></div>
                            <h5>Order</h5>

                            <div class="mb-3 col-md-6">
                                <label for="add_action" class="form-label">Add Action:</label>
                                <input class="form-control" type="text" id="add_action" name="add_action"
                                       value="{{$api->add_action ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="service_key" class="form-label">Service Key:</label>
                                <input class="form-control" type="text" id="service_key" name="service_key"
                                       value="{{$api->service_key ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="link_key" class="form-label">Link Key:</label>
                                <input class="form-control" type="text" id="link_key" name="link_key"
                                       value="{{$api->link_key ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="quantity_key" class="form-label">Quantity Key:</label>
                                <input class="form-control" type="text" id="quantity_key" name="quantity_key"
                                       value="{{$api->quantity_key ?? ''}}">
                            </div>

                            <div class="divider divider-dashed"></div>
                            <h5>Order Status</h5>

                            <div class="mb-3 col-md-6">
                                <label for="order_key" class="form-label">Order Key:</label>
                                <input class="form-control" type="text" id="order_key" name="order_key"
                                       value="{{$api->order_key ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="orders_key" class="form-label">Orders Key:</label>
                                <input class="form-control" type="text" id="orders_key" name="orders_key"
                                       value="{{$api->orders_key ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="status_action" class="form-label">Status Action:</label>
                                <input class="form-control" type="text" id="status_action" name="status_action"
                                       value="{{$api->status_action ?? ''}}">
                            </div>

                            <div class="divider divider-dashed"></div>
                            <h5>Refill & Refill Status (optional)</h5>

                            <div class="mb-3 col-md-6">
                                <label for="refill_action" class="form-label">Refill Action:</label>
                                <input class="form-control" type="text" id="refill_action" name="refill_action"
                                       value="{{$api->refill_action ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="refill_status_action" class="form-label">Refill Status Action:</label>
                                <input class="form-control" type="text" id="refill_status_action" name="refill_status_action"
                                       value="{{$api->refill_status_action ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="refill_key" class="form-label">Refill Key:</label>
                                <input class="form-control" type="text" id="refill_key" name="refill_key"
                                       value="{{$api->refill_key ?? ''}}">
                            </div>

                            <div class="divider divider-dashed"></div>
                            <h5>Balance</h5>

                            <div class="mb-3 col-md-6">
                                <label for="balance_action" class="form-label">Balance Action:</label>
                                <input class="form-control" type="text" id="balance_action" name="balance_action"
                                       value="{{$api->balance_action ?? ''}}">
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
