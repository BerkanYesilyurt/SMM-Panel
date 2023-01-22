@extends('pages.admin.layout')
@section('subTitle', 'Payment Methods')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin Panel /</span> Payment Methods
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenterNewPaymentMethod" style="float:right;">
                <span class="tf-icons bx bx-plus"></span>&nbsp; New Payment Method
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
        <div class="card">

            <div class="table-responsive text-nowrap">
                <style>
                    table {
                        border-spacing: 0px;
                        table-layout: fixed;
                        margin-left: auto;
                        margin-right: auto;
                    }
                </style>
                <table class="table">
                    <thead>
                    <tr>
                        <th><center>ID</center></th>
                        <th><center>NAME</center></th>
                        <th><center>MIN</center></th>
                        <th><center>MAX</center></th>
                        <th><center>STATUS</center></th>
                        <th><center>ACTIONS</center></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($paymentMethods as $paymentMethod)
                        <tr>
                            <td><center><b>{{$paymentMethod->id}}</b></center></td>
                            <td style="white-space:pre-wrap; word-wrap:break-word;"><center>{{$paymentMethod->name}}</center></td>
                            <td><center>{{$paymentMethod->min_amount}}</center></td>
                            <td><center>{{$paymentMethod->max_amount}}</center></td>
                            <td><center><span class="badge bg-{{$paymentMethod->status == \App\Enums\ActiveInactiveState::ACTIVE->value ? 'success' : 'danger'}} me-1">{{$paymentMethod->status == \App\Enums\ActiveInactiveState::ACTIVE->value ? 'ACTIVE' : 'INACTIVE'}}</span></center></td>
                            <td><center>
                                    <button type="button" onclick="prepareForDelete(this)" data-paymentmethodid="{{$paymentMethod->id}}" data-paymentmethodname="{{$paymentMethod->name}}" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenterDeletePaymentMethod">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                                    <button type="button" onclick="changeModal(this)" data-paymentmethod="{{$paymentMethod}}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        <span class="tf-icons bx bx-pencil"></span>&nbsp; Change Details
                                    </button>
                                </center>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"><br>
                                <center>
                                    <b>No Payment Methods Found.</b>
                                </center>
                                <br>
                            </td>
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
                    <h5 class="modal-title" id="modalCenterTitle">Payment Method Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form" action="/admin/payment-methods">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="col mb-3">
                            <label for="updatepaymentmethodname" class="form-label">Payment Method Name:</label>
                            <textarea class="form-control" rows="2" maxlength="150" name="name" id="updatepaymentmethodname" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="updatepaymentmethodicon" class="form-label">Payment Method Icon: (<a href="https://boxicons.com/" target="_blank">Icons</a>)</label>
                            <input type="text" id="updatepaymentmethodicon" name="icon" maxlength="150" class="form-control" placeholder="Icon (Example: bxl-paypal)" required>
                        </div>

                        <div class="col mb-3">
                            <label for="updatepaymentmethodstatus" class="form-label">Payment Method Status:</label>
                            <select id="updatepaymentmethodstatus" class="form-control" name="status">
                                @foreach(App\Enums\ActiveInactiveState::values() as $key => $value)
                                    <option value="{{$key}}" @selected($value == App\Enums\ActiveInactiveState::ACTIVE->name)>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label for="updatepaymentmethodconfigkey" class="form-label">Payment Method Config Key:</label>
                            <input type="text" id="updatepaymentmethodconfigkey" name="config_key" maxlength="150" class="form-control" placeholder="Config Key" required>
                        </div>

                        <div class="col mb-3">
                            <label for="updatepaymentmethodconfigvalue" class="form-label">Payment Method Config Value:</label>
                            <input type="text" id="updatepaymentmethodconfigvalue" name="config_value" maxlength="150" class="form-control" placeholder="Config Value" required>
                        </div>

                        <div class="col mb-3">
                            <label for="updatepaymentmethodminamount" class="form-label">Payment Method Min Amount:</label>
                            <input type="text" id="updatepaymentmethodminamount" name="min_amount" maxlength="150" class="form-control" placeholder="Minumum Amount (Example: 12.5)" required>
                        </div>

                        <div class="col mb-3">
                            <label for="updatepaymentmethodmaxamount" class="form-label">Payment Method Max Amount:</label>
                            <input type="text" id="updatepaymentmethodmaxamount" name="max_amount" maxlength="150" class="form-control" placeholder="Maximum Amount(Example: 100)" required>
                        </div>

                        <div class="col mb-3">
                            <label for="updatepaymentmethodismanual" class="form-label">Is Payment Method Manual:</label>
                            <select id="updatepaymentmethodismanual" class="form-control" name="is_manual">
                                @foreach(App\Enums\ActiveInactiveState::values() as $key => $value)
                                    <option value="{{$key}}" @selected($value == App\Enums\ActiveInactiveState::ACTIVE->name)>{{$value}}</option>
                                @endforeach
                            </select>
                            <span class="form-label" style="text-transform: none">This option defines the visibility of left payment area.
                            If it is active, only content will be shown and all payment information must be written in the content area.</span>
                        </div>

                        <div class="col mb-3">
                            <label for="updatepaymentmethodcontent" class="form-label">Payment Method Content:</label>
                            <textarea class="form-control" rows="5" name="content" id="updatepaymentmethodcontent" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="submit(); this.disabled = true;" style="color: white; width: 100%;" id="submitbutton">Update Payment Method</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterNewPaymentMethod" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterNewPaymentMethodTitle">New Payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="createnewpaymentmethod" action="/admin/new-payment-method">
                        @csrf

                        <div class="col mb-3">
                            <label for="newpaymentmethodname" class="form-label">Payment Method Name:</label>
                            <textarea class="form-control" rows="2" maxlength="150" name="name" id="newpaymentmethodname" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <label for="newpaymentmethodicon" class="form-label">Payment Method Icon: (<a href="https://boxicons.com/" target="_blank">Icons</a>)</label>
                            <input type="text" id="newpaymentmethodicon" name="icon" maxlength="150" class="form-control" placeholder="Icon (Example: bxl-paypal)" required>
                        </div>

                        <div class="col mb-3">
                            <label for="newpaymentmethodstatus" class="form-label">Payment Method Status:</label>
                            <select id="newpaymentmethodstatus" class="form-control" name="status">
                                @foreach(App\Enums\ActiveInactiveState::values() as $key => $value)
                                    <option value="{{$key}}" @selected($value == App\Enums\ActiveInactiveState::ACTIVE->name)>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label for="newpaymentmethodconfigkey" class="form-label">Payment Method Config Key:</label>
                            <input type="text" id="newpaymentmethodconfigkey" name="config_key" maxlength="150" class="form-control" placeholder="Config Key" required>
                        </div>

                        <div class="col mb-3">
                            <label for="newpaymentmethodconfigvalue" class="form-label">Payment Method Config Value:</label>
                            <input type="text" id="newpaymentmethodconfigvalue" name="config_value" maxlength="150" class="form-control" placeholder="Config Value" required>
                        </div>

                        <div class="col mb-3">
                            <label for="newpaymentmethodminamount" class="form-label">Payment Method Min Amount:</label>
                            <input type="text" id="newpaymentmethodminamount" name="min_amount" maxlength="150" class="form-control" placeholder="Minumum Amount (Example: 12.5)" required>
                        </div>

                        <div class="col mb-3">
                            <label for="newpaymentmethodmaxamount" class="form-label">Payment Method Max Amount:</label>
                            <input type="text" id="newpaymentmethodmaxamount" name="max_amount" maxlength="150" class="form-control" placeholder="Maximum Amount(Example: 100)" required>
                        </div>

                        <div class="col mb-3">
                            <label for="newpaymentmethodismanual" class="form-label">Is Payment Method Manual:</label>
                            <select id="newpaymentmethodismanual" class="form-control" name="is_manual">
                                @foreach(App\Enums\ActiveInactiveState::values() as $key => $value)
                                    <option value="{{$key}}" @selected($value == App\Enums\ActiveInactiveState::ACTIVE->name)>{{$value}}</option>
                                @endforeach
                            </select>
                            <span class="form-label" style="text-transform: none">This option defines the visibility of left payment area.
                            If it is active, only content will be shown and all payment information must be written in the content area.</span>
                        </div>

                        <div class="col mb-3">
                            <label for="newpaymentmethodcontent" class="form-label">Payment Method Content:</label>
                            <textarea class="form-control" rows="5" name="content" id="newpaymentmethodcontent" style="width: 100%; resize: vertical;" aria-label="With textarea"></textarea>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary" onclick="createNewPaymentMethod(); this.disabled = true;" style="color: white; width: 100%;">Create Payment Method</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenterDeletePaymentMethod" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterDeleteTitle">Delete Payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="deletepaymentmethod" action="/admin/delete-payment-method">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">

                        <div class="col mb-3">
                            <span id="prepareForDelete"></span>
                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-danger" onclick="deletePaymentMethod(); this.disabled = true;" style="color: white; width: 100%;">Delete Payment Method</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeModal(element){
            var paymentmethod = JSON.parse(element.dataset.paymentmethod);
            document.getElementById('id').value = paymentmethod.id;
            document.getElementById('updatepaymentmethodname').value = paymentmethod.name;
            document.getElementById('updatepaymentmethodicon').value = paymentmethod.icon;
            document.getElementById('updatepaymentmethodstatus').value = paymentmethod.status;
            document.getElementById('updatepaymentmethodconfigkey').value = paymentmethod.config_key;
            document.getElementById('updatepaymentmethodconfigvalue').value = paymentmethod.config_value;
            document.getElementById('updatepaymentmethodminamount').value = paymentmethod.min_amount;
            document.getElementById('updatepaymentmethodmaxamount').value = paymentmethod.max_amount;
            document.getElementById('updatepaymentmethodismanual').value = paymentmethod.is_manual;
            document.getElementById('updatepaymentmethodcontent').value = paymentmethod.content;
        }

        function prepareForDelete(element){
            document.getElementById('delete_id').value = element.dataset.paymentmethodid;
            document.getElementById('prepareForDelete').innerHTML = '<b>' + element.dataset.paymentmethodname + '(ID: ' + element.dataset.paymentmethodid + ')</b> will be deleted. Are you sure?';
        }

        function submit(){
            document.getElementById("form").submit();
        }

        function createNewPaymentMethod(){
            document.getElementById("createnewpaymentmethod").submit();
        }

        function deletePaymentMethod(){
            document.getElementById("deletepaymentmethod").submit();
        }
    </script>
@endsection
