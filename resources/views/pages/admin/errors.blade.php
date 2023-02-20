@extends('pages.admin.layout')
@section('subTitle', 'Error Logs')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <form action="/admin/delete-errors" method="POST">
            @csrf
            <span class="text-muted fw-light">Admin Panel /</span> Error Logs
                <button type="submit" class="btn btn-primary" style="float:right;">
                    <span class="tf-icons bx bx-trash"></span>&nbsp; Delete All Logs
                </button>
            </form>
        </h4>
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
                        <th><center>User ID</center></th>
                        <th><center>Message</center></th>
                        <th><center>Url</center></th>
                        <th><center>Status Code</center></th>
                        <th><center>Method</center></th>
                        <th><center>Date</center></th>
                        <th><center>Actions</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($errors as $error)
                        <tr>
                            <td><center>{!!$error->user_id ? '<a href="/admin/user/'. $error->user_id .'/edit">' . $error->user_id . '</a>'  : '-' !!}</center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$error->message ?? '-'}}</center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$error->url}}</center></td>
                            <td><center>{!!$error->status_code ? '<span class="badge bg-danger">' . $error->status_code . '</span>' :  '-' !!}</center></td>
                            <td><center><span class="badge bg-{{$error->method == 'GET' ? 'info' : 'primary'}}">{{$error->method}}</span></center></td>
                            <td><center>{{$error->created_at->diffForHumans()}}</center></td>
                            <td><center><a href="/admin/error/{{$error->id}}" class="btn btn-sm btn-danger">
                                        <span class="tf-icons bx bx-detail"></span>&nbsp; Error Details
                                    </a></center></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"><br>
                                <center>
                                    <b>No Errors Found.</b>
                                </center>
                                <br></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <center><br>{{ $errors->links() }}</center>
            </div>
        </div>
    </div>
@endsection
