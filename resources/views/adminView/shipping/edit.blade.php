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
                        <form method="post" action="{{ route('shipping.update', $getData->id) }}" enctype="multipart/form-datab" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="id_transaksi">ID Transaksi</label>
                                            <select name="id_transaksi" class="form-control" id="id_transaksi">
                                                <option selected disabled>Pilih ID Transaksi</option>
                                                @foreach ($getTransaksi as $item)
                                                    @if ($item->id == $getData->id_transaksi)
                                                        <option selected value="{{$item->id}}">{{$item->nama}}</option>
                                                        
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="pengusaha">Pengusaha</label>
                                            <select class="form-control" name="id_pengusaha" id="pengusaha">
                                                <option selected disabled>Pilih Pengusaha</option>
                                                @foreach ($getPengusaha as $item)
                                                    @if ($item->id == $getData->id_pengusaha)
                                                        <option selected value="{{$item->id}}">{{$item->nama}}</option>
                                                        
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endif
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="id_user">Pengguna</label>
                                            <select class="form-control" name="id_user" id="id_user">
                                                <option selected disabled>Pilih Pengguna</option>
                                                @foreach ($getUser as $item)
                                                    @if ($item->id == $getData->id_user)
                                                        <option selected value="{{$item->id}}">{{$item->name}}</option>
                                                        
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Kurir</label>
                                            <div class="input-group">
                                                {{-- <div class="input-group-prepend">
                                                    <label class="input-group-text" for="nama_kurir"></label>
                                                </div> --}}
                                                <input type="text" name="nama_kurir" value="{{$getData->nama_kurir}}" class="form-control"  id="nama_kurir"
                                                    aria-describedby="name_kurir">
                                            </div>

                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="alamat_jemput">Alamat Jemput</label>
                                            <textarea rows="5" name="alamat_jemput" class="form-control" id="alamat_jemput"
                                                aria-describedby="alamat_jemput">{{$getData->alamat_jemput}}"</textarea>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="geocoding_jemput">Geocoding Jemput</label>
                                            <div class="input-group">
                                                
                                                <input type="number" name="geocoding_jemput" value="{{$getData->geocoding_jemput}}" class="form-control"  id="geocoding_jemput"
                                                    aria-describedby="geocoding_jemput">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="alamat_antar">Alamat Antar</label>
                                            <textarea rows="5" name="alamat_antar" class="form-control" id="alamat_antar"
                                                aria-describedby="alamat_antar">{{$getData->alamat_antar}}"</textarea>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="geocoding_antar">Geocoding Antar</label>
                                            <div class="input-group">
                                                
                                                <input type="number" name="geocoding_antar" value="{{$getData->geocoding_antar}}" class="form-control"  id="geocoding_antar"
                                                    aria-describedby="geocoding_antar">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" name="gambar" class="form-control" id="gambar"
                                                aria-describedby="name">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea rows="5" name="deskripsi" class="form-control" id="deskripsi"
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