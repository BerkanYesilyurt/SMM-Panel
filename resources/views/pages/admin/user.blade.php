@extends('pages.admin.layout')
@section('subTitle', 'Edit User')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">


    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin Panel /</span> Edit User
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
            <h5 class="card-header">User Details (ID: {{$user->id}})</h5>
            <div class="card-body">
                <form action="/admin/user/{{$user->id}}/edit" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" id="name" name="name"
                                   value="{{$user->name}}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email"
                                   value="{{$user->email}}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="contact" class="form-label">Contact</label>
                            <input class="form-control" type="text" id="contact" name="contact"
                                   value="{{$user->contact}}">
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
                                document.getElementById('timezone').value = '{{$user->timezone}}';
                            </script>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="select2 form-select">
                                @foreach(App\Enums\UserStatusEnum::values() as $key => $value)
                                    <option value="{{ $key }}" @selected($user->status == $value)>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="api_key" class="form-label">API Key - <a onclick="generateAPI()" style="color: #000000; cursor:hand;cursor:pointer;"><b>GENERATE</b></a></label>
                            <input class="form-control" type="text" id="api_key" name="api_key"
                                   value="{{$user->api_key}}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="set_new_password" class="form-label">Set New Password</label>
                            <select name="set_new_password" id="set_new_password" class="select2 form-select" onchange="setDisabledAttrForNewPassword()">
                                <option value="0" selected>No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">New Password - <a onclick="generatePassword()" style="color: #000000; cursor:hand;cursor:pointer;"><b>GENERATE</b></a></label>
                            <input class="form-control" type="text" id="password" name="password" disabled>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="last_login" class="form-label">Last Login</label>
                            <input class="form-control" type="text" readonly id="last_login" name="last_login"
                                   value="{{$user->last_login->diffForHumans()}}">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="updated_at" class="form-label">Updated At</label>
                            <input class="form-control" type="text" readonly id="updated_at" name="updated_at"
                                   value="{{$user->updated_at->diffForHumans()}}">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="created_at" class="form-label">Created At</label>
                            <input class="form-control" type="text" readonly id="created_at" name="created_at"
                                   value="{{$user->created_at->diffForHumans()}}">
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Edit User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <h5 class="card-header">User Balance</h5>
            <div class="card-body">
                <form action="/admin/user/{{$user->id}}/edit" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <span class="badge bg-dark cursor-pointer" onclick="addBalance(10)">ADD {{$config['currency_symbol']}}10</span>
                            <span class="badge bg-dark cursor-pointer" onclick="addBalance(20)">ADD {{$config['currency_symbol']}}20</span>
                            <span class="badge bg-dark cursor-pointer" onclick="addBalance(50)">ADD {{$config['currency_symbol']}}50</span>
                            <span class="badge bg-dark cursor-pointer" onclick="addBalance(100)">ADD {{$config['currency_symbol']}}100</span>
                            <span class="badge bg-dark cursor-pointer" onclick="subBalance(10)">SUB {{$config['currency_symbol']}}10</span>
                            <span class="badge bg-dark cursor-pointer" onclick="subBalance(20)">SUB {{$config['currency_symbol']}}20</span>
                            <span class="badge bg-dark cursor-pointer" onclick="subBalance(50)">SUB {{$config['currency_symbol']}}50</span>
                            <span class="badge bg-dark cursor-pointer" onclick="subBalance(100)">SUB {{$config['currency_symbol']}}100</span><br><br>
                            <label for="balance" class="form-label">Balance:</label>
                            <input class="form-control" type="number" id="balance" name="balance"
                                   value="{{$user->balance}}">
                            <br><span class="badge bg-success">Current: {{$config['currency_symbol']}}{{$user->balance}}</span>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Update Balance</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function generateAPI() {
        var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var Length = 55;
        var api_key = "";
        for (var i = 1; i <= Length; i++) {
            var randomNumber = Math.floor(Math.random() * chars.length);
            api_key += chars.substring(randomNumber, randomNumber +1);
        }
        document.getElementById("api_key").value = api_key;
    }

    function generatePassword(){
        var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var Length = 16;
        var password = "";
        for (var i = 1; i <= Length; i++) {
            var randomNumber = Math.floor(Math.random() * chars.length);
            password += chars.substring(randomNumber, randomNumber +1);
        }
        if(!document.getElementById("password").disabled){
        document.getElementById("password").value = password;
        }
    }
    function setDisabledAttrForNewPassword() {
        document.getElementById("password").disabled = document.getElementById("set_new_password").value != 1 ? true : false;
    }

    function addBalance(amount){
        document.getElementById("balance").value = Number(document.getElementById("balance").value) + amount;
    }

    function subBalance(amount){
        if((Number(document.getElementById("balance").value) - amount) >= 0){
        document.getElementById("balance").value = Number(document.getElementById("balance").value) - amount;
        }
    }
</script>
@endsection
