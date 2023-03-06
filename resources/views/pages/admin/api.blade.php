@extends('pages.admin.layout')
@section('subTitle', 'API')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> API
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
                        <th><center>ACTIONS</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($apis as $api)
                        <tr>
                            <td><center><b>{{$api->id}}</b></center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$api->name}}</center></td>
                           <td><center>
                                    <!-- TODO: API admin buttons -->
                                </center>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3"><br>
                                <center>
                                    <b>No APIs Found.</b>
                                </center>
                                <br>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
