@extends('adminView.layout')

@section('content')
@if ($message = Session::get('success'))
    
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success - </strong> {!! $message !!}
    </div>
@endif

{{-- <x-cek-status-laundry></x-cek-status-laundry> --}}

<div class="card-group">
    <div class="card border-right">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <div class="d-inline-flex align-items-center">
                        <h2 class="text-dark mb-1 font-weight-medium">{{ $totalPelanggan }} </h2>
                        {{-- <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+18.33%</span> --}}
                    </div>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Pelanggan</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-right">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                        <sup class="set-doller">$ </sup>{{ number_format($totalPendapatan) }}</h2>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Pendapatan
                    </h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-right">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <div class="d-inline-flex align-items-center">
                        <h2 class="text-dark mb-1 font-weight-medium">{{ $totalTransaksi }}</h2>
                        {{-- <span
                            class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">-18.33%</span> --}}
                    </div>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Transaksi</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <h2 class="text-dark mb-1 font-weight-medium"> {{ $totalRating }} ( {{ number_format($averageRating, '2')  }} )</h2>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Rata - rata rating </h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i class="icon-star"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12 col-xl-4">
        <div class="card" style="height: 89%">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between ">
                    <h4 class="card-title">
                        Status Transaksi
                        
                    </h4>
                    <input type="month" value="<?=date('Y-m')?>" name="month" onchange="getSTByMonth()" id="month-donut" 
                        style=" 
                        border-top-style: hidden;
                        border-right-style: hidden;
                        border-left-style: hidden;
                        border-bottom-style: groove;"
                    >
                    
                </div>
                <div class="d-flex justify-content-center" >

                    <div id="loading-donut" class="spinner-border" style="width: 15rem; height: 15rem;display:none; margin:10%;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div id="morris-donut-chart"></div>
                <ul class="list-style-none mb-0">
                    <li>
                        <i class="fas fa-circle text-primary font-10 mr-2"></i>
                        <span class="text-muted">Total</span>
                        <span class="text-dark float-right font-weight-medium">{{ $totalByStatusTransaksi->sum('total_status')  }}</span>
                    </li>
                    {{-- <li class="mt-3">
                        <i class="fas fa-circle text-danger font-10 mr-2"></i>
                        <span class="text-muted">Referral Sales</span>
                        <span class="text-dark float-right font-weight-medium">$2108</span>
                    </li>
                    <li class="mt-3">
                        <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                        <span class="text-muted">Affiliate Sales</span>
                        <span class="text-dark float-right font-weight-medium">$1204</span>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
    
    
    <div class="col-lg-6 col-md-12 col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center" >

                    <div id="loading-bar" class="spinner-border" style="width: 15rem; height: 15rem;display:none; margin:10%;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between ">
                    <h4 class="card-title">Jumlah Transaksi Selesai</h4>    
                    <select onchange="getTSByYear()" id="select-year" class="form-control col-3" style="font-size: 18px;font-weight: 500" name="startyear">
                    <?php
                    for ($year = (int)date('Y'); 2020 <= $year; $year--): ?>
                        <option value="<?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                    </select>   
                    
                </div>
                
                <div id="morris-bar-chart"></div>
            </div>
        </div>
    </div>
</div>
<!-- *************************************************************** -->
<!-- End First Cards -->
<!-- *************************************************************** -->
<!-- Start Top Leader Table -->
<!-- *************************************************************** -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="card-title">Profile <b class="font-weight-bold text-info"> "{{ session()->get('nama') }}" </b></h2>
                    <div class="ml-auto">
                        
                        <div class="menu-right" >
                            <a href="{{ route('pengusaha.edit-profil', $getUser->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                                Edit Profile
                            </a>   
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-8">
                        <div class="image-pengusaha">
                            <img style="width:100%; max-height:500px;object-fit:cover;object-position:top" src="{{'gambar_pengusaha/'.$getUser->gambar}}" alt="">
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="profile-pengusaha">
                            <div class="head-profile" >
                                <h3 class="">Data - {{session()->get('nama') }}</h3>
                                
                            </div>
                            {{-- <ul class="list-style-none">
                                <li><i class="ti-angle-right"></i> Nama Laundry :</li>
                                <li><i class="ti-angle-right"></i> No Telepon   : </li>
                                <li><i class="ti-angle-right"></i> Email        : </li>
                                <li><i class="ti-angle-right"></i> Alamat        : </li>
                                <li><i class="ti-angle-right"></i> Deskripsi        : </li>
                            </ul> --}}
                            <dl>
                                <dt>Nama Laundry : </dt>
                                <dd>{{ $getUser->nama }}</dd>
                                <dt>Email :</dt>
                                <dd>{{ $getUser->email }}</dd>
                                <dt>Nomor Telepon :</dt>
                                <dd>{{ $getUser->no_telp }}</dd>
                                <dt>Alamat :</dt>
                                <dd>{{ $getUser->alamat }}</dd>
                                <dt>Deskripsi :</dt>
                                <dd>{{ $getUser->deskripsi }}</dd>
                                <dt>Status Laundry :</dt>
                                <dd>{{ $getUser->status }}</dd>
                            </dl>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- *************************************************************** -->

@endsection
@push('dashboard')
    <script>
        initMorrisDonutChart();
        initMorrisBar();
        function getTanggal (){
            let getMonth = $("#month-donut").val();
            console.log('getMonth', getMonth);
        }
        function initMorrisDonutChart(){
            morrisDounut = Morris.Donut({
                element: "morris-donut-chart",
                data: [
                        @foreach ($totalByStatusTransaksi as $item)
                        
                            {
                                label: '{{ $item->nama }}',
                                value: {{ $item->total_status }},
                            },
                           
                        @endforeach
                    ],
                resize: true,
                colors: [
                                "#3b5d78", 
                                "#5f76e8", 
                                "#ff4f70", 
                                "#01caf1",
                                "#61cd93",
                                "#e2e750"
                            ],
            });
        }

        function initMorrisBar(){
            morrisBar = Morris.Bar({
                element: "morris-bar-chart",
                data: {!! json_encode($getByMonth) !!},
                xkey: "y",
                ykeys: ["jumlah"],
                labels: ["jumlah"],
                barColors: ["#01caf1", "#5f76e8"],
                hideHover: "auto",
                gridLineColor: "#eef0f2",
                resize: true,
            });
        }

        function getTSByYear(){
            let getYear = $("#select-year").val();
            let loadingBar = $("#loading-bar");
            let morrisBarChart = $("#morris-bar-chart");
            loadingBar.show();
            morrisBarChart.hide()

            $.ajax({
                type:"POST",
                url: "{{ route('ajax.ts-byyear') }}",
                data: {_token:`{{ csrf_token() }}`, year: getYear },
                dataType: 'json',
                success: function(res){
                    alert("Success");
                    console.log('data', res.data);
                    loadingBar.hide();
                    morrisBarChart.show();

                    morrisBar.setData(res.data)

                    // let newData = []
                    // res.data.map((v) => {
                    //     newData = [...newData, {
                    //         label: v.nama,
                    //         value: v.total_status
                    //     }]    
                    // });

                    // morrisBar.setData(newData);
                }
            });
            console.log('getMonth', getYear);
        }

        function getSTByMonth(){
            let getMonth = $("#month-donut").val();
            let loadingDonut = $("#loading-donut");
            let morrisChart = $("#morris-donut-chart");
            loadingDonut.show();
            morrisChart.hide()

            $.ajax({
                type:"POST",
                url: "{{ route('ajax.st-bymonth') }}",
                data: {_token:`{{ csrf_token() }}`, month: getMonth },
                dataType: 'json',
                success: function(res){
                    alert("Success");
                    console.log('data', res.data);
                    loadingDonut.hide();
                    morrisChart.show();


                    let newData = []
                    res.data.map((v) => {
                        newData = [...newData, {
                            label: v.nama,
                            value: v.total_status
                        }]    
                    });

                    morrisDounut.setData(newData);
                }
            });
            console.log('getMonth', getMonth);
        }
        $(function() {
            "use strict";
            // Morris.Donut({
            //     element: "morris-donut-chart",
            //     data: [
            //             @foreach ($totalByStatusTransaksi as $item)
                        
            //                 {
            //                     label: '{{ $item->nama }}',
            //                     value: {{ $item->total_status }},
            //                 },
                           
            //             @endforeach
            //         ],
            //     // data: [
            //     //     {
            //     //         label: "Download Sales",
            //     //         value: 1,
            //     //     },
            //     //     {
            //     //         label: "In-Store Sales",
            //     //         value: 2,
            //     //     },
            //     //     {
            //     //         label: "Mail-Order Sales",
            //     //         value: 5,
            //     //     },
            //     // ],
            //     resize: true,
            //     colors: [
            //                     "#3b5d78", 
            //                     "#5f76e8", 
            //                     "#ff4f70", 
            //                     "#01caf1",
            //                     "#61cd93",
            //                     "#e2e750"
            //                 ],
            // });
            // Morris.Bar({
            //     element: "morris-bar-chart",
            //     data: {!! json_encode($getByMonth) !!},
            //     xkey: "y",
            //     ykeys: ["jumlah"],
            //     labels: ["jumlah"],
            //     barColors: ["#01caf1", "#5f76e8"],
            //     hideHover: "auto",
            //     gridLineColor: "#eef0f2",
            //     resize: true,
            // });
        })
    </script>
    {{-- <script src="{{asset ('js/dashboardPelanggan.js')}}"></script> --}}
    {{-- <script>
        $(function () {
            // ==============================================================
            // Campaign
            // ==============================================================

            var chart1 = c3.generate({
                bindto: "#campaign-v2",
                data: {
                    columns: {!! json_encode($totalByStatusTransaksi) !!},

                    type: "donut",
                    tooltip: {
                        show: true,

                    },
                },
                donut: {
                    label: {
                        show: true,
                    },
                    title: "Penjualan",
                    width: 44,
                },

                legend: {
                    hide: true,
                },
                color: {
                    pattern: [
                                "#3b5d78", 
                                "#5f76e8", 
                                "#ff4f70", 
                                "#01caf1",
                                "#61cd93",
                                "#e2e750"
                            ],
                },
            });

            d3.select("#campaign-v2 .c3-chart-arcs-title").style(
                "font-family",
                "Rubik"
            );

            // ==============================================================
            // income
            // ==============================================================
            var data = {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                series: [[5, 4, 3, 7, 5, 10]],
            };

            var options = {
                axisX: {
                    showGrid: false,
                },
                seriesBarDistance: 1,
                chartPadding: {
                    top: 15,
                    right: 15,
                    bottom: 5,
                    left: 0,
                },
                plugins: [Chartist.plugins.tooltip()],
                width: "100%",
            };

            var responsiveOptions = [
                [
                    "screen and (max-width: 640px)",
                    {
                        seriesBarDistance: 5,
                        axisX: {
                            labelInterpolationFnc: function (value) {
                                return value[0];
                            },
                        },
                    },
                ],
            ];
            new Chartist.Bar(".net-income", data, options, responsiveOptions);

            // ==============================================================
            // Visit By Location
            // ==============================================================
            jQuery("#visitbylocate").vectorMap({
                map: "world_mill_en",
                backgroundColor: "transparent",
                borderColor: "#000",
                borderOpacity: 0,
                borderWidth: 0,
                zoomOnScroll: false,
                color: "#d5dce5",
                regionStyle: {
                    initial: {
                        fill: "#d5dce5",
                        "stroke-width": 1,
                        stroke: "rgba(255, 255, 255, 0.5)",
                    },
                },
                enableZoom: true,
                hoverColor: "#bdc9d7",
                hoverOpacity: null,
                normalizeFunction: "linear",
                scaleColors: ["#d5dce5", "#d5dce5"],
                selectedColor: "#bdc9d7",
                selectedRegions: [],
                showTooltip: true,
                onRegionClick: function (element, code, region) {
                    var message =
                        'You clicked "' +
                        region +
                        '" which has the code: ' +
                        code.toUpperCase();
                    alert(message);
                },
            });

            // ==============================================================
            // Earning Stastics Chart
            // ==============================================================
            var chart = new Chartist.Line(
                ".stats",
                {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    series: [[11, 10, 15, 21, 14, 23, 12]],
                },
                {
                    low: 0,
                    high: 28,
                    showArea: true,
                    fullWidth: true,
                    plugins: [Chartist.plugins.tooltip()],
                    axisY: {
                        onlyInteger: true,
                        scaleMinSpace: 40,
                        offset: 20,
                        labelInterpolationFnc: function (value) {
                            return value / 1 + "k";
                        },
                    },
                }
            );

            // Offset x1 a tiny amount so that the straight stroke gets a bounding box
            chart.on("draw", function (ctx) {
                if (ctx.type === "area") {
                    ctx.element.attr({
                        x1: ctx.x1 + 0.001,
                    });
                }
            });

            // Create the gradient definition on created event (always after chart re-render)
            chart.on("created", function (ctx) {
                var defs = ctx.svg.elem("defs");
                defs.elem("linearGradient", {
                    id: "gradient",
                    x1: 0,
                    y1: 1,
                    x2: 0,
                    y2: 0,
                })
                    .elem("stop", {
                        offset: 0,
                        "stop-color": "rgba(255, 255, 255, 1)",
                    })
                    .parent()
                    .elem("stop", {
                        offset: 1,
                        "stop-color": "rgba(80, 153, 255, 1)",
                    });
            });

            $(window).on("resize", function () {
                chart.update();
            });
        });

    </script> --}}
@endpush