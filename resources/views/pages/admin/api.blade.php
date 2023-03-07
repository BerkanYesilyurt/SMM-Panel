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
                                   <button type="button" onclick="prepareForDelete(this)" data-apiid="{{$api->id}}" data-apiname="{{$api->name}}" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenterDeleteApi">
                                       <span class="tf-icons bx bx-trash"></span>
                                   </button>
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

    <div class="modal fade" id="modalCenterDeleteApi" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete API</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="deleteapi" action="/admin/delete-api">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">

                        <div class="col mb-3">
                            <span id="prepareForDelete"></span>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-danger" onclick="deleteApi(); this.disabled = true;" style="color: white; width: 100%;">Delete API</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function prepareForDelete(element){
            document.getElementById('delete_id').value = element.dataset.apiid;
            document.getElementById('prepareForDelete').innerHTML = '<b>' + element.dataset.apiname + '(ID: ' + element.dataset.apiid + ') </b>and <b>all related services with this API</b> will be deleted. Are you sure?';
        }

        function deleteApi(){
            document.getElementById("deleteapi").submit();
        }
    </script>
@endsection
