@extends('layout')
@section('subTitle', 'Profile')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{$configsArray['title']}} /</span> Profile
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
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div class="card-body">
                    <form action="/profile" name="updateProfile" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="updateProfile" />
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                       value="{{$currentUser->name}}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="contact" class="form-label">Skype / Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact"
                                       value="{{$currentUser->contact}}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email"
                                       value="{{$currentUser->email}}" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="timezone" class="form-label">Timezone</label>
                                <select name="timezone" id="timezone" class="select2 form-select">
                                    <option value="-43200" >(UTC -12:00) Baker/Howland Island</option>
                                    <option value="-39600" >(UTC -11:00) Niue</option>
                                    <option value="-36000" >(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti</option>
                                    <option value="-34200" >(UTC -9:30) Marquesas Islands</option>
                                    <option value="-32400" >(UTC -9:00) Alaska Standard Time, Gambier Islands</option>
                                    <option value="-28800" >(UTC -8:00) Pacific Standard Time, Clipperton Island</option>
                                    <option value="-25200" >(UTC -7:00) Mountain Standard Time</option>
                                    <option value="-21600" >(UTC -6:00) Central Standard Time</option>
                                    <option value="-18000" >(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time</option>
                                    <option value="-16200" >(UTC -4:30) Venezuelan Standard Time</option>
                                    <option value="-14400" >(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time</option>
                                    <option value="-12600" >(UTC -3:30) Newfoundland Standard Time</option>
                                    <option value="-10800" >(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay</option>
                                    <option value="-7200" >(UTC -2:00) South Georgia/South Sandwich Islands</option>
                                    <option value="-3600" >(UTC -1:00) Azores, Cape Verde Islands</option>
                                    <option value="0" >(UTC) Greenwich Mean Time, Western European Time</option>
                                    <option value="3600" >(UTC +1:00) Central European Time, West Africa Time</option>
                                    <option value="7200" >(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time</option>
                                    <option value="10800">(UTC +3:00) Moscow Time, East Africa Time, Arabia Standard Time</option>
                                    <option value="12600" >(UTC +3:30) Iran Standard Time</option>
                                    <option value="14400" >(UTC +4:00) Azerbaijan Standard Time, Samara Time</option>
                                    <option value="16200" >(UTC +4:30) Afghanistan</option>
                                    <option value="18000" >(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time</option>
                                    <option value="19800" >(UTC +5:30) Indian Standard Time, Sri Lanka Time</option>
                                    <option value="20700" >(UTC +5:45) Nepal Time</option>
                                    <option value="21600" >(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time</option>
                                    <option value="23400" >(UTC +6:30) Cocos Islands, Myanmar</option>
                                    <option value="25200" >(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam</option>
                                    <option value="28800" >(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time</option>
                                    <option value="31500" >(UTC +8:45) Australian Central Western Standard Time</option>
                                    <option value="32400" >(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time</option>
                                    <option value="34200" >(UTC +9:30) Australian Central Standard Time</option>
                                    <option value="36000" >(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time</option>
                                    <option value="37800" >(UTC +10:30) Lord Howe Island</option>
                                    <option value="39600" >(UTC +11:00) Srednekolymsk Time, Solomon Islands, Vanuatu</option>
                                    <option value="41400" >(UTC +11:30) Norfolk Island</option>
                                    <option value="43200" >(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time</option>
                                    <option value="45900" >(UTC +12:45) Chatham Islands Standard Time</option>
                                    <option value="46800" >(UTC +13:00) Samoa Time Zone, Phoenix Islands Time, Tonga</option>
                                    <option value="50400" >(UTC +14:00) Line Islands</option>
                                </select>
                                <script>
                                    document.getElementById('timezone').value = '{{$currentUser->timezone}}';
                                </script>
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
                        <input type="hidden" name="type" value="changePassword" />
                        <div class="mb-3 col-md-6">
                            <label for="old_password" class="form-label">Current Password</label>
                            <input class="form-control" type="password" id="old_password" name="old_password"
                                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                        </div>
                        <div class="mb-3 col-md-6"></div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">New Password</label>
                            <input class="form-control" type="password" id="password" name="password"
                                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input class="form-control" type="password" id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
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
                        @if(session('message'))
                            <div class="alert alert-success">
                                <h6 class="alert-heading fw-bold mb-1">{{session('message')}}</h6>
                                <p class="mb-0">Please do not share your API key with anyone.</p>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">API key is private and gives direct access to your account!</h6>
                                <p class="mb-0">Please do not share your API key with anyone.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">API KEY</label>
                        <input class="form-control" type="text" id="name" name="name" onClick="this.select();"
                               value="{{$currentUser->api_key ?? 'NOT DEFINED'}}" readonly>
                    </div>
                    <a href="/generate"
                       class="btn btn-danger deactivate-account">{{$currentUser->api_key ? 'Regenerate API Key' : 'Generate API Key'}}</a>

                </div>
            </div>
        </div>
    </div>
    </div>



    </div>
@endsection
