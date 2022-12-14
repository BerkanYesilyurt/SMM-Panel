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


                <div id="accordion{{$announcement->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$announcement->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="/admin/announcements" method="POST" id="form{{$announcement->id}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$announcement->id}}" />
                        <hr>
                        <label class="form-label fw-bolder">Current Title:</label><br>
                        {!! $announcement->title !!}
                        <br><br>
                        <label for="title{{$announcement->id}}" class="form-label fw-bolder">Title:</label>
                        <textarea class="form-control" rows="2" maxlength="1000" name="title" id="title{{$announcement->id}}" style="width: 100%; resize: vertical;" aria-label="With textarea">{!! $announcement->title !!}</textarea>
                        <br>
                        <hr>
                        <br>
                        <label class="form-label fw-bolder">Current Description:</label><br>
                        {!! $announcement->description !!}
                        <br><br>
                        <label for="description{{$announcement->id}}" class="form-label fw-bolder">Description:</label>
                        <textarea class="form-control" rows="2" maxlength="1000" name="description" id="description{{$announcement->id}}" style="width: 100%; resize: vertical;" aria-label="With textarea">{!! $announcement->description !!}</textarea>
                        <br>
                        <button type="submit" class="btn btn-primary" onclick="this.disabled = true; form{{$announcement->id}}.submit();" style="color: white; width: 100%;">Update Announcement</button>

                        </form>
                        <br>
                        <button class="btn btn-danger" onclick="prepareForDelete(this)" style="color: white; width: 100%;" data-announcementtitle="{!! $announcement->title !!}" data-announcementid="{{$announcement->id}}" data-bs-toggle="modal" data-bs-target="#modalCenterDeleteAnnouncement">Delete Announcement</button>
                    </div>
                </div>
            </div><br>
        @empty
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="demo-inline-spacing mt-3">
                                <tr>
                                    <td colspan="5">
                                        <center>
                                            <b>No Announcements Found.</b>
                                        </center>
                                        <br>
                                    </td>
                                </tr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <textarea class="form-control" rows="2" maxlength="250" name="title" id="titlenew" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="descriptionnew" class="form-label">Announcement Description:</label>
                            <textarea class="form-control" rows="3" maxlength="250" name="description" id="descriptionnew" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="createNewAnnouncement(); this.disabled = true;" style="color: white; width: 100%;">Create Announcement</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterDeleteAnnouncement" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="deleteannouncement" action="/admin/delete-announcement">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">

                        <div class="col mb-3">
                            <span id="prepareForDelete"></span>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-danger" onclick="deleteAnnouncement(); this.disabled = true;" style="color: white; width: 100%;">Delete Announcement</button>
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

        function prepareForDelete(element){
            document.getElementById('delete_id').value = element.dataset.announcementid;
            document.getElementById('prepareForDelete').innerHTML = '<b>' + element.dataset.announcementtitle + ' (ID: ' + element.dataset.announcementid + ') </b>will be deleted. Are you sure?';
        }

        function deleteAnnouncement(){
            document.getElementById("deleteannouncement").submit();
        }
    </script>
@endsection
