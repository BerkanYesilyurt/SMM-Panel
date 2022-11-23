@extends('pages.admin.layout')
@section('subTitle', 'Services')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Services
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenterNewService" style="float:right;">
                <span class="tf-icons bx bx-plus"></span>&nbsp; New Service
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
                        <th style="width: 5%;"><center>SERVICE ID</center></th>
                        <th style="width: 20%;"><center>CATEGORY</center></th>
                        <th style="width: 25%;"><center>NAME</center></th>
                        <th style="width: 8%;"><center>STATUS</center></th>
                        <th style="width: 8%;"><center>PRICE</center></th>
                        <th style="width: 10%;"><center>MIN - MAX</center></th>
                        <th style="width: 24%;"><center>ACTIONS</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($services as $service)
                        <tr>
                            <td><center><b>{{$service->id}}</b></center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$service->category->name}}</center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$service->name}}</center></td>
                            <td><center><span class="badge bg-{{$service->status == \App\Enums\ServiceStatusEnum::ACTIVE->value ? 'success' : 'danger'}} me-1">{{$service->status == \App\Enums\ServiceStatusEnum::ACTIVE->value ? 'ACTIVE' : 'INACTIVE'}}</span></center></td>
                            <td><center>{{$service->price}}</center></td>
                            <td><center>{{$service->min}} - {{$service->max}}</center></td>
                            <td><center>
                                    <button type="button" onclick="prepareForDelete(this)" data-serviceid="{{$service->id}}" data-servicename="{{$service->name}}" data-servicestatus="{{$service->status}}" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenterDeleteService">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                                    <button type="button" onclick="changeModal(this)" data-serviceid="{{$service->id}}" data-categoryid="{{$service->category->id}}" data-servicename="{{$service->name}}" data-servicedescription="{{$service->description}}" data-servicestatus="{{$service->status}}" data-serviceprice="{{$service->price}}" data-servicemin="{{$service->min}}" data-servicemax="{{$service->max}}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        <span class="tf-icons bx bx-pencil"></span>&nbsp; Change Details
                                    </button>
                                </center>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"><br>
                                <center>
                                    <b>No Services Found.</b>
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


    <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Service Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form" action="/admin/services" spellcheck="false">
                        @csrf
                        <input type="hidden" name="id" id="updateserviceid">

                        <div class="col mb-3">
                            <label for="updateservicename" class="form-label">Service Name:</label>
                            <textarea class="form-control" rows="2" maxlength="250" name="name" id="updateservicename" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="updateservicedescription" class="form-label">Service Description:
                                <span class="badge bg-dark cursor-pointer" style="margin-left: 5px;" onclick="addTag('updateservicedescription', 'refill')">REFILL</span>
                                <span class="badge bg-dark cursor-pointer" onclick="addTag('updateservicedescription', 'starttime')">START TIME</span>
                                <span class="badge bg-dark cursor-pointer" onclick="addTag('updateservicedescription', 'speed')">SPEED</span>
                            </label>
                            <textarea class="form-control" rows="4" maxlength="1000" name="description" id="updateservicedescription" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                            <span class="form-label" style="text-transform: none">Tags will not appear in the description and must be used <b>once</b>. Default: No DATA</span>
                        </div>

                        <div class="col mb-3">
                            <label for="updateservicecategoryid" class="form-label">Service Category:</label>
                            <select id="updateservicecategoryid" class="form-control" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label for="updateservicestatus" class="form-label">Service Status:</label>
                            <select id="updateservicestatus" class="form-control" name="status">
                                @foreach(App\Enums\ServiceStatusEnum::values() as $key => $value)
                                    <option value="{{$key}}" @selected($value == App\Enums\ServiceStatusEnum::ACTIVE->name)>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label for="updateserviceprice" class="form-label">SERVICE PRICE:</label>
                            <input type="text" id="updateserviceprice" name="price" class="form-control" placeholder="Price" required>
                        </div>

                        <div class="col mb-3">
                            <label for="updateservicemin" class="form-label">SERVICE MIN:</label>
                            <input type="text" id="updateservicemin" name="min" class="form-control" placeholder="Minumum" required>
                        </div>

                        <div class="col mb-3">
                            <label for="updateservicemax" class="form-label">SERVICE MAX:</label>
                            <input type="text" id="updateservicemax" name="max" class="form-control" placeholder="Maximum" required>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="submit(); this.disabled = true;" style="color: white; width: 100%;" id="submitbutton">Update Service</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterNewService" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterNewServiceTitle">New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="createnewservice" action="/admin/new-service" spellcheck="false">
                        @csrf
                        <div class="col mb-3">
                            <label for="newservicename" class="form-label">Service Name:</label>
                            <textarea class="form-control" rows="2" maxlength="250" name="name" id="newservicename" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="newservicedescription" class="form-label">Service Description:
                                <span class="badge bg-dark cursor-pointer" style="margin-left: 5px;" onclick="addTag('newservicedescription', 'refill')">REFILL</span>
                                <span class="badge bg-dark cursor-pointer" onclick="addTag('newservicedescription', 'starttime')">START TIME</span>
                                <span class="badge bg-dark cursor-pointer" onclick="addTag('newservicedescription', 'speed')">SPEED</span>
                            </label>
                            <textarea class="form-control" rows="4" maxlength="1000" name="description" id="newservicedescription" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                            <span class="form-label" style="text-transform: none">Tags will not appear in the description and must be used <b>once</b>. Default: No DATA</span>
                        </div>

                        <div class="col mb-3">
                            <label for="newservice_category_id" class="form-label">Service Category:</label>
                            <select id="newservice_category_id" class="form-control" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label for="newservicestatus" class="form-label">Status:</label>
                            <select id="newservicestatus" class="form-control" name="status">
                                @foreach(App\Enums\ServiceStatusEnum::values() as $key => $value)
                                    <option value="{{$key}}" @selected($value == App\Enums\CategoryStatusEnum::ACTIVE->name)>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label for="newserviceprice" class="form-label">SERVICE PRICE:</label>
                            <input type="text" id="newserviceprice" name="price" class="form-control" placeholder="Price" required>
                        </div>

                        <div class="col mb-3">
                            <label for="newservicemin" class="form-label">SERVICE MIN:</label>
                            <input type="text" id="newservicemin" name="min" class="form-control" placeholder="Minumum" required>
                        </div>

                        <div class="col mb-3">
                            <label for="newservicemax" class="form-label">SERVICE MAX:</label>
                            <input type="text" id="newservicemax" name="max" class="form-control" placeholder="Maximum" required>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="createNewService(); this.disabled = true;" style="color: white; width: 100%;">Create Service</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterDeleteService" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterServiceTitle">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="deleteservice" action="/admin/delete-service">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">

                        <div class="col mb-3">
                            <span id="prepareForDelete"></span>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-danger" onclick="deleteService(); this.disabled = true;" style="color: white; width: 100%;">Delete Service</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeModal(element){
            document.getElementById('updateserviceid').value = element.dataset.serviceid;
            document.getElementById('updateservicecategoryid').value = element.dataset.categoryid;
            document.getElementById('updateservicename').value = element.dataset.servicename;
            document.getElementById('updateservicestatus').value = element.dataset.servicestatus;
            document.getElementById('updateserviceprice').value = element.dataset.serviceprice;
            document.getElementById('updateservicemin').value = element.dataset.servicemin;
            document.getElementById('updateservicemax').value = element.dataset.servicemax;
            document.getElementById('updateservicedescription').value = element.dataset.servicedescription;
        }

        function prepareForDelete(element){
            document.getElementById('delete_id').value = element.dataset.serviceid;
            document.getElementById('prepareForDelete').innerHTML = '<b>' + element.dataset.servicename + '(ID: ' + element.dataset.serviceid + ') </b>will be deleted. Are you sure?';
        }

        function submit(){
            document.getElementById("form").submit();
        }

        function createNewService(){
            document.getElementById("createnewservice").submit();
        }

        function deleteService(){
            document.getElementById("deleteservice").submit();
        }

        function addTag(toWhere, type){
            let content;
            if(type == 'refill'){
                content = ' {refill}{/refill}';
            }else if(type == 'starttime'){
                content = ' {starttime}{/starttime}';
            }else if(type == 'speed'){
                content = ' {speed}{/speed}';
            }

            if(content){
                document.getElementById(toWhere).value += content;
            }
        }
    </script>
@endsection
