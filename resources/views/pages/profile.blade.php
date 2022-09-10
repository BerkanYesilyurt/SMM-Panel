@extends('layout')
@section('subTitle', 'Profile')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Profile
        </h4>

        <div class="row">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div class="card-body">
                    <form action="/profile" name="updateProfile" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{$currentUser->name}}" autofocus="">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="contact" class="form-label">Skype / Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="{{$currentUser->contact}}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{$currentUser->email}}" readonly >
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="timezone" class="form-label">Timezone</label>
                                <select id="timezone" class="select2 form-select">
                                    <option value="">Select Timezone</option>
                                    <option value="-12">(GMT-12:00) International Date Line West</option>
                                    <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                    <option value="-10">(GMT-10:00) Hawaii</option>
                                    <option value="-9">(GMT-09:00) Alaska</option>
                                    <option value="-8">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                    <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                    <option value="-7">(GMT-07:00) Arizona</option>
                                    <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                    <option value="-7">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                    <option value="-6">(GMT-06:00) Central America</option>
                                    <option value="-6">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                    <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                    <option value="-6">(GMT-06:00) Saskatchewan</option>
                                    <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                    <option value="-5">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                    <option value="-5">(GMT-05:00) Indiana (East)</option>
                                    <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                    <option value="-4">(GMT-04:00) Caracas, La Paz</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update Profile</button>
                            </div>
                        </div>
                         </form>
                        <br>
                        <hr class="my-0">
                        <br>

                        <form action="/profile" name="changePassword" method="POST">
                            @csrf
                            <div class="mb-3 col-md-6">
                                <label for="old_password" class="form-label">Current Password</label>
                                <input class="form-control" type="password" id="old_password" name="old_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus="">
                            </div>
                            <div class="mb-3 col-md-6"></div>
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">New Password</label>
                                <input class="form-control" type="password" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus="">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus="">
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Change Password</button>
                            </div>
                        </form>
                </div>
                <!-- /Account -->
            </div>
        <div class="card mb-4">
            <h5 class="card-header">API</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">API key is private and gives direct access to your account!</h6>
                        <p class="mb-0">Please do not share your api key with anyone.</p>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">API KEY</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$currentUser->api_key ?? 'NOT DEFINED'}}" readonly>
                </div>
                <a href="/generate" class="btn btn-danger deactivate-account">{{$currentUser->api_key ? 'Regenerate API Key' : 'Generate API Key'}}</a>

            </div>
            </div>
        </div>
    </div>
    </div>



    </div>
@endsection
