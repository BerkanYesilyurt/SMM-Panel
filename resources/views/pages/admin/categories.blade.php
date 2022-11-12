@extends('pages.admin.layout')
@section('subTitle', 'Categories')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Categories
        </h4>

        <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th><center>CATEGORY ID</center></th>
                        <th><center>NAME</center></th>
                        <th><center>STATUS</center></th>
                        <th><center>ACTIONS</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($categories as $category)
                        <tr>
                            <td><center><b>{{$category->id}}</b></center></td>
                            <td><center>{{$category->name}}</center></td>
                            <td><center>{{$category->status}}</center></td>
                            <td><center><button type="button" onclick="changeModal(this)" data-categoryid="{{$category->id}}" data-categoryname="{{$category->name}}" data-categorystatus="{{$category->status}}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        <span class="tf-icons bx bx-detail"></span>&nbsp; Change Details
                                    </button></center>
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
                    <div class="row">

                        <div class="col mb-3" id="modalCategoryName">
                            <b>Loading..</b>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-3" id="modalCategoryStatus">
                            <b>Loading..</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeModal(element){
            document.getElementById('modalCategoryName').innerHTML = '<h5><b>' + element.dataset.categoryname + ' (ID: ' + element.dataset.categoryid + ')</b></h5>';
            document.getElementById('modalCategoryStatus').innerHTML = element.dataset.categorystatus;
        }
    </script>
@endsection
