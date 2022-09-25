@extends('layout')
@section('subTitle', 'New Order')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome back {{ auth()->user()->name }}! 🎉</h5>
                                <p class="mb-4">
                                    Your total orders: <span class="fw-bold">0</span>
                                </p>

                                <a href="/orders" class="btn btn-sm btn-outline-primary">View Your Orders</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="../assets/img/illustrations/man-with-laptop-light.png"
                                    height="140"
                                    alt="User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img
                                            src="../assets/img/icons/unicons/chart-success.png"
                                            alt="Total Orders"
                                            class="rounded"
                                        />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Orders:</span>
                                <h3 class="card-title mb-2">0</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img
                                            src="../assets/img/icons/unicons/wallet-info.png"
                                            alt="Balance"
                                            class="rounded"
                                        />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Balance:</span>
                                <h3 class="card-title mb-2">{{$configsArray['currency_symbol']}}{{round(auth()->user()->balance, 2)}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-12">
                            <h5 class="card-header m-0 me-2 pb-3">New Order</h5>
                            <div class="px-2" style="margin-left: 0.9rem; margin-right: 0.9rem;">
                                <form action="" method="" name="neworder" id="neworder">
                                    @csrf
                                <div class="mt-2 mb-3">
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                    <style>
                                        .hidden{
                                            display:none;
                                        }
                                    </style>
                                    <label for="Categories" class="form-label">Categories</label>
                                    <select id="Categories" name="Categories" class="form-select form-select-lg" required>
                                        <option disabled selected hidden>Select A Category</option>
                                        @foreach($categories as $categoryId => $categoryName)
                                            <option value="{{$categoryId}}">{{$categoryName}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="Services" class="form-label">Services</label>
                                    <select id="Services" name="Services" class="form-select form-select-lg" required>
                                        <option disabled selected hidden>Select A Service</option>
                                        @foreach($categories as $categoryId => $categoryName)
                                            @foreach($services[$categoryId] as $service)
                                                <option value="{{$service->id}}" class="hidden" data-serviceid="{{$service->id}}" data-category="{{$categoryId}}" data-description="{{$service->description}}" data-price="{{$service->price}}" data-min="{{$service->min}}" data-max="{{$service->max}}">{{$service->name}} - {{$configsArray['currency_symbol']}}{{$service->price}}</option>
                                            @php($servicesList[$service->id] = $service)
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="Link" class="form-label">Link</label>
                                    <input id="Link" name="Link" class="form-control form-control-lg" type="text" placeholder="Link" required>
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="Quantity" class="form-label">Quantity</label>
                                    <input id="Quantity" name="Quantity" class="form-control form-control-lg" type="number" placeholder="Quantity" required>
                                    <div class="form-text" style="padding-top: 8px;">
                                        <span class="badge bg-success hidden" id="serviceMin" style="font-size:1em;"><b>Min: 100</b></span>
                                        <span class="badge bg-danger hidden" id="serviceMax" style="font-size:1em;"><b>Max: 500</b></span>
                                    </div>
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="Charge" class="form-label">Charge</label>
                                    <input id="Charge" class="form-control form-control-lg" type="text" readonly>
                                </div>

                                <div class="mt-2 mb-3">
                                <button class="btn btn-primary btn-lg" type="submit" style="width: 100%;">SUBMIT</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Service Details</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">

                                    <div id="refill" class="d-flex w-100"></div>
                                    <div id="starttime" class="d-flex w-100"></div>
                                    <div id="speed" class="d-flex w-100"></div>
                                    <div id="description" class="d-flex w-100"></div>
                                    <div id="serviceDescription"></div>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </div>
<x-servicedescription :services="$servicesList" />
<script>

    function defaultDescription(){
        $("#serviceDescription")
            .css({'position':'absolute','left':'50%','top':'50%','-webkit-transform':'translate(-50%, -50%)','transform':'translate(-50%, -50%)'})
            .html('<b><center>Please select a category and service to see description.</center></b>');
    }

    defaultDescription();

    function clearAll(){
        $('#Link').val('');
        $('#Quantity').val('');
        $('#Charge').val('');
        $("#serviceMax").addClass("hidden");
        $("#serviceMin").addClass("hidden");
        $("#refill").html("");
        $("#starttime").html("");
        $("#speed").html("");
        $("#description").html("");
        $("#serviceDescription").html("");
    }

    $(function(){

        $("#Categories").on("change", function(){
            clearAll();
            defaultDescription();
            var $target = $("#Services").val(""),
                category = $(this).val();

            $target
                .toggleClass("hidden", category === "")
                .find("option:gt(0)").addClass("hidden")
                .siblings().filter("[data-category="+category+"]").removeClass("hidden");

            $("#Services").val($("#Services option:first").val());
        });

        $("#Services").on("change", function(){
            clearAll();
            var serviceCategory = $(this).find(':selected').data('category');
            var serviceMin = $(this).find(':selected').data('min');
            var serviceMax = $(this).find(':selected').data('max');
            var serviceId = $(this).find(':selected').data('serviceid');

            $("#serviceMin").html("<b>MIN: " + serviceMin + "</b>").removeClass("hidden");
            $("#serviceMax").html("<b>MAX: " + serviceMax + "</b>").removeClass("hidden");

            $("#Link").attr({
                required: true,
                minlength:1,
                maxlength:5000
            });

            $("#Quantity").attr({
                required: true,
                min:serviceMin,
                max:serviceMax
            });

            var refill = (servicesList.find(x => x.id == serviceId).refill).length > 1 ? servicesList.find(x => x.id == serviceId).refill : 'No DATA';
            var starttime = (servicesList.find(x => x.id == serviceId).starttime).length > 1 ? servicesList.find(x => x.id == serviceId).starttime : 'No DATA';
            var speed = (servicesList.find(x => x.id == serviceId).speed).length > 1 ? servicesList.find(x => x.id == serviceId).speed : 'No DATA';
            var description = (servicesList.find(x => x.id == serviceId).description).length > 1 ? servicesList.find(x => x.id == serviceId).description : 'No DATA';

            $("#serviceDescription").html("").removeAttr("style");
            $("#refill").html('<div class="me-2"> <a class="text-muted d-block mb-1">Refill & Guarantee</a> <h5 class="mb-0">' + refill +'</h5></div>');
            $("#starttime").html('<div class="me-2"> <a class="text-muted d-block mb-1">Start Time</a> <h5 class="mb-0">' + starttime +'</h5></div>');
            $("#speed").html('<div class="me-2"> <a class="text-muted d-block mb-1">Speed</a> <h5 class="mb-0">' + speed +'</h5></div>');
            $("#description").html('<div class="me-2"> <a class="text-muted d-block mb-1">Service Description</a> <h5 class="mb-0">' + description +'</h5></div>');

        });

        $('#Quantity').on('input', function() {
            var servicePrice = $('#Services').find(':selected').data('price');
            var total = ($('#Quantity').val() / 1000) * servicePrice;
            $('#Charge').val("{{$configsArray['currency_symbol']}}" + total.toFixed(4));
        });
    });
</script>
@endsection
