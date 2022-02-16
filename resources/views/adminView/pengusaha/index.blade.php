@extends('adminView.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">Tabel Pengusaha -
                    <a href="{{route('pengusaha.create')}}" class="btn waves-effect waves-light btn-success">+
                        Tambah Data</a> 
                </h4>
                @if ($message = Session::get('success'))
                    
                    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Success - </strong> {!! $message !!}
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap " style="text-align: center">
                        <thead>
                            <tr >
                                <th>Opsi</th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Gambar</th>
                                <th>Password</th>
                                <th>Deskripsi</th>
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
                                    <form action="{{route('pengusaha.destroy', $item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a  href="{{route('pengusaha.edit', $item->id)}}" 
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
                                <td>{{$item->alamat}}</td>
                                <td>{{$item->latitude}}</td>
                                <td>{{$item->longitude}}</td>
                                <td>{{$item->no_telp}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    @if (file_exists('gambar_pengusaha/'.$item->gambar))
                                        <img src="{{asset('/gambar_pengusaha/'.$item->gambar)}}" alt="" width="300px" height="300px" style="object-fit:contain;">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td>{{$item->password}}</td>
                                <td>{{$item->deskripsi}}</td>
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
                                <th>Alamat</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Gambar</th>
                                <th>Password</th>
                                <th>Deskripsi</th>
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
