@extends('pages.admin.layout')
@section('subTitle', 'Users')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Users
        </h4>

        <div class="card">

            <div class="table-responsive text-nowrap">
                <style>
                    table {
                        border-spacing: 0px;
                        table-layout: fixed;
                        margin-left: auto;
                        margin-right: auto;
                    }
                </style>
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 8%;"><center>ID</center></th>
                        <th style="width: 20%;"><center>NAME</center></th>
                        <th style="width: 20%;"><center>E-MAIL</center></th>
                        <th style="width: 10%;"><center>AUTHORITY</center></th>
                        <th style="width: 10%;"><center>STATUS</center></th>
                        <th style="width: 8%;"><center>BALANCE</center></th>
                        <th style="width: 12%;"><center>CREATED AT</center></th>
                        <th style="width: 12%;"><center>EDIT</center></th>

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

                        case 'support':
                        echo 'warning';
                        break;

                        case 'admin':
                        echo 'danger';
                        break;

                        default:
                        echo 'success';
                    }
                    @endphp me-1">{{$user->authority == 'none' ? 'USER' : $user->authority}}</span></center></td>
                            <td><center>{{$user->status}}</center></td>
                            <td><center>{{$configsArray['currency_symbol']}}{{round($user->balance, 4)}}</center></td>
                            <td><center>{{$user->created_at->diffForHumans()}}</center></td>
                            <td><center>
                                    <button type="button" onclick="changeModal(this)" data-username="{{$user->name}}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        <span class="tf-icons bx bx-edit"></span>&nbsp; Edit User
                                    </button></center>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"><br>
                                <center>
                                    <b>No Users Found.</b>
                                </center>
                                <br></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                @if($userCount > 0)
                    <div class="divider divider-primary">
                        <div class="divider-text"><b>Total Users: {{$userCount}}</b></div>
                    </div>
                @endif
                <center>{{ $users->links() }}</center>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3" id="modalUserName">
                            <b>Loading..</b>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        function changeModal(element){
            document.getElementById('modalUserName').innerHTML = '<h5><b>' + element.dataset.username + '</b></h5>';
        }
    </script>
@endsection
