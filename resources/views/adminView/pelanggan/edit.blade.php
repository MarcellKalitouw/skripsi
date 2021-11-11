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
                        <form method="post" action="{{ route('pelanggan.update', $getData->id) }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Pelanggan</label>
                                            <input type="text" name="nama" class="form-control" value="{{$getData->nama}}" id="nama"
                                                    aria-describedby="name">
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="no_telp">+62</label>
                                                </div>
                                                <input type="number" value="{{$getData->no_telp}}" name="no_telp" class="form-control"  id="no_telp"
                                                    aria-describedby="no_telp">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="email">Email</label>
                                            <input type="email" value="{{$getData->email}}" name="email" class="form-control"  id="email"
                                                    aria-describedby="email">
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="password">Kata Sandi</label>
                                            <input type="password" name="password" value="{{$getData->password}}" class="form-control"  id="password"
                                                    aria-describedby="password">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" name="gambar" class="form-control" id="gambar"
                                                aria-describedby="name">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option selected disabled>Pilih Status Pengguna</option>
                                                @if ($getData->status == 'Aktiv')
                                                    <option value="Aktiv" selected>Aktiv</option>
                                                    <option value="Tidak Aktiv">Tidak Aktiv</option>
                                                @else
                                                    <option value="Aktiv" >Aktiv</option>
                                                    <option value="Tidak Aktiv" selected>Tidak Aktiv</option>
                                                @endif
                                            </select>
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