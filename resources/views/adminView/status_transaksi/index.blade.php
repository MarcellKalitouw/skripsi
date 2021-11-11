@extends('adminView.layout')

@section('content')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tabel Status Transaksi
                                    <a href="{{route('status_transaksi.create')}}" class="btn waves-effect waves-light btn-success">
                                    + Tambah Data
                                    </a>

                                </h4>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Opsi</th>
                                                <th>No</th>
                                                <th>Nama Status</th>
                                                <th>Tipe</th>
                                                <th>ID Transaksi</th>
                                                <th>Pelanggan</th>
                                                <th>Pengusaha</th>
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
                                                         <form action="{{route('status_transaksi.destroy', $item->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a  href="{{route('status_transaksi.edit', $item->id)}}" 
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
                                                     <td>{{$item->nama}}</td>
                                                     <td>{{$item->tipe}}</td>
                                                     <td>{{$item->ID_TRANSAKSI}}</td>
                                                     <td>
                                                         <p><span style="font-weight: bold;" >ID</span> : {{$item->PELANGGAN}}</p>
                                                         <p><span style="font-weight: bold;">Nama</span> : {{$item->NAMA_PELANGGAN}}</p>
                                                     </td>
                                                     <td>
                                                         <p><span style="font-weight: bold;" >ID</span> : {{$item->PENGUSAHA}}</p>
                                                         <p><span style="font-weight: bold;">Nama</span> : {{$item->NAMA_PENGUSAHA}}</p>
                                                     </td>
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
                                                <th>Nama</th>
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
