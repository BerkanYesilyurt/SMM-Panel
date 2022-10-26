@extends('pages.admin.layout')
@section('subTitle', 'System Settings')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">


    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin Panel /</span> System Settings
    </h4>

    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 1px;">
                    @foreach ($errors->all() as $error)
                        <li><b>{{$error}}</b></li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif


        <div class="card mb-4">
            <h5 class="card-header">Maintenance Mode</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-dark">
                        <h6 class="alert-heading fw-bold mb-1">WARNING:</h6>
                        <p class="mb-0">Maintenance Mode means that it will close all user-accessible areas and no new operations will be allowed.
                        It will not affect authorized users.</p>
                    </div>
                </div>
                <form action="/admin/system-settings" method="POST">
                    @csrf
                <input type="hidden" name="type" value="maintenancemode" />
                <button type="submit"
                   class="btn btn-danger deactivate-account">Active Maintenance Mode</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <h5 class="card-header">General</h5>
            <div class="card-body">
                <form action="/admin/system-settings" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="firstsection" />
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="title" class="form-label">Title</label>
                            <input class="form-control" type="text" id="title" name="title"
                                   value="{{$settings['title']['value']}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <input class="form-control" type="text" id="meta_description" name="meta_description"
                                   value="{{$settings['meta_description']['value']}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input class="form-control" type="text" id="meta_keywords" name="meta_keywords"
                                   value="{{$settings['meta_keywords']['value']}}">
                        </div>

                        <div class="divider divider-dashed"></div>

                        <h5>Currency</h5>
                        <div class="mb-3 col-md-6">
                            <label for="currency" class="form-label">Currency</label>
                            <input class="form-control" type="text" id="meta_keywords" name="currency"
                                   value="{{$settings['currency']['value']}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="currency_symbol" class="form-label">Currency Symbol</label>
                            <input class="form-control" type="text" id="currency_symbol" name="currency_symbol"
                                   value="{{$settings['currency_symbol']['value']}}">
                        </div>

                        <div class="divider divider-dashed"></div>

                        <h5>Pages & Options</h5>
                        <div class="mb-3 col-md-6">
                            <label for="service_updates_page" class="form-label">Service Updates Page</label>
                            <select name="service_updates_page" id="service_updates_page" class="select2 form-select">
                                <option value="0" @selected($settings['service_updates_page']['value'] == 0)>Inactive</option>
                                <option value="1" @selected($settings['service_updates_page']['value'] == 1)>Active</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="register_page" class="form-label">Register Page</label>
                            <select name="register_page" id="register_page" class="select2 form-select">
                                <option value="0" @selected($settings['register_page']['value'] == 0)>Inactive</option>
                                <option value="1" @selected($settings['register_page']['value'] == 1)>Active</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="directly_login" class="form-label">Homepage Directly Login</label>
                            <select name="directly_login" id="directly_login" class="select2 form-select">
                                <option value="0" @selected($settings['directly_login']['value'] == 0)>Inactive</option>
                                <option value="1" @selected($settings['directly_login']['value'] == 1)>Active</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="forgot_password" class="form-label">Forgot Password Option</label>
                            <select name="forgot_password" id="forgot_password" class="select2 form-select">
                                <option value="0" @selected($settings['directly_login']['value'] == 0)>Inactive</option>
                                <option value="1" @selected($settings['directly_login']['value'] == 1)>Active</option>
                            </select>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Change System Settings</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
