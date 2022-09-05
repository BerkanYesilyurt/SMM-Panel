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
                                <h3 class="card-title mb-2">$0</h3>
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

                                <div class="mt-2 mb-3">
                                    <label for="Categories" class="form-label">Categories</label>
                                    <select id="Categories" class="form-select form-select-lg">
                                        <option>Select</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="Services" class="form-label">Services</label>
                                    <select id="Services" class="form-select form-select-lg">
                                        <option>Select</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="Link" class="form-label">Link</label>
                                    <input id="Link" class="form-control form-control-lg" type="text" placeholder="Link">
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="Quantity" class="form-label">Quantity</label>
                                    <input id="Quantity" class="form-control form-control-lg" type="text" placeholder="Quantity">
                                    <div class="form-text" style="padding-top: 8px;"><span class="badge bg-success" style="font-size:1em;"><b>Min: 100</b></span> - <span class="badge bg-danger" style="font-size:1em;"><b>Max: 500</b></span></div>
                                </div>

                                <div class="mt-2 mb-3">
                                    <label for="Charge" class="form-label">Charge</label>
                                    <input id="Charge" class="form-control form-control-lg" type="text" readonly>
                                </div>

                                <div class="mt-2 mb-3">
                                <button class="btn btn-primary btn-lg" type="button" style="width: 100%;">SUBMIT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </div>

@endsection
