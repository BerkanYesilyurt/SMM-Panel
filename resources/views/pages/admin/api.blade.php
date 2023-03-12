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
                                <label for="name" class="form-label">Name:</label>
                                <input class="form-control" type="text" id="name" name="name"
                                       value="{{$api->name ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="key" class="form-label">Key:</label>
                                <input class="form-control" type="text" id="key" name="key"
                                       value="{{$api->key ?? ''}}">
                            </div>

                            <div class="divider divider-dashed"></div>
                            <h5>Order</h5>

                            <div class="mb-3 col-md-6">
                                <label for="order_endpoint" class="form-label">Order Endpoint:</label>
                                <input class="form-control" type="text" id="order_endpoint" name="order_endpoint"
                                       value="{{$api->order_endpoint ?? ''}}">
                            </div>

                            <div class="col mb-3">
                                <label for="order_method" class="form-label">Order Method:</label>
                                <select id="order_method" class="form-control" name="order_method">
                                        <option value="get" @selected(isset($api->order_method) && $api->order_method == 'get')>GET</option>
                                        <option value="post" @selected(isset($api->order_method) && $api->order_method == 'post')>POST</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="order_id_key" class="form-label">Order ID Key:</label>
                                <input class="form-control" type="text" id="order_id_key" name="order_id_key"
                                       value="{{$api->order_id_key ?? ''}}">
                            </div>

                            <div class="divider divider-dashed"></div>
                            <h5>Status</h5>

                            <div class="mb-3 col-md-6">
                                <label for="status_endpoint" class="form-label">Status Endpoint:</label>
                                <input class="form-control" type="text" id="status_endpoint" name="status_endpoint"
                                       value="{{$api->status_endpoint ?? ''}}">
                            </div>

                            <div class="col mb-3">
                                <label for="status_method" class="form-label">Status Method:</label>
                                <select id="status_method" class="form-control" name="status_method">
                                    <option value="get" @selected(isset($api->status_method) && $api->status_method == 'get')>GET</option>
                                    <option value="post" @selected(isset($api->status_method) && $api->status_method == 'post')>POST</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="status_key" class="form-label">Status Key:</label>
                                <input class="form-control" type="text" id="status_key" name="status_key"
                                       value="{{$api->status_key ?? ''}}">
                            </div>

                            <div class="divider divider-dashed"></div>
                            <h5>Other</h5>

                            <div class="mb-3 col-md-6">
                                <label for="start_counter_key" class="form-label">Start Counter Key:</label>
                                <input class="form-control" type="text" id="start_counter_key" name="start_counter_key"
                                       value="{{$api->start_counter_key ?? ''}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="remain_key" class="form-label">Remain Key:</label>
                                <input class="form-control" type="text" id="remain_key" name="remain_key"
                                       value="{{$api->remain_key ?? ''}}">
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
