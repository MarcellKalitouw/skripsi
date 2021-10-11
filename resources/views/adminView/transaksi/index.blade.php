@extends('adminView.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">Tabel Transaksi -
                    <a href="{{route('transaksi.create')}}" class="btn waves-effect waves-light btn-success">+
                        Tambah Data</a>
                </h4>

                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap " style="text-align: center">
                        <thead>
                            <tr >
                                <th>Opsi</th>
                                <th>No</th>
                                <th>Tanggal Transaksi</th>
                                <th>Status Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Pengusaha</th>
                                <th>ID Pengiriman</th>
                                <th>Total Kuantiti</th>
                                <th>Sub Total Kuantiti</th>
                                <th>Pajak</th>
                                <th>Diskon</th>
                                <th>Biaya Tambahan</th>
                                <th>Biaya Pengiriman</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Deleted At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                                $no = 0;
                                            ?>
                            @foreach ($data as $item)

                            <tr>
                                <td>
                                    <form action="{{route('transaksi.destroy', $item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a  href="{{route('transaksi.edit', $item->id)}}" 
                                            data-toggle="tooltip" title="Ubah Data"
                                            type="button" class="btn waves-effect waves-light btn-warning"
                                        >
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button type="submit" class="btn waves-effect waves-light btn-danger" data-toggle="tooltip" title="Hapus Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>{{$no+=1}}</td>
                                <td>{{$item->tgl}}</td>
                                <td>{{$item->id_status}}</td>
                                <td>{{$item->id_pelanggan}}</td>
                                <td>{{$item->id_pengusaha}}</td>
                                <td>{{$item->id_shipping}}</td>
                                <td>{{$item->total_qty}}</td>
                                <td>{{$item->subtotal_qty}}</td>
                                <td>{{$item->pajak}}</td>
                                <td>{{$item->diskon}}</td>
                                <td>{{$item->biaya_tambahan}}</td>
                                <td>{{$item->biaya_pengiriman}}</td>
                                <td>{{$item->total}}</td>
                                <td>{{$item->keterangan}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>{{$item->deleted_at}}</td>
                            </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                               <th>Opsi</th>
                                <th>No</th>
                                <th>Tanggal Transaksi</th>
                                <th>Status Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Pengusaha</th>
                                <th>ID Pengiriman</th>
                                <th>Total Kuantiti</th>
                                <th>Sub Total Kuantiti</th>
                                <th>Pajak</th>
                                <th>Diskon</th>
                                <th>Biaya Tambahan</th>
                                <th>Biaya Pengiriman</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Deleted At</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
