@extends('adminView.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tabel Status
                        <a href="{{route('status.create')}}" class="btn waves-effect waves-light btn-success">
                        + Tambah Data
                        </a>

                    </h4>
                    
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengusaha</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Deskripsi</th>
                                    <th>Nilai</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 0;
                                ?>
                                @foreach ($data as $item)
                                    
                                        <tr>
                                            <td>{{$no+=1}}</td>
                                            <td>{{$item->nama_pengusaha}}</td>
                                            <td>{{$item->nama_pelanggan}}</td>
                                            <td>{{$item->deskripsi}}</td>
                                            <td>{{$item->nilai}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>{{$item->updated_at}}</td>
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
