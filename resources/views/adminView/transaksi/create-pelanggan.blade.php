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
                                <div class="col-6" id="body-form">
                                    <div class="row" id="form-pilih-pelanggan">
                                        <div class="col-12 form-group">
                                            <label for="nama">Nama Pelanggan</label>
                                            <select name="id_pelanggan" id="selectPengguna" class="select-pengguna form-control" name="state">
                                                <option value="0" selected disabled>Pilih Pelanggan</option>
                                                @forelse ($pelanggan as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @empty
                                                    <option value="0">Pelanggan Baru</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row" >
                                        
                                        
                                        <div class="col-6 form-group" id="btn-tmbah-pengguna">
                                            <button type="button" onclick="tambahPengguna()" class="col-12 btn btn-success">+ Pelanggan Baru</button>
                                        </div>
                                        <div class="col-6 form-group" style="display: none" id="btn-pilih-pengguna">
                                            <button type="button" onclick="pilihPengguna()" class="col-12 btn btn-success"> Pilih Pengguna</button>
                                        </div>
                                        <div class="col-6 form-group">
                                            <button type="submit" class="col-12 btn btn-primary">Simpan</button>
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
        let notFound = {
            id:-1,
            text:"Buat Pengguna Baru"
        }
        let selectPengguna = $('#selectPengguna');
        let templateForm = `
            <div class="row" id="form-new-pelanggan" >
                                        
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

            </div>
        `;
        
        function matchStart(params, data){

            if ($.trim(params.term) === '') {
                return data;
            }
            if(typeof data.children === 'undefined'){
                if(selectPengguna.find("option[value='-1']").length){
                    selectPengguna.val(data.id).trigger('change');
                }else{
                    var newOption = new Option(notFound.text, notFound.id, false, false)
                    selectPengguna.append(newOption);
                }   
                
                // console.log('null', newOption);
                return null;
            }
            var filteredChildren = [];
            $.each(data.children, function (idx, child) {
                if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                filteredChildren.push(child);
                }
            });
        }
        function tambahPengguna(){
            $('#form-pilih-pelanggan').css("display", "none");
            $('#btn-pilih-pengguna').css("display", "block");
            $('#btn-tmbah-pengguna').css("display", "none");
            $('#form-new-pelanggan').css("display", "block");
            $(".select-pengguna").select2("val","0");

            $('#body-form').prepend(templateForm);
        }
        function pilihPengguna(){
            $('#form-pilih-pelanggan').css("display", "block");
            $('#btn-pilih-pengguna').css("display", "none");
            $('#btn-tmbah-pengguna').css("display", "block");
            $('#form-new-pelanggan').remove();
        }

        $(document).ready(function() {
            $('.select-pengguna').select2({
                // matcher: matchStart
            });
        });

    </script>
@endpush