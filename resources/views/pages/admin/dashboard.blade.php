@extends('pages.admin.layout')
@section('subTitle', 'Dashboard')
@section('content')
    <script src='https://cdn.plot.ly/plotly-2.14.0.min.js'></script>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 col-md-4 order-1">
                    <div class="row">

                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="fw-semibold d-block mb-1">Users:</span>
                                    <h3 class="card-title mb-2">{{$count['users']}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="fw-semibold d-block mb-1">Orders:</span>
                                    <h3 class="card-title mb-2">{{$count['orders']}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="fw-semibold d-block mb-1">Total Revenue:</span>
                                    <h3 class="card-title mb-2">{{$config['currency_symbol']}}{{number_format($count['revenue']['total'],2,",",".")}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="fw-semibold d-block mb-1">Announcements:</span>
                                    <h3 class="card-title mb-2">{{$count['announcements']}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="fw-semibold d-block mb-1">Tickets:</span>
                                    <h3 class="card-title mb-2">{{$count['tickets']}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="fw-semibold d-block mb-1">Open Tickets:</span>
                                    <h3 class="card-title mb-2">{{$count['opentickets']}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="fw-semibold d-block mb-1">Categories:</span>
                                    <h3 class="card-title mb-2">{{$count['categories']}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="fw-semibold d-block mb-1">Services:</span>
                                    <h3 class="card-title mb-2">{{$count['services']}}</h3>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div id='myDiv'></div>
            <script>
                var trace1 = {
                    x: [@foreach ($count['numberofusers'] as $key => $value)
                            '{{ $key }}',
                        @endforeach],
                    y: [@foreach ($count['numberofusers'] as $key => $value)
                        '{{ $value }}',
                        @endforeach],
                    type: 'bar',
                    name: 'Users',
                    marker: {
                        color: 'rgb(49,130,189)',
                        opacity: 0.9,
                    }
                };

                var trace2 = {
                    x: [@foreach ($count['numberoforders'] as $key => $value)
                        '{{ $key }}',
                        @endforeach],
                    y: [@foreach ($count['numberoforders'] as $key => $value)
                        '{{ $value }}',
                        @endforeach],
                    type: 'bar',
                    name: 'Orders',
                    marker: {
                        color: 'rgb(204,204,204)',
                        opacity: 0.8
                    }
                };

                var data = [trace1, trace2];

                var layout = {
                    title: 'User & Order Statistics (Last 1 Year)',
                    xaxis: {
                        tickangle: -45
                    },
                    barmode: 'group'
                };

                Plotly.newPlot('myDiv', data, layout);

            </script>
        </div>
    </div>
@endsection
