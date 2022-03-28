@extends('adminView.layout')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Tambah Pelanggan</h4>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <h3>Form Pelanggan</h3>
                        <hr>
                        <form method="post" action="{{ route('transaksi.create-transaksi') }}" enctype="multipart/form-data" id="myForm">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="nama">Pilih Pelanggan yang terdaftar</label>
                                            <datalist id="browsers" class="form-control">
                                                <option value="Edge">
                                                <option value="Firefox">
                                                <option value="Chrome">
                                                <option value="Opera">
                                                <option value="Safari">
                                            </datalist>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Pelanggan</label>
                                            <input type="text" name="nama" class="form-control"  id="nama"
                                                    aria-describedby="name">
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option selected disabled>Pilih Jenis Kelamin</option>
                                                <option value="Male">Laki-laki</option>
                                                <option value="Female">Perempuan</option>
                                            </select>
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