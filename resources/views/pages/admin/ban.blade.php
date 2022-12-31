@extends('pages.admin.layout')
@section('subTitle', 'Ban')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Ban Page
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

                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-12">
                                <h5 class="card-header m-0 me-2 pb-3">Ban</h5>
                                <div class="px-2" style="margin-left: 0.9rem; margin-right: 0.9rem;">
                                    @if(!checkBan($type, $user))
                                    <form action="/admin/ban" method="POST">
                                        @csrf
                                        <div class="mt-2 mb-3">
                                            <label for="permanent" class="form-label">Permanent</label>
                                            <select id="permanent" name="permanent" class="form-select form-select-lg" required="" onchange="dateVisibility()">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            <span class="form-label" style="text-transform: none">If yes is selected, the date will not matter.</span>
                                        </div>

                                        <div class="mt-2 mb-3">
                                            <label class="form-label">Date</label>
                                            <input class="form-control form-select-lg" type="date" value="{{now()->addDays(7)->format('Y-m-d')}}" id="date" />
                                        </div>

                                        <div class="mt-2 mb-3">
                                            <label for="type" class="form-label">Type</label>
                                            <select id="type" name="type" class="form-select form-select-lg" disabled>
                                                <option value="ticket" @selected($type == 'ticket')>Ticket Ban</option>
                                                <option value="account" @selected($type == 'account')>Account Ban</option>
                                            </select>
                                        </div>

                                        <div class="mt-2 mb-3">
                                            <button class="btn btn-primary btn-lg" type="submit" style="width: 100%;">BAN</button>
                                        </div>
                                    </form>
                                    @else
                                    <div class="alert alert-danger" role="alert">
                                        <b>This user is {{$type}} banned.</b>
                                        <br>{!! getBanDateMessage($type) !!}
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

    <script>
        function dateVisibility() {
            var permanent = document.getElementById("permanent").value;
            if(permanent == 1){
            document.getElementById("date").disabled = true;
            }else{
            document.getElementById("date").disabled = false;
            }
        }
    </script>
@endsection
