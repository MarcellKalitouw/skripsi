@extends('adminView.layout')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Tambah {{$pageTitle}}</h4>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <h3>Form Tambah {{$pageTitle}}</h3>
                        <hr>
                        <form method="post" action="{{ route('kurir.store') }}" enctype="multipart/form-data" id="myForm">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        
                                        @if (session()->get('tipe') == 'Pengusaha')
                                            <input type="hidden" name="id_pengusaha" value="{{session()->get('id')}}">
                                        @else
                                            <div class="col-12 form-group">
                                                <label for="pengusaha">Pengusaha</label>
                                                <select class="form-control" name="id_pengusaha" id="pengusaha">
                                                    <option selected disabled>Pilih Pengusaha</option>
                                                    @foreach ($getPengusaha as $item)
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>    
                                        @endif
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Kurir</label>
                                            <input type="text" name="nama_kurir" class="form-control" id="nama"
                                                aria-describedby="name" required>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="password">Katasandi</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                aria-describedby="name" required>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="foto_kurir">Foto Kurir</label>
                                            <input type="file" name="foto_kurir" class="form-control" id="foto_kurir"
                                                aria-describedby="name" required>
                                        </div>
                                        
                                        <div class="col-6 form-group">
                                            <button type="submit" class="col-12 btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                                

                            </div>
                        </form>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif  
                    </div>
                    

                   
                </div>
            </div>
        </div>
    </div>
@endsection