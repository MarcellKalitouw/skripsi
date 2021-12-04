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
                        <form method="post" action="{{ route('transaksi.update', $getData->id) }}" enctype="multipart/form-datab" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="id_status">ID Status</label>
                                            <select name="id_status" class="form-control" id="id_status">
                                                <option selected disabled>Pilih Status</option>
                                                @foreach ($getStatus as $item)
                                                    @if ($getData->id_status == $item->id)
                                                        <option selected   value="{{$item->id}}">{{$item->nama}}</option>
                                                        
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
                                            <label for="id_pelanggan">Pengguna</label>
                                            <select class="form-control" name="id_pelanggan" id="id_pelanggan">
                                                <option selected disabled>Pilih Pengguna</option>
                                                @foreach ($getPengguna as $item)
                                                    @if ($item->id == $getData->id_pelanggan)
                                                        <option selected value="{{$item->id}}">{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="id_shipping">ID Pengiriman</label>
                                            <select class="form-control" name="id_shipping" id="id_shipping">
                                                <option selected disabled>Pilih ID Pengiriman</option>
                                                @foreach ($getShipping as $item)
                                                    @if ($item->id == $getData->id_shipping)
                                                        <option selected value="{{$item->id}}">{{$item->id}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->id}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="total_qty">Total Kuantiti</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="total_qty"></label>
                                                </div>
                                                <input type="number" name="total_qty" class="form-control" value="{{$getData->total_qty}}"  id="total_qty"
                                                    aria-describedby="total_qty">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="subtotal_qty">Sub Total Kuantiti</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="subtotal_qty"></label>
                                                </div>
                                                <input type="number" name="subtotal_qty" class="form-control" value="{{$getData->subtotal_qty}}"  id="subtotal_qty"
                                                    aria-describedby="subtotal_qty">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="pajak">Pajak</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="pajak">%</label>
                                                </div>
                                                <input type="number" name="pajak" class="form-control" value="{{$getData->pajak}}"  id="pajak"
                                                    aria-describedby="pajak">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="diskon">Diskon</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="diskon">%</label>
                                                </div>
                                                <input type="number" name="diskon" class="form-control" value="{{$getData->diskon}}"  id="diskon"
                                                    aria-describedby="diskon">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="biaya_tambahan">Biaya Tambahan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="biaya_tambahan">Rp</label>
                                                </div>
                                                <input type="number" name="biaya_tambahan" class="form-control" value="{{$getData->biaya_tambahan}}"  id="biaya_tambahan"
                                                    aria-describedby="biaya_tambahan">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="biaya_pengiriman">Biaya Pengiriman</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="biaya_pengiriman">Rp</label>
                                                </div>
                                                <input type="number" name="biaya_pengiriman" class="form-control" value="{{$getData->biaya_pengiriman}}"  id="biaya_pengiriman"
                                                    aria-describedby="biaya_pengiriman">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="total">Total/label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="total">Rp</label>
                                                </div>
                                                <input type="number" name="total" value="{{$getData->total}}" class="form-control"  id="total"
                                                    aria-describedby="total">
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea rows="5" name="keterangan" class="form-control" id="keterangan"
                                                aria-describedby="keterangan">{{$getData->keterangan}}</textarea>
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