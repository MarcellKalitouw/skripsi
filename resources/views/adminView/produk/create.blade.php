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
                        <form method="post" action="{{ route('produk.store') }}" enctype="multipart/form-data" id="myForm">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="pengusaha">Pengusaha</label>
                                            <select class="form-control" name="id_pengusaha" id="pengusaha">
                                                <option selected disabled>Pilih Pengusaha</option>
                                                @foreach ($getPengusaha as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Produk</label>
                                            <input type="text" name="nama" class="form-control"  id="nama"
                                                    aria-describedby="name">
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="satuan">Satuan Produk</label>
                                            <select name="id_satuan" class="form-control" id="satuan">
                                                <option selected disabled>Pilih Satuan Produk</option>
                                                @foreach ($getSatuanProduk as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="kategori_produk">Kategori Produk</label>
                                            <select class="form-control" name="id_kategori" id="kategori_produk">
                                                <option selected disabled>Pilih Kategori Produk</option>
                                                @foreach ($getKategoriProduk as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
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
                                                    aria-describedby="name">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="gambar">Gambar</label>
                                            {{-- <input type="file" name="gambar" class="form-control" id="gambar"
                                                aria-describedby="name" accept="image/*" onchange="document.getElementById('showGambar').src = window.URL.createObjectURL(this.files[0])"> --}}
                                            <input type="file" name="gambar[]" class="form-control" id="gambar"
                                                aria-describedby="name" accept="image/*" onchange="showImage(this.files[])" required multiple>

                                            <img id="showGambar" src="" width="300px" height="300px" style="display: none;object-fit:contain; margin-top:2%">
                                        </div>

                                        

                                        <div class="col-12 form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea rows="5" name="deskripsi" class="form-control" id="deskripsi"
                                                aria-describedby="name"></textarea>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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

@section('addScript')
    <script src="{{asset ('../js/showImage.js')}}"></script>
{{-- <script>
    function showImage(file) {
        let getFile = document.getElementById("showGambar");
        getFile.src = window.URL.createObjectURL(file);
    }
</script> --}}

<script >
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".hdtuto").remove();
      });
    });
</script>
    
@endsection