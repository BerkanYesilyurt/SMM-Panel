@extends('pages.admin.layout')
@section('subTitle', 'Categories')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Categories
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenterNewCategory" style="float:right;">
                <span class="tf-icons bx bx-plus"></span>&nbsp; New Category
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
                        <th style="width: 10%;"><center>CATEGORY ID</center></th>
                        <th style="width: 50%;"><center>NAME</center></th>
                        <th style="width: 20%;"><center>STATUS</center></th>
                        <th style="width: 20%;"><center>ACTIONS</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($categories as $category)
                        <tr>
                            <td><center><b>{{$category->id}}</b></center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$category->name}}</center></td>
                            <td><center><span class="badge bg-{{$category->status == \App\Enums\CategoryStatusEnum::ACTIVE->value ? 'success' : 'danger'}} me-1">{{$category->status == \App\Enums\CategoryStatusEnum::ACTIVE->value ? 'ACTIVE' : 'INACTIVE'}}</span></center></td>
                            <td><center>
                                    <button type="button" onclick="prepareForDelete(this)" data-categoryid="{{$category->id}}" data-categoryname="{{$category->name}}" data-categorystatus="{{$category->status}}" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenterDeleteCategory">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                                    <button type="button" onclick="changeModal(this)" data-categoryid="{{$category->id}}" data-categoryname="{{$category->name}}" data-categorystatus="{{$category->status}}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        <span class="tf-icons bx bx-pencil"></span>&nbsp; Change Details
                                    </button>
                                </center>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"><br>
                                <center>
                                    <b>No Categories Found.</b>
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
                    <h5 class="modal-title" id="modalCenterTitle">Category Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form" action="/admin/categories">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="col mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <textarea class="form-control" rows="5" maxlength="250" name="name" id="name" style="width: 100%; resize: none;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select id="status" class="form-control" name="status">
                                @foreach(App\Enums\CategoryStatusEnum::values() as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="submit(); this.disabled = true;" style="color: white; width: 100%;" id="submitbutton">Update Category</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterNewCategory" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterNewCategoryTitle">New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="createnewcategory" action="/admin/new-category">
                        @csrf

                        <div class="col mb-3">
                            <label for="name" class="form-label">Category Name:</label>
                            <textarea class="form-control" rows="5" maxlength="250" name="name" id="name" style="width: 100%; resize: none;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="status" class="form-label">Category Status:</label>
                            <select id="status" class="form-control" name="status">
                                @foreach(App\Enums\CategoryStatusEnum::values() as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="createNewCategory(); this.disabled = true;" style="color: white; width: 100%;">Create Category</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterDeleteCategory" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterDeleteTitle">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="deletecategory" action="/admin/delete-category">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">

                        <div class="col mb-3">
                            <span id="prepareForDelete"></span>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-danger" onclick="deleteCategory(); this.disabled = true;" style="color: white; width: 100%;">Delete Category</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeModal(element){
            document.getElementById('id').value = element.dataset.categoryid;
            document.getElementById('name').value = element.dataset.categoryname;
            document.getElementById('status').value = element.dataset.categorystatus;
        }

        function prepareForDelete(element){
            document.getElementById('delete_id').value = element.dataset.categoryid;
            document.getElementById('prepareForDelete').innerHTML = '<b>' + element.dataset.categoryname + '(ID: ' + element.dataset.categoryid + ') </b>will be deleted. Are you sure?';
        }

        function submit(){
            document.getElementById("form").submit();
        }

        function createNewCategory(){
            document.getElementById("createnewcategory").submit();
        }

        function deleteCategory(){
            document.getElementById("deletecategory").submit();
        }
    </script>
@endsection
