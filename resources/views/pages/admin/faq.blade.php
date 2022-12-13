@extends('pages.admin.layout')
@section('subTitle', 'FAQ')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> F.A.Q.
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenterNewFAQ" style="float:right;">
                <span class="tf-icons bx bx-plus"></span>&nbsp; New F.A.Q.
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
        @forelse($faqs as $faq)
            <div class="card accordion-item">
                <h2 class="accordion-header" id="heading{{$faq->id}}">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{$faq->id}}" aria-expanded="false" aria-controls="accordion{{$faq->id}}">
                        {{$loop->iteration}}-) {{$faq->question}}
                    </button>
                </h2>


                <div id="accordion{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$faq->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="/admin/faq" method="POST" id="form{{$faq->id}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$faq->id}}" />
                            <hr>
                            <label class="form-label fw-bolder">Current Question:</label><br>
                            {!! $faq->question !!}
                            <br><br>
                            <label for="question{{$faq->id}}" class="form-label fw-bolder">Question:</label>
                            <textarea class="form-control" rows="3" maxlength="1000" name="question" id="question{{$faq->id}}" style="width: 100%; resize: vertical;" aria-label="With textarea">{!! $faq->question !!}</textarea>
                            <br>
                            <hr>
                            <br>
                            <label class="form-label fw-bolder">Current Answer:</label><br>
                            {!! $faq->answer !!}
                            <br><br>
                            <label for="answer{{$faq->id}}" class="form-label fw-bolder">Answer:</label>
                            <textarea class="form-control" rows="6" maxlength="1000" name="answer" id="answer{{$faq->id}}" style="width: 100%; resize: vertical;" aria-label="With textarea">{!! $faq->answer !!}</textarea>
                            <br>
                            <button type="submit" class="btn btn-primary" onclick="this.disabled = true; form{{$faq->id}}.submit();" style="color: white; width: 100%;">Update F.A.Q.</button>

                        </form>
                        <br>
                        <button class="btn btn-danger" onclick="prepareForDelete(this)" style="color: white; width: 100%;" data-faqquestion="{!! $faq->question !!}" data-faqid="{{$faq->id}}" data-bs-toggle="modal" data-bs-target="#modalCenterDeleteFAQ">Delete F.A.Q.</button>
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
                                            <b>No F.A.Q. Found.</b>
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

    <div class="modal fade" id="modalCenterNewFAQ" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New F.A.Q.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/admin/new-faq" id="createnewFAQ">
                        @csrf

                        <div class="col mb-3">
                            <label for="questionnew" class="form-label">Question:</label>
                            <textarea class="form-control" rows="3" maxlength="250" name="question" id="questionnew" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="answernew" class="form-label">Answer:</label>
                            <textarea class="form-control" rows="6" maxlength="250" name="answer" id="answernew" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="createNewFAQ(); this.disabled = true;" style="color: white; width: 100%;">Create F.A.Q.</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterDeleteFAQ" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete F.A.Q.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="deleteFAQ" action="/admin/delete-faq">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">

                        <div class="col mb-3">
                            <span id="prepareForDelete"></span>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-danger" onclick="deleteFAQ(); this.disabled = true;" style="color: white; width: 100%;">Delete F.A.Q.</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function createNewFAQ(){
            document.getElementById("createnewFAQ").submit();
        }

        function prepareForDelete(element){
            document.getElementById('delete_id').value = element.dataset.faqid;
            document.getElementById('prepareForDelete').innerHTML = '<b>' + element.dataset.faqquestion + ' (ID: ' + element.dataset.faqid + ') </b>will be deleted. Are you sure?';
        }

        function deleteFAQ(){
            document.getElementById("deleteFAQ").submit();
        }
    </script>
@endsection
