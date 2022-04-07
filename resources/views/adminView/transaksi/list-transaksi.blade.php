@extends('adminView.layout')

@section('content')
    {{-- <x-cek-status-laundry></x-cek-status-laundry> --}}
    <div class="row">
        <div class="col-12 mt-4 mb-4">
            <h4 class="mb-0">Daftar Transaksi</h4>
            <x-alert> </x-alert>
            <h4 class="card-title">
                <a href="{{route('transaksi.create-pelanggan')}}" class="btn waves-effect waves-light btn-success">+
                    Tambah Data</a>
            </h4>
            <div class="row col-12">
                @foreach ($status as $item)
                    <button type="button" class="btn btn-outline-secondary btn-rounded">
                        <i class="fas fa-check"></i> 
                        {{ $item->nama }}
                    </button>
                @endforeach
                
            </div>
        </div>
        @foreach ($data as $item)
            <div class="col-md-4">
                <div class="card border-dark" >
                    <div class="card-header bg-dark">
                        <h4 class="mb-0 text-white">{{ $item->kode_transaksi }} </h4>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px">
                            <h3 class="card-title" style="margin:0">{{ $item->nama_pelanggan }}</h3>
                            <h3><span class="badge badge-success">status : {{ $item->nama_status }}</span></h3> 
                        </div>
                        <p class="card-text" style="
                            display: -webkit-box;
                            overflow: hidden;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            height:72px
                        ">
                        {{$item->keterangan}}
                        </p>
                        
                        <div style="border-bottom: 1px solid; display:flex; justify-content: space-between;margin-bottom:1rem">
                            <p class="" style="margin: 2px">Rincian Biaya Pesanan</p>
                            <p class="" style="margin:2px"> <i class="far fa-calendar-alt"></i> {{ date('d/M/Y ', strtotime($item->created_at)) }} - <i class="far fa-clock"></i> {{ date('h:i:s', strtotime($item->created_at)) }}</p>
                        </div>
                        <div style="display:flex; justify-content: space-between">
                            <div>
                                <p style="margin:0">Total Kuantiti</p>
                                <p style="margin:0">Pajak</p>
                                <p style="margin:0">Diskon</p>
                                <p style="margin:0">Biaya Tambahan</p>
                                <p style="margin:0">Biaya Pengiriman</p>
                                <p style="margin:0">Total Biaya</p>
                            </div>
                            <div>
                                <p style="margin:0">: {{ $item->total_qty }}</p>
                                <p style="margin:0">: {{ $item->pajak }}</p>
                                <p style="margin:0">: {{ $item->diskon }}</p>
                                <p style="margin:0">: Rp. {{ number_format($item->biaya_tambahan, 2) }}</p>
                                <p style="margin:0">: Rp. {{ number_format($item->biaya_pengiriman, 2) }}</p>
                                <p style="margin:0">: Rp. {{ number_format($item->total, 2)  }}</p>
                            </div>
                        </div>
                        <div style="text-align: right; margin-top: 10px">
                            <h4>
                                <a href="{{ route('transaksi.detail-transaksi',$item->id) }}" style="text-decoration: none;font-size: 16px" class="badge badge-light" style="text-decoration: underline">
                                
                                <i class="fas fa-search"></i>
                                lebih rinci
                                </a>
                            </h4>
                        </div>
                        <div style="width: 100%; margin-top: 20px"> 
                            {{-- <a  href="javascript:void(0)" class="btn btn-primary " style="width: 100%">Perbaharui Status Transaksi</a> --}}
                            <div class="btn-group" style="width: 100% ">
                                <button type="button"  class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Perbaharui Status Transaksi <i class="fas fa-arrow-down" style="margin-left:5%"></i>
                                </button>
                                <div class="dropdown-menu bg-dark text-white" style="width:100%">

                                    <a class="dropdown-item updateTransaksi" onclick="statusDiterimaDialog('{{ $item->id }}')" data-type="Diterima" href="javascript:void(0)">
                                       Diterima
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusDitolakDialog('{{ $item->id }}')"  data-type="Ditolak" href="javascript:void(0)">
                                       Ditolak
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusPenjemputanDialog('{{ $item->id }}')"  data-type="Penjemputan" href="javascript:void(0)">
                                       Penjemputan
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusProsesDialog('{{ $item->id }}')"  data-type="Diproses" href="javascript:void(0)">
                                       Diproses
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusProsesSelesaiDialog('{{ $item->id }}')"  data-type="ProsesSelesai" href="javascript:void(0)">
                                       Proses Selesai
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusPengantaranDialog('{{ $item->id }}')" data-type="Pengantaran" href="javascript:void(0)">
                                       Pengantaran
                                    </a>
                                    {{-- <a class="dropdown-item" href="javascript:void(0)">Something else
                                        here</a> --}}
                                    {{-- <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)">Separated
                                        link</a> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
    
@endsection

@push('script')
    <script>
        window.addEventListener('keydown', function (event) {
            if(event.shiftKey && event.key === 'A'){
                alert('succes keyboard');
            }
            if(event.shiftKey && event.key === 'B'){
                alert('succes keyboard B');
                // document.location.href = `../dashboard_pengusaha`;

            }
        })
    </script>
    <script>
        
        // function updateTransaksi(){

        //     const status = $('.updateTransaksi').data('type');
        //     console.log('status', status);
        //     if (status === 'Diterima'){
        //         statusDiterimaDialog();
        //     }else if(status === 'Ditolak'){
        //         statusDitolakDialog();
        //     }
        // }
        // const status = $('.updateTransaksi').data('type');
        

        async function statusDitolakDialog(id) {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Ditolak`,
                text: "Jika ya, klik tombol OK",
                icon: "error",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');
            // const id = $('.updateTransaksi').data('id');
            console.log('id', id);
            

            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    // document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Ditolak Laundry', 'tipe'=>'transaksi'])}}`;
                    document.location.href = `../update-transaksi/${id}/Ditolak Laundry/transaksi`;
                });
            }
        }
        async function statusDiterimaDialog(id) {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Diterima`,
                text: "Jika ya, klik tombol OK",
                icon: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');
            // const id = $('.updateTransaksi').data('id');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    // document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Diterima Laundry', 'tipe'=>'transaksi'])}}`;
                    document.location.href = `../update-transaksi/${id}/Diterima Laundry/transaksi`;

                });
            }
        }
        async function statusPenjemputanDialog(id) {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Penjemputan `,
                text: "Jika ya, klik tombol OK",
                icon: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');
            // const id = $('.updateTransaksi').data('id');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    // document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Penjemputan', 'tipe'=>'shipping'])}}`;
                    document.location.href = `../update-transaksi/${id}/Penjemputan/shipping`;

                });
            }
        }

        async function statusProsesDialog(id) {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Diproses`,
                text: "Jika ya, klik tombol OK",
                icon: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');
            // const id = $('.updateTransaksi').data('id');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    document.location.href = `../update-transaksi/${id}/Diproses/transaksi`;
                    // document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Diproses', 'tipe'=>'transaksi'])}}`;
                });
            }
        }
        async function statusProsesSelesaiDialog(id) {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Proses Selesai`,
                text: "Jika ya, klik tombol OK",
                icon: "success",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');
            // const id = $('.updateTransaksi').data('id');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    document.location.href = `../update-transaksi/${id}/Proses Selesai/transaksi`;

                    // document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Proses Selesai', 'tipe'=>'transaksi'])}}`;
                });
            }
        }
        async function statusPengantaranDialog(id) {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Pengantaran`,
                text: "Jika ya, klik tombol OK",
                icon: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');
            // const id = $('.updateTransaksi').data('id');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    document.location.href = `../update-transaksi/${id}/Pengantaran/shipping`;

                    // document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Pengantaran', 'tipe'=>'shipping'])}}`;
                });
            }
        }


    </script>
    <script>
        var a = document.getElementById('alert');

        setTimeout(() => {
            a.remove();
        }, 3000);
        console.log('a', a);
    </script>
@endpush