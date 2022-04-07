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
                        <form method="post" action="{{ route('pengusaha.update', $getData->id) }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Pengusaha</label>
                                            <input type="text" name="nama" class="form-control"  id="nama" value="{{$getData->nama}}"
                                                    aria-describedby="name">
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea placeholder="Ketikan Alamat Lengkap Usaha Anda..." name="alamat" id="" cols="30" rows="10" class="form-control">{{$getData->alamat}}
                                            </textarea>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="latitude">Latitude</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="latitude">Lat</label>
                                                </div>
                                                <input type="number" name="latitude" class="form-control" value="{{$getData->latitude}}"  id="latitude"
                                                    aria-describedby="latitude">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="longitude">Longitude</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="longitude">Long</label>
                                                </div>
                                                <input type="number" name="longitude" class="form-control" value="{{$getData->longitude}}" name="longitude"  id="longitude"
                                                    aria-describedby="longitude">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="no_telp">+62</label>
                                                </div>
                                                <input type="number" name="no_telp" class="form-control" value="{{$getData->no_telp}}" id="no_telp"
                                                    aria-describedby="no_telp">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" name="email" value="{{$getData->email}}"  id="email"
                                                    aria-describedby="email">
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="password">Kata Sandi</label>
                                            <input type="password" name="password" class="form-control" value=""  id="password"
                                                    aria-describedby="password">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" name="gambar" class="form-control" value="{{$getData->gambar}}" id="gambar"
                                                aria-describedby="name">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea rows="5" name="deskripsi" class="form-control"  id="deskripsi"
                                                aria-describedby="name">{{$getData->deskripsi}}</textarea>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option selected disabled>Pilih Status Pengusaha</option>
                                                @if ($getData->status == 'Aktif')
                                                    <option value="Aktif" selected>Aktif</option>
                                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                                @else
                                                    <option value="Aktif" >Aktif</option>
                                                    <option value="Tidak Aktif" selected>Tidak Aktif</option>
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