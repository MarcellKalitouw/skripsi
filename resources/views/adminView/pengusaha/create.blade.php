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
                        <form method="post" action="{{ route('pengusaha.store') }}" enctype="multipart/form-data" id="myForm">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                       
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Pengusaha</label>
                                            <input type="text" name="nama" class="form-control"  id="nama"
                                                    aria-describedby="name">
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea placeholder="Ketikan Alamat Lengkap Usaha Anda..." name="alamat" id="" cols="30" rows="10" class="form-control">
                                            </textarea>
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="no_telp">+62</label>
                                                </div>
                                                <input type="number" name="no_telp" class="form-control"  id="no_telp"
                                                    aria-describedby="no_telp">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control"  id="email"
                                                    aria-describedby="email">
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="password">Kata Sandi</label>
                                            <input type="password" name="password" class="form-control"  id="password"
                                                    aria-describedby="password">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" name="gambar" class="form-control" id="gambar"
                                                aria-describedby="name">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea rows="5" name="deskripsi" class="form-control" id="deskripsi"
                                                aria-describedby="name"></textarea>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option selected disabled>Pilih Status Pengusaha</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    
                                            <div class="col-12 form-group">
                                                <label for="lat">Latitude</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="lat">Lat</label>
                                                    </div>
                                                    <input type="number" name="latitude" value="" readonly class="form-control"  id="lat"
                                                        aria-describedby="lat">
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 form-group">
                                                <label for="lng">Longitude</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="lng">Long</label>
                                                    </div>
                                                    <input type="number" name="longitude" value="" readonly class="form-control"  id="lng"
                                                        aria-describedby="lng">
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 form-group">
                                                <label for="">Pin Location</label>
                                                <div id="here-maps">
                                                    <div id="mapContainer" style="height:500px"></div>
                                                </div>
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

@push('script')
   <script>
       window.action = "submit"
   </script>
    <!--This page JavaScript -->
@endpush