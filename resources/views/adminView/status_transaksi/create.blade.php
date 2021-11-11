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
                        <form method="post" action="{{ route('status_transaksi.store') }}" id="myForm">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="id_transaksi">ID Transaksi</label>
                                            <select name="id_transaksi" class="form-control" id="transaksi">
                                                <option selected disabled>Pilih ID Transaksi</option>
                                                @foreach ($transaksi as $item)
                                                    <option value="{{$item->id}}">{{$item->id}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Status</label>
                                            <input type="text" name="nama" class="form-control" id="nama"
                                                aria-describedby="name">
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="tipe">Tipe Status</label>
                                            <select class="form-control" name="tipe" id="tipe">
                                                <option selected disabled>Pilih Tipe Status</option>
                                                <option value="transaksi">Transaksi</option>
                                                <option value="shipping">Shipping</option>
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