@extends('pages.admin.layout')
@section('subTitle', 'Users')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Users
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenterNewUser" style="float:right;">
                <span class="tf-icons bx bx-plus"></span>&nbsp; New User
            </button>
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

        <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th><center>ID</center></th>
                        <th><center>NAME</center></th>
                        <th><center>E-MAIL</center></th>
                        <th><center>AUTHORITY</center></th>
                        <th><center>STATUS</center></th>
                        <th><center>BALANCE</center></th>
                        <th><center>CREATED AT</center></th>
                        <th><center>EDIT</center></th>

                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($users as $user)
                        <tr>
                            <td><center><b>{{$user->id}}</b></center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$user->name}}</center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$user->email}}</center></td>
                            <td><center><span class="badge bg-@php
                    switch($user->authority){

                        case \App\Enums\UserAuthorityEnum::support->value:
                        echo 'warning';
                        break;

                        case \App\Enums\UserAuthorityEnum::admin->value:
                        echo 'danger';
                        break;

                        default:
                        echo 'success';
                    }
                    @endphp me-1">{{$user->authority == \App\Enums\UserAuthorityEnum::none->value ? 'USER' : strtoupper(\App\Enums\UserAuthorityEnum::from($user->authority)->name)}}</span></center></td>
                            <td><center>{{checkBan('account', $user) ? 'Account Banned' : (checkBan('ticket', $user) ? 'Ticket Banned' : 'ACTIVE')}}</center></td>
                            <td><center>{{$configsArray['currency_symbol']}}{{round($user->balance, 4)}}</center></td>
                            <td><center>{{$user->created_at->diffForHumans()}}</center></td>
                            <td><center>
                            <button type="button" onclick="prepareForDelete(this)" data-userid="{{$user->id}}" data-useremail="{{$user->email}}" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenterDeleteUser">
                                <span class="tf-icons bx bx-trash"></span>
                            </button>
                            <a href="/admin/user/{{$user->id}}/edit" target="_blank" class="btn btn-sm btn-primary">
                                <span class="tf-icons bx bx-edit"></span>&nbsp; Edit User
                            </a>
                            <a href="/admin/ban/{{$user->id}}/account" target="_blank" class="btn btn-sm btn-danger"><i class="tf-icons bx bx-block"></i></a></center>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8"><br>
                                <center>
                                    <b>No Users Found.</b>
                                </center>
                                <br></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <center>{{ $users->links() }}</center>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterNewUser" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form" action="/admin/new-user">
                        @csrf

                        <div class="col mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Berkan Yeşilyurt" required>
                        </div>

                        <div class="col mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="berkan38212@gmail.com" required>
                        </div>

                        <div class="col mb-3">
                            <label for="balance" class="form-label">Balance:</label>
                            <input type="text" id="balance" name="balance" class="form-control" value="0" required>
                        </div>

                        <div class="col mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="text" id="password" name="password" class="form-control" placeholder="············" required>
                        </div>

                        <div class="col mb-3">
                            <label for="contact" class="form-label">Contact:</label>
                            <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact" required>
                        </div>

                        <div class="col mb-3">
                            <label for="authority" class="form-label">Authority:</label>
                            <select id="authority" class="form-control" name="authority">
                                @foreach(App\Enums\UserAuthorityEnum::values() as $key => $value)
                                    <option value="{{$key}}">{{strtoupper($value)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="submit(); this.disabled = true;" style="color: white; width: 100%;">Create User</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterDeleteUser" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="deleteuser" action="/admin/delete-user">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">

                        <div class="col mb-3">
                            <span id="prepareForDelete"></span>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-danger" onclick="deleteUser(); this.disabled = true;" style="color: white; width: 100%;">Delete User & Tickets</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submit(){
            document.getElementById("form").submit();
        }

        function prepareForDelete(element){
            document.getElementById('delete_id').value = element.dataset.userid;
            document.getElementById('prepareForDelete').innerHTML = '<b>' + element.dataset.useremail + '(ID: ' + element.dataset.userid + ') </b> will be deleted. Are you sure?';
        }

        function deleteUser(){
            document.getElementById("deleteuser").submit();
        }
    </script>
@endsection
