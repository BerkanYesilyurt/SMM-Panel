@extends('pages.admin.layout')
@section('subTitle', 'Error Detail')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Error / {{$error->id}}
            <button type="button" class="btn btn-primary" onclick="location.href = '{{ url()->previous() }}'" style="float:right;">
                <span class="tf-icons bx bx-arrow-back"></span>&nbsp; Go Back
            </button>
        </h4>

        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card shadow-none bg-transparent border border-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">User</h5>
                        <p class="card-text">
                            @if($error->user)
                                <li><b>Name:</b> {{$error->user->name}} - <a href="/admin/user/{{$error->user->id}}/edit" target="_blank">User Details</a></li>
                                <li><b>Email:</b> {{$error->user->email}}</li>
                            @else
                                <li>The user was not logged in when the error occurred.</li>
                            @endif

                            <li><b>IP Adress:</b> {{$error->user_ip ?? '-'}}</li>
                            <li><b>User Agent:</b> {{$error->user_agent ?? '-'}}</li>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card shadow-none bg-transparent border border-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Information</h5>
                        <p class="card-text">
                            <li><b>URL:</b> {{$error->url ?? '-'}}</li>
                            <li><b>Date:</b> {{$error->created_at . ' (' . $error->created_at->diffForHumans() . ')' ?? '-'}}</li>
                            <li><b>Method:</b> {{$error->method ?? '-'}}</li>
                            <li><b>Status Code:</b> {{$error->status_code ?? '-'}}</li>
                            <li><b>Referer URL:</b> {{$error->referer ?? '-'}}</li>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card shadow-none bg-transparent border border-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">File & Message</h5>
                        <p class="card-text">
                            <li><b>Filename:</b> {{$error->filename ?? '-'}}</li>
                            <li><b>Line:</b> {{$error->line ?? '-'}}</li>
                            <li><b>Message:</b> {{$error->message ?? '-'}}</li>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <h5 class="card-header">Error Trace</h5>
                <div class="card-body">
                    @if($error->trace && is_countable($error->trace))
                        <!-- TODO: Error Trace -->
                    @else
                    No trace found.
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
