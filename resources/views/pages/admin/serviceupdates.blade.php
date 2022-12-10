@extends('pages.admin.layout')
@section('subTitle', 'Service Updates')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Service Updates
        </h4>

        <form action="/admin/servicesupdates" method="POST">
            @csrf
            <div class="input-group">
            <select name="action" class="form-select form-select-lg">
                <option value="delete_all">Delete Selected Updates</option>
                <option value="delete_description">Delete Selected Update Descriptions</option>
                <option value="set_public">Set Selected Updates -> Public</option>
                <option value="set_notpublic">Set Selected Updates -> Not Public</option>
                <option value="set_pricepublic">Set Show Price Changes -> Public</option>
                <option value="set_pricenotpublic">Set Show Price Changes -> Not Public</option>
            </select>
            <button type="submit" class="btn btn-primary">
                <span class="tf-icons bx bx-right-arrow"></span>&nbsp; Submit
            </button>
            </div>
        <div style="margin-top: 10px; margin-bottom: 20px;">
        <input class="form-check-input me-1" type="checkbox" onclick="toggle(this);">Select / Unselect All Service Updates
        </div>
        @if($errors->any())
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
        <div class="card-body">
            <div class="row">
                <!-- List group checkbox -->
                <div class="col-lg-12">
                    <div class="demo-inline-spacing mt-3">
                        <div class="list-group">
                            @forelse($serviceupdates as $serviceupdate)
                                @if(isset($serviceupdate->old_price) && isset($serviceupdate->new_price))
                                <label class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" name="id[]" value="{{$serviceupdate->id}}">
                                    {{$serviceupdate->service->name}} (ID: {{$serviceupdate->service_id}})
                                    @if($serviceupdate->old_price && $serviceupdate->new_price)
                                        price <b>{{$serviceupdate->new_price > $serviceupdate->old_price ? 'increased to' : 'reduced to'}}</b>
                                        {{$configsArray['currency_symbol'] . floatval($serviceupdate->new_price)}}
                                    @endif
                                    @if($serviceupdate->description)
                                        <br><i class="bx bx-chevrons-right"></i><b>Additional Info:</b> {!! $serviceupdate->description !!}
                                    @endif
                                    <br>
                                    <i class="bx bx-bookmark-alt-plus"></i>
                                    <b>
                                    {!! $serviceupdate->public ? '<font color="green">Public</font>' : '<font color="red">Not Public</font>'  !!} -
                                    {!! $serviceupdate->show_price_changes ? '<font color="green">Price Changes Visible</font>' : '<font color="red">Price Changes Invisible</font>' !!}
                                    </b>
                                </label>
                                @endif
                            @empty
                                <center>
                                    <b>No Updates Found.</b>
                                </center>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!--/ List group checkbox -->
            </div>
        </div>
    </div>
    </form>

    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endsection
