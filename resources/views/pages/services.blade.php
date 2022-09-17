@extends('layout')
@section('subTitle', 'Services')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Services
        </h4>

        <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th><center>SERVICE ID</center></th>
                        <th><center>NAME</center></th>
                        <th><center>RATE</center></th>
                        <th><center>MIN</center></th>
                        <th><center>MAX</center></th>
                        <th><center>DESCRIPTION</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($categories as $categoryId => $categoryName)
                        @if(count($services[$categoryId]))
                        <tr>
                            <td colspan="6" class="table-warning"><center><font style="font-size: 120%;"><strong>{{$categoryName}}</strong></font></center></td>
                        </tr>
                        @foreach($services[$categoryId] as $service)
                        <tr>
                            <td><center>{{$service->id}}</center></td>
                            <td><center>{{$service->name}}</center></td>
                            <td><center>{{$configsArray['currency_symbol']}}{{$service->price}}</center></td>
                            <td><center>{{$service->min}}</center></td>
                            <td><center>{{$service->max}}</center></td>
                            <td><center><button type="button" onclick="changeModal(this)" data-servicename="{{$service->name}}" data-servicedescription="{{$service->description}}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        <span class="tf-icons bx bx-detail"></span>&nbsp; View Details
                                    </button></center></td>
                        </tr>
                        @endforeach
                        @endif
                    @empty
                        <tr>
                            <td colspan="6"><br>
                                <center>
                                    <b>No Services Found.</b>
                                </center>
                                <br></td>
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
                        <div class="row">

                            <div class="col mb-3" id="modalServiceName">
                                <b>Loading..</b>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col mb-3" id="modalServiceDescription">
                                Loading..
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    <script>
        function changeModal(element){
            document.getElementById('modalServiceName').innerHTML = '<h5><b>' + element.dataset.servicename + '</b></h5>';
            document.getElementById('modalServiceDescription').innerHTML = element.dataset.servicedescription;
        }
    </script>

@endsection

