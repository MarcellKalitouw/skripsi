@extends('adminView.layout')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-warning">
                    <h4 class="text-white">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <h3>Form Edit {{$pageTitle}}</h3>
                        <hr>
                        <form method="post" action="{{ route('pengusaha.update', $getData->id) }}" enctype="multipart/form-data" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                       
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Pengusaha</label>
                                            <input type="text" name="nama" class="form-control" value="{{ $getData->nama }}" id="nama"
                                                    aria-describedby="name">
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="no_telp">+62</label>
                                                </div>
                                                <input type="number" name="no_telp" class="form-control" value="{{ $getData->no_telp }}"  id="no_telp"
                                                    aria-describedby="no_telp">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $getData->email }}"  id="email"
                                                    aria-describedby="email">
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="password">Kata Sandi</label>
                                            <input type="password" name="password" class="form-control" value=""  id="password"
                                                    aria-describedby="password">
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="gambar">Gambar</label>
                                            {{-- <img src="{{ asset('gambar_pengusaha/'.$getData->gambar) }}" alt=""> --}}
                                            <img style="width:100%; max-height:500px;object-fit:cover;object-position:top" src="{{asset('gambar_pengusaha/'.$getData->gambar)}}" alt="">
                                            
                                            <input type="file" name="gambar" class="form-control" id="gambar"
                                                aria-describedby="name">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea placeholder="Ketikan Alamat Lengkap Usaha Anda..." name="alamat" id="" cols="20" rows="5" class="form-control">{{ $getData->alamat }}
                                            </textarea>
                                            
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="deskripsi">Deskripsi tentang Usaha</label>
                                            <textarea rows="5" name="deskripsi" class="form-control" id="deskripsi"
                                                aria-describedby="name">{{ $getData->deskripsi }}</textarea>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-6">
                                    
                                    <div class="col-12 form-group">
                                        <label for="lat">Latitude</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="lat">Lat</label>
                                            </div>
                                            <input type="number" name="latitude" value="{{ $getData->latitude }}" readonly class="form-control"  id="lat"
                                                aria-describedby="lat">
                                        </div>
                                        
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="lng">Longitude</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="lng">Long</label>
                                            </div>
                                            <input type="number" name="longitude" value="{{ $getData->longitude }}" readonly class="form-control"  id="lng"
                                                aria-describedby="lng">
                                        </div>
                                        
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="">Pin Location</label>
                                        <div id="here-maps">
                                            <div id="mapContainer" style="height:500px"></div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                
                                <div class="col-6 form-group">
                                    <button type="submit" class="col-3 btn btn-primary">Simpan</button>
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