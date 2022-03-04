@extends('adminView.layout')

@section('content')
    <div class="row">
        {{-- <div class="col-12 mt-4 mb-4">
            <h4 class="mb-0">Detail Transaksi</h4>
            
        </div> --}}
            <div class="col-md-12">
            <x-alert> </x-alert>
                <div class="card border-dark">
                    <div class="card-header bg-dark" style="display: flex;justify-content: space-between;">
                        <h3 class="text-white">Detail - Transaksi</h3>
                        <h4 class="mb-0 text-white">{{ $item->kode_transaksi }} </h4>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px">
                            <h3 class="card-title" style="margin:0">NAMA PELANGGAN : {{ $item->nama_pelanggan }}</h3>
                            <h3><span class="badge badge-success">status : {{ $item->nama_status }}</span></h3> 
                        </div>
                        <p style="margin-bottom: 2px; font-weight: 500">Keterangan : </p> 
                        <p class="card-text" style="
                            display: -webkit-box;
                            overflow: hidden;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                        ">
                         
                        {{$item->keterangan}}
                        </p>
                        <div style="border-bottom: 1px solid; display:flex; justify-content: space-between;margin-bottom:1rem">
                            <p class="" style="margin: 2px;font-weight: 500">Rincian Produk</p>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-inverse text-black">
                                    <tr>
                                        <th>#</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Kuantiti</th>
                                        <th>Diskon</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <tr>
                                        <td>1</td>
                                        <td>Nigam</td>
                                        <td>Eichmann</td>
                                        <td>@Sonu</td>
                                        <td>@Sonu</td>
                                        <td>@Sonu</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Nigam</td>
                                        <td>Eichmann</td>
                                        <td>@Sonu</td>
                                        <td>@Sonu</td>
                                        <td>@Sonu</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Nigam</td>
                                        <td>Eichmann</td>
                                        <td>@Sonu</td>
                                        <td>@Sonu</td>
                                        <td>@Sonu</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="border-bottom: 1px solid; display:flex; justify-content: space-between;margin-bottom:1rem">
                            <p class="" style="margin: 2px;font-weight: 500">Rincian Biaya Pesanan</p>
                            <p class="" style="margin:2px"> <i class="far fa-calendar-alt"></i> {{ date('d/M/Y ', strtotime($item->created_at)) }} - <i class="far fa-clock"></i> {{ date('h:i:s', strtotime($item->created_at)) }}</p>
                        </div>
                        <div class="col-md-6" style="display:flex; justify-content: space-between">
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
                        <div style="width: 100%; margin-top: 20px"> 
                            {{-- <a  href="javascript:void(0)" class="btn btn-primary " style="width: 100%">Perbaharui Status Transaksi</a> --}}
                            <div class="btn-group" style="width: 100% ">
                                <button type="button"  class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Perbaharui Status Transaksi <i class="fas fa-arrow-down" style="margin-left:5%"></i>
                                </button>
                                <div class="dropdown-menu bg-dark text-white" style="width:100%">

                                    <a class="dropdown-item updateTransaksi" onclick="statusDiterimaDialog()" data-type="Diterima" href="javascript:void(0)">
                                       Diterima
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusDitolakDialog()" data-type="Ditolak" href="javascript:void(0)">
                                       Ditolak
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusPenjemputanDialog()" data-type="Penjemputan" href="javascript:void(0)">
                                       Penjemputan
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusProsesDialog()" data-type="Diproses" href="javascript:void(0)">
                                       Diproses
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusProsesSelesaiDialog()" data-type="ProsesSelesai" href="javascript:void(0)">
                                       Proses Selesai
                                    </a>
                                    <a class="dropdown-item updateTransaksi" onclick="statusPengantaranDialog()" data-type="Pengantaran" href="javascript:void(0)">
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
    </div>
    
    
@endsection

@push('script')
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

        async function statusDitolakDialog() {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Ditolak`,
                text: "Jika ya, klik tombol OK",
                icon: "error",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Ditolak Laundry', 'tipe'=>'transaksi'])}}`;
                });
            }
        }
        async function statusDiterimaDialog() {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Diterima`,
                text: "Jika ya, klik tombol OK",
                icon: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Diterima Laundry', 'tipe'=>'transaksi'])}}`;
                });
            }
        }
        async function statusPenjemputanDialog() {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Penjemputan `,
                text: "Jika ya, klik tombol OK",
                icon: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Penjemputan', 'tipe'=>'shipping'])}}`;
                });
            }
        }

        async function statusProsesDialog() {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Diproses`,
                text: "Jika ya, klik tombol OK",
                icon: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Diproses', 'tipe'=>'transaksi'])}}`;
                });
            }
        }
        async function statusProsesSelesaiDialog() {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Proses Selesai`,
                text: "Jika ya, klik tombol OK",
                icon: "success",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Proses Selesai', 'tipe'=>'transaksi'])}}`;
                });
            }
        }
        async function statusPengantaranDialog() {
           const  {value :accept}  = await Swal.fire({
                title: `Apakah anda yakin mengganti status laporan ini ke Status Pengantaran`,
                text: "Jika ya, klik tombol OK",
                icon: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
            // const status = document.getElementsByClassName("updateTransaksi").data('type');

            
            if(accept){
                Swal.fire({
                    title:"Status Transaksi sedang diperbaharui",
                    timer: 1500,
                    showConfirmButton:false
                }).then(() => {
                    document.location.href = `{{route('transaksi.update-status',['id' => $item->id, 'status'=>'Pengantaran', 'tipe'=>'shipping'])}}`;
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