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
                        <form method="post" action="{{ route('produk.update', $getData->id) }}" enctype="multipart/form-datab" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="pengusaha">Pengusaha</label>
                                            <select class="form-control" name="id_pengusaha" id="pengusaha">
                                                <option selected disabled>Pilih Pengusaha</option>
                                                @foreach ($getPengusaha as $item)
                                                    @if ($item->id == $getData->id_pengusaha)
                                                        <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>

                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Produk</label>
                                            <input type="text" name="nama" class="form-control"  id="nama" value="{{$getData->nama}}"
                                                    aria-describedby="name">
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="satuan">Satuan Produk</label>
                                            <select name="id_satuan" class="form-control" id="satuan">
                                                <option selected disabled>Pilih Satuan Produk</option>
                                                @foreach ($getSatuanProduk as $item)
                                                    @if ($item->id == $getData->id_satuan)
                                                        <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>

                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="kategori_produk">Kategori Produk</label>
                                            <select class="form-control" name="id_kategori" id="kategori_produk">
                                                <option selected disabled>Pilih Kategori Produk</option>
                                                @foreach ($getKategoriProduk as $item)
                                                    @if ($item->id == $getData->id_kategori)
                                                        <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>

                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="nama">Harga Produk</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="harga">Rp.</label>
                                                </div>
                                                <input type="number" name="harga" class="form-control"  id="harga"
                                                    value="{{$getData->harga}}"
                                                    aria-describedby="name">
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