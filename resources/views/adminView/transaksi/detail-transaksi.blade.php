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
                        <p>{{ $item->keterangan }}</p>
                        <p class="card-text" style="
                            display: -webkit-box;
                            overflow: hidden;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                        ">
                        <p style="margin-bottom: 2px; font-weight: 500">Alamat : </p> 
                        <p class="card-text" style="
                            display: -webkit-box;
                            overflow: hidden;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                        ">
                        @if ($alamat_transaksi !== null)
                            {{$alamat_transaksi->alamat}}
                            <div class="col-12 " style="margin-bottom: 25px">
                                <label for="">Pin Location</label>
                                <div id="here-maps">
                                    <div id="mapContainer" style="height:500px"></div>
                                </div>
                                
                                <input type="hidden" name="lat" value="{{ $alamat_transaksi->lat }}" readonly class="form-control"  id="lat"
                                    aria-describedby="lat">
                            
                        
                                <input type="hidden" name="long" value="{{ $alamat_transaksi->long }}" readonly class="form-control"  id="lng"
                                    aria-describedby="lng">
                                
                            </div>
                        @else
                        -
                        @endif
                        
                        </p>
                        
                        <div style="border-bottom: 1px solid; display:flex; justify-content: space-between;margin-bottom:1rem">
                                <p class="" style="margin: 2px;font-weight: 500">Rincian Pesanan</p>
                        </div>
                        
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead >
                                    
                                    <tr class="bg-success text-white" style="position: -webkit-sticky; 
                                        position: sticky;
                                        top: 0;">
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Kuantiti</th>
                                        <th>Diskon</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0 ?>
                                    @forelse ($detailTransaksi as $dt)
                                        <tr>
                                            <td>
                                                {{ $no +=1 }}
                                            </td>
                                            <td>{{ $dt->nama_produk }}</td>
                                            <td>Rp.{{ $dt->harga }}</td>
                                            <td>{{ $dt->qty }}</td>
                                            <td>Rp.{{ $dt->diskon }}</td>
                                            <td>Rp.{{ $dt->total }}</td>
                                            
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6">Pesanan belum ada</td>
                                        </tr>
                                    @endforelse
                                    
                                    
                                        
                                </tbody>
                                <tfoot >
                                    <tr class="bg-success text-white" style="position: -webkit-sticky; 
                                        position: sticky;
                                        bottom: 0;">
                                        <th colspan="2" class="text-center">TOTAL</th>
                                        <th>Rp.{{ number_format($totalDetailTransaksi->total_harga) }}</th>
                                        <th>{{ $totalDetailTransaksi->qty_total }}</th>
                                        <th>Rp.{{ number_format($totalDetailTransaksi->total_diskon)  }}</th>
                                        <th>Rp.{{ number_format($totalDetailTransaksi->grand_total)  }}</th>
                                    </tr>
                                    
                                </tfoot>
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
        window.action = "show"
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