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
    {{-- <div class="col-lg-6 col-md-12 col-xl-4">
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
                   
                </ul>
            </div>
        </div>
    </div> --}}
    
    
    
    <div class="col-lg-6 col-md-12 col-xl-12">
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
<div class="row">
    {{-- <div class="col-md-6 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <h4 class="card-title mb-0">Statistik Pendapatan</h4>
                    
                </div>
                <div class="pl-4 mb-5">
                    <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                </div>
                <ul class="list-inline text-center mt-4 mb-0">
                    <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                </ul>
            </div>
        </div>
    </div> --}}
    <div class="col-md-6 col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Statistik Pendapatan</h4>
                <div id="morris-line-chart"></div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Recent Activity</h4>
                <div class="mt-4 activity">
                    <div class="d-flex align-items-start border-left-line pb-3">
                        <div>
                            <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                <i data-feather="shopping-cart"></i>
                            </a>
                        </div>
                        <div class="ml-3 mt-2">
                            <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                            <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                Camera.
                            </p>
                            <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-start border-left-line pb-3">
                        <div>
                            <a href="javascript:void(0)"
                                class="btn btn-danger btn-circle mb-2 btn-item">
                                <i data-feather="message-square"></i>
                            </a>
                        </div>
                        <div class="ml-3 mt-2">
                            <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                            <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                ticket</p>
                            <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-start border-left-line">
                        <div>
                            <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                <i data-feather="bell"></i>
                            </a>
                        </div>
                        <div class="ml-3 mt-2">
                            <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                            </h5>
                            <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                            <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                Ago</span>
                            <a href="javascript:void(0)" class="font-14 border-bottom pb-1 border-info">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<!-- *************************************************************** -->
<!-- End First Cards -->
<!-- *************************************************************** -->
<!-- Start Top Leader Table -->
<!-- *************************************************************** -->

<!-- *************************************************************** -->

@endsection


@push('dashboard')
    <script>
        // initMorrisDonutChart();
        initMorrisBar();
        initMorisLine();
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
        function initMorisLine(){
            // LINE CHART
            let newLineArray = {!! json_encode($totalTransaksiByMonth) !!}.map((d) => ({date: d.yM, item: `${d.jumlah}K`}));
            console.log('newLine', newLineArray);
            var line = new Morris.Line({
                element: "morris-line-chart",
                resize: true,
                data:newLineArray,
                xkey: "date",
                ykeys: ["item"],
                labels: ["Total Transaksi"],
                gridLineColor: "#eef0f2",
                lineColors: ["#5f76e8"],
                lineWidth: 1,
                hideHover: "auto",
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
                url: "{{ route('ajax.admin-ts-byyear') }}",
                data: {_token:`{{ csrf_token() }}`, year: getYear },
                dataType: 'json',
                success: function(res){
                    // alert("Success");
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
                    // alert("Success");    
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

        function handleArrayMonth () {
            arrayMonth = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Ags", "Sept",'Okt','Nov','Des'];
            console.log(array_merge(arrayMonth, {!! json_encode($getByMonth) !!}));
        }
        $(function () {
          const seriesM = {!! json_encode($totalTransaksiByMonth) !!}.map((d) => d.jumlah)
          console.log('seriesM',seriesM);
          var t = new Chartist.Line(
            ".stats",
            {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Ags", "Sept",'Okt','Nov','Des'],
                series: [[11, 10, 15, 21, 14, 23, 12]],
                // labels:{!!json_encode($totalTransaksiByMonth)!!}.map((d) => d.m) ,
                // series: [seriesM],
            },
            {
                low: 0,
                high: 28,
                showArea: !0,
                fullWidth: !0,
                plugins: [Chartist.plugins.tooltip()],
                axisY: {
                    onlyInteger: !0,
                    scaleMinSpace: 40,
                    offset: 20,
                    labelInterpolationFnc: function (e) {
                        return e / 1 + "k";
                    },
                },
            }
        );
        t.on("draw", function (e) {
            "area" === e.type && e.element.attr({ x1: e.x1 + 0.001 });
        }),
        t.on("created", function (e) {
            e.svg
                .elem("defs")
                .elem("linearGradient", {
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
        }),
        $(window).on("resize", function () {
            t.update();
        });
    })

        
    </script>
@endpush