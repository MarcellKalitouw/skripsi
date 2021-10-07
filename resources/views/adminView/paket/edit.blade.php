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
                        <h3>Form Ubah {{$pageTitle}}</h3>
                        <hr>
                        <form method="post" action="{{ route('paket.update', $getData->id) }}" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Paket</label>
                                            <input type="text" name="nama" class="form-control" id="nama"
                                                aria-describedby="name" value="{{$getData->nama}}">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="harga">Harga</label>
                                            <input type="text" name="harga" class="form-control" id="harga"
                                                aria-describedby="name" value="{{$getData->harga}}">
                                        </div>
                                    
                                        <div class="col-12 form-group">
                                            <label for="gambar">File</label>
                                            <input type="file" name="gambar" class="form-control" id="gambar"
                                                aria-describedby="name" value="{{$getData->gambar}}">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" id="deskripsi"
                                                aria-describedby="name">{{$getData->deskripsi}}</textarea>
                                        </div>
                                        
                                        <div class="col-6 form-group">
                                            <button type="submit" class="col-3 btn btn-primary">Simpan</button>
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