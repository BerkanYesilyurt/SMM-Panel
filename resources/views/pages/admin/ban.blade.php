@extends('pages.admin.layout')
@section('subTitle', 'Ban')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Ban Page
        </h4>

        @if ($errors->any())
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

        <div class="row">
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-12">
                                <h5 class="card-header m-0 me-2 pb-3">{{ucfirst($type)}} Ban</h5>
                                <div class="px-2" style="margin-left: 0.9rem; margin-right: 0.9rem;">
                                    @if(!checkBan($type, $user))
                                    <form action="/admin/ban" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}" />
                                        <div class="mt-2 mb-3">
                                            <label for="permanent" class="form-label">Permanent</label>
                                            <select id="permanent" name="permanent" class="form-select form-select-lg" required>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            <span class="form-label" style="text-transform: none">If yes is selected, the date will not matter.</span>
                                        </div>

                                        <div class="mt-2 mb-3">
                                            <label class="form-label">Date</label>
                                            <input class="form-control form-select-lg" type="date" name="until_at" value="{{now()->addDays(7)->format('Y-m-d')}}" id="date" />
                                        </div>

                                        <div class="mt-2">
                                            <label for="type" class="form-label">Type</label>
                                            <select id="type" name="type" class="form-select form-select-lg">
                                                @if($type == 'ticket')<option value="ticket" selected>Ticket Ban</option>@endif
                                                @if($type == 'account')<option value="account" selected>Account Ban</option>@endif
                                            </select>
                                        </div>

                                        @if($type == 'ticket')
                                            <div class="mt-1 mb-3">
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="radio" name="ticketOptions" id="ticketRadio1" value="close" required>
                                                    <label class="form-check-label" for="ticketRadio1">Close all tickets of this user.</label>
                                                </div><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="ticketOptions" id="ticketRadio2" value="delete">
                                                    <label class="form-check-label" for="ticketRadio2">Delete all tickets of this user.</label>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mt-2 mb-3">
                                            <button class="btn btn-primary btn-lg" type="submit" style="width: 100%;">BAN</button>
                                        </div>
                                    </form>
                                    @else
                                    <div class="alert alert-danger" role="alert">
                                        <b>This user is {{$type}} banned.</b>
                                        <br>{!! getBanDateMessage($type, $user) !!}
                                    </div>
                                    <form action="/admin/delete-ban" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <input type="hidden" name="type" value="{{$type}}">

                                        <div class="mt-2 mb-3">
                                            <button class="btn btn-primary btn-lg" type="submit" style="width: 100%;">UNBAN</button>
                                        </div>
                                    </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4 order-2 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">User Details</h5>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">

                                        <div class="d-flex w-100">
                                            <div class="me-2">
                                                <a class="text-muted d-block mb-1">Name</a>
                                                <h5 class="mb-0">{{$user->name}} (<a href="/admin/user/{{$user->id}}/edit" target="_blank">Profile</a>)</h5>
                                            </div>
                                        </div>

                                        <div class="d-flex w-100">
                                            <div class="me-2">
                                                <a class="text-muted d-block mb-1">Email</a>
                                                <h5 class="mb-0">{{$user->email}}</h5>
                                            </div>
                                        </div>

                                        <div class="d-flex w-100">
                                            <div class="me-2">
                                                <a class="text-muted d-block mb-1">Balance</a>
                                                <h5 class="mb-0">{{$configsArray['currency_symbol']}}{{floatval($user->balance)}}</h5>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
