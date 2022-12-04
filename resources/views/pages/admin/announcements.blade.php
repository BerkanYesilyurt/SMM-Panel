@extends('pages.admin.layout')
@section('subTitle', 'Announcements')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Announcements
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenterNewAnnouncement" style="float:right;">
                <span class="tf-icons bx bx-plus"></span>&nbsp; New Announcement
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
        @forelse($announcements as $announcement)
            <div class="card accordion-item">
                <h2 class="accordion-header" id="heading{{$announcement->id}}">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{$announcement->id}}" aria-expanded="false" aria-controls="accordion{{$announcement->id}}">
                        {{$loop->iteration}}-) {{$announcement->title}}
                    </button>
                </h2>

                <form action="/admin/announcements" method="POST" id="form{{$announcement->id}}">
                @csrf
                <div id="accordion{{$announcement->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$announcement->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <label class="form-label">Current Title:</label><br>
                        {!! $announcement->title !!}
                        <br><br>
                        <label for="title{{$announcement->id}}" class="form-label">Title:</label>
                        <textarea class="form-control" rows="2" maxlength="1000" name="title" id="title{{$announcement->id}}" style="width: 100%; resize: vertical;" aria-label="With textarea">{!! $announcement->title !!}</textarea>
                        <br><br>
                        <label class="form-label">Current Description:</label><br>
                        {!! $announcement->description !!}
                        <br><br>
                        <label for="description{{$announcement->id}}" class="form-label">Description:</label>
                        <textarea class="form-control" rows="2" maxlength="1000" name="description" id="description{{$announcement->id}}" style="width: 100%; resize: vertical;" aria-label="With textarea">{!! $announcement->description !!}</textarea>
                        <br>
                        <button type="submit" class="btn btn-primary" onclick="this.disabled = true; form{{$announcement->id}}.submit();" style="color: white; width: 100%;">Update Announcement</button>
                    </div>
                </div>
                </form>
            </div><br>
        @empty
            <tr>
                <td colspan="5"><br>
                    <center>
                        <b>No Announcements Found.</b>
                    </center>
                    <br></td>
            </tr>
        @endforelse
    </div>

    <div class="modal fade" id="modalCenterNewAnnouncement" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/admin/new-announcement" id="createnewannouncement">
                        @csrf

                        <div class="col mb-3">
                            <label for="titlenew" class="form-label">Announcement Title:</label>
                            <textarea class="form-control" rows="2" maxlength="250" name="title" id="titlenew" style="width: 100%; resize: none;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="descriptionnew" class="form-label">Announcement Description:</label>
                            <textarea class="form-control" rows="3" maxlength="250" name="description" id="descriptionnew" style="width: 100%; resize: none;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="createNewAnnouncement(); this.disabled = true;" style="color: white; width: 100%;">Create Announcement</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function createNewAnnouncement(){
            document.getElementById("createnewannouncement").submit();
        }
    </script>
@endsection
