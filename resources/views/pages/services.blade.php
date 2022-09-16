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
                        <th><center>MIN / MAX</center></th>
                        <th><center>DESCRIPTION</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($categories as $category)
                        <tr>
                            <td colspan="5" class="table-warning"><center><font style="font-size: 125%;"><strong>{{$category->name}}</strong></font></center></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><br>
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

@endsection

