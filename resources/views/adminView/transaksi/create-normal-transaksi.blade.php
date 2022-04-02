@extends('adminView.layout')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Transaksi Baru</h4>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <h3>Form Tambah Transaksi</h3>
                        <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                        <form method="post" action="{{ route('transaksi.store-detailTransaksi', $idTransaksi) }}" enctype="multipart/form-data" id="myForm">
                                            @csrf
                                            <div class="col-12 form-group">
                                                <label for="id_produk">Produk</label>
                                                <select id="id-produk" class="form-control select-product" name="id_produk" >
                                                    <option selected disabled>Pilih Produk</option>
                                                    @foreach ($produk as $item)
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                            
                                            <div class="col-12" id="body-tambah-pesanan" style="visibility: hidden;">
                                                <div class="col-12 form-group">
                                                    <label for="harga">Harga Rp.<span id="lbl-harga"></span> <span id="satuan-harga"></span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="harga">Rp</label>
                                                        </div>
                                                        <input readonly type="number" value="0" name="harga" class="form-control"  id="harga"
                                                            aria-describedby="harga">
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="qty">Kuantiti </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" id="satuan-qty" for="qty"></label>
                                                        </div>
                                                        <input  type="number" name="qty" step=".01" class="form-control" onchange="totalHarga()" id="qty"
                                                            aria-describedby="qty">
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="diskon">Diskon</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="diskon">Rp</label>
                                                        </div>
                                                        <input type="number" value="0" onchange="totalHarga()" name="diskon" class="form-control"  id="diskon"
                                                            aria-describedby="diskon">
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="total" class="font-weight-bold" style="font-size:18px">Total Pesanan</label>
                                                    <div class="input-group" style="align-items: center; justify-content: right;">
                                                        
                                                        <p id="total-harga-produk" style="margin-bottom: 0;margin-left:2%; font-size: 24px" >Rp. 0</p>
                                                    </div>
                                                    
                                                </div>
                                                <input type="hidden" name="total" id="total" >
                                            </div>
                                            <div class="col-12 form-group">
                                                    <button type="submit" class="btn btn-block btn-light" style="display:flex; justify-content: center;align-items: center">
                                                        <i class="fas fa-cart-plus fa-2x"></i> 
                                                        <p class="Tambah Pesanan" style="font-size: 24px;margin-bottom:0;margin-left:2%">Tambah Pesanan</p> 
                                                    </button>
                                            </div>
                                        </form>
                                        </div>
                                        <div class="col-6">
                                            <div class="table-responsive" style="height: 485px">
                                                <table class="table table-hover">
                                                    <thead >
                                                        <tr class="text-center bg-white text-muted border border-success">
                                                            <th colspan="6" style="padding-top: 8px; padding-bottom: 8px">
                                                                <h3 style="margin-bottom: 0">Rincian Pesanan</h3>
                                                            </th>
                                                        </tr>
                                                        <tr class="bg-success text-white" style="position: -webkit-sticky; 
                                                            position: sticky;
                                                            top: 0;">
                                                            <th>#</th>
                                                            <th>Nama Produk</th>
                                                            <th>Harga</th>
                                                            <th>Kuantiti</th>
                                                            <th>Diskon</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no = 0 ?>
                                                        @forelse ($detailTransaksi as $item)
                                                            <tr>
                                                                <td>
                                                                    <button onclick="hapusDetailTransaksi('{{ $item->id }}')" type="button" class="btn btn-rounded btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                                <td>{{ $item->nama_produk }}</td>
                                                                <td>Rp.{{ $item->harga }}</td>
                                                                <td>{{ $item->qty }}</td>
                                                                <td>Rp.{{ $item->diskon }}</td>
                                                                <td>Rp.{{ $item->total }}</td>
                                                                
                                                            </tr>
                                                        @empty
                                                            <tr class="text-center">
                                                                <td colspan="6">Pesanan belum ada</td>
                                                            </tr>
                                                        @endforelse
                                                        
                                                        
                                                            
                                                    </tbody>
                                                    <tfoot >
                                                        <tr class="bg-success text-white" style="position: -webkit-sticky; 
                                                            position: sticky;
                                                            bottom: 0;">
                                                            <th colspan="2" class="text-center">TOTAL</th>
                                                            <th>Rp.{{ number_format($totalDetailTransaksi->total_harga) }}</th>
                                                            <th>{{ $totalDetailTransaksi->qty_total }}</th>
                                                            <th>Rp.{{ number_format($totalDetailTransaksi->total_diskon)  }}</th>
                                                            <th>Rp.{{ number_format($totalDetailTransaksi->grand_total)  }}</th>
                                                        </tr>
                                                        
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6 row">
                                            <div class="col-6 form-group">
                                                <label for="biaya_tambahan">Biaya Tambahan</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="biaya_tambahan">Rp</label>
                                                    </div>
                                                    <input type="number" name="biaya_tambahan" min="0" value="0" onblur="grandTotal()" class="form-control"  id="biaya-tambahan"
                                                        aria-describedby="biaya_tambahan">
                                                </div>
                                                
                                            </div>
                                            <div class="col-6 form-group">
                                                <label for="biaya_pengiriman">Biaya Pengiriman</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="biaya_pengiriman">Rp</label>
                                                    </div>
                                                    <input type="number" name="biaya_pengiriman" min="0" value="0" onblur="grandTotal()" class="form-control"  id="biaya-pengiriman"
                                                        aria-describedby="biaya_pengiriman">
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="col-6 form-group">
                                                <label for="pajak">Pajak</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="pajak">%</label>
                                                    </div>
                                                    <input value="0" type="number" name="pajak" min="0" onblur="grandTotal()" class="form-control"  id="pajak"
                                                        aria-describedby="pajak">
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="col-6 form-group">
                                                <label for="diskon_transaksi">Diskon</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="diskon_transaksi">Rp</label>
                                                    </div>
                                                    <input value="0" type="number" name="diskon_transaksi" min="0" onblur="grandTotal()" class="form-control"  id="diskon-transaksi"
                                                        aria-describedby="diskon_transaksi">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-6 row">
                                            <div class="col-6 form-group">
                                                <label for="total_diskon_transaksi">Total Diskon</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="total_diskon_transaksi">Rp</label>
                                                    </div>
                                                    <input value="{{ $totalDetailTransaksi->total_diskon }}" readonly value="0" type="number" name="total_diskon_transaksi" class="form-control"  id="total-diskon-transaksi"
                                                        aria-describedby="total_diskon_transaksi">
                                                </div>
                                                
                                            </div>
                                            <div class="col-6 form-group">
                                                <label for="total_qty">Total Kuantiti</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="total_qty"></label>
                                                    </div>
                                                    <input readonly value="{{ $totalDetailTransaksi->total_qty }}" type="number" name="total_qty" class="form-control"  id="total-qty"
                                                        aria-describedby="total_qty">
                                                </div>
                                                
                                            </div>
                                            <div class="col-6 form-group">
                                                <label for="subtotal">Subtotal </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="subtotal">Rp</label>
                                                    </div>
                                                    <input readonly value="{{ $totalDetailTransaksi->total_harga }}" type="number" name="subtotal" class="form-control"  id="subtotal"
                                                    <input readonly  type="number" name="subtotal" class="form-control"  id="subtotal"
                                                        aria-describedby="subtotal">
                                                </div>
                                                
                                            </div>
                                            <div class="col-6 form-group">
                                                <label for="total_transaksi">Total</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="total_transaksi">Rp</label>
                                                    </div>
                                                    <input readonly value="{{ $totalDetailTransaksi->grand_total }}" type="number" name="total_transaksi" class="form-control"  id="total-transaksi"
                                                        aria-describedby="total_transaksi">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea rows="5" name="keterangan" class="form-control" id="ket"
                                                aria-describedby="keterangan"></textarea>
                                        </div>
                                        
                                        
                                        <div class="col-12 form-group">
                                            <button id="btn-simpan-transaksi" onclick="updateTransaksi()" type="button" class="btn btn-block btn-primary" >Simpan</button>
                                            <button id="btn-loading-transaksi" class="btn btn-primary btn-block" type="button" disabled="" style="display: none">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                

                            </div>
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
        
            //detail_transaksi
            let baseUrl = '{{ url('/') }}';
            let inpHargaProduk = $("#harga");
            let inpQtyProduk = $("#qty");
            let inpDiskonProduk = $('#diskon');
            let inpTotal = $('#total');
            let lblQtyProduk = $("#satuan-qty");
            let lblHargaSatuanProduk = $("#satuan-harga");
            let lblHargaProduk = $("#lbl-harga");
            let lblTotalHargaProduk = $("#total-harga-produk");

            //transaksi
            let inpBiayaTambahan = $("#biaya-tambahan");
            let inpBiayaPengiriman = $("#biaya-pengiriman");
            let inpPajak = $("#pajak");
            let inpDiskonTransaksi = $("#diskon-transaksi");
            let inpTotalTransaksi = $("#total-transaksi");
            let inpTotalQty = $("#total-qty");
            let inpSubtotal = $("#subtotal");
            let inpKeterangan = $("#ket")

            //btnTransaksi
            let btnSimpanTransaksi = $("#btn-simpan-transaksi");
            let btnLoadingTransaksi = $("#btn-loading-transaksi");

            

            function updateTransaksi(){
                btnSimpanTransaksi.css('display', 'none')
                btnLoadingTransaksi.css('display', 'block')
                let dataTransaksi = {
                    'biaya_tambahan': parseInt(inpBiayaTambahan.val()),
                    'biaya_pengiriman': parseInt(inpBiayaPengiriman.val()),
                    'total_qty': parseInt(inpTotalQty.val()),
                    'subtotal': parseInt(inpSubtotal.val()),
                    'diskon': parseInt(inpDiskonTransaksi.val()),
                    'pajak': parseInt(inpPajak.val()),
                    'total': parseInt(inpTotalTransaksi.val()),
                    'keterangan': inpKeterangan.val(),
                }
                console.log('dataTransaksi', dataTransaksi);
                // if(inpTotalTransaksi.val() !== 0 || inpTotalTransaksi.val() !== ''){
                //     $.ajax({
                //         url: "{{ route('transaksi.update-transaksi', $idTransaksi) }}",
                //         type:'PUT',
                //         data: {_token:`{{ csrf_token() }}`, data: dataTransaksi},
                //         success: function(data) {
                            
                //                 window.location.href = "{{ url('/list-transaksi') }}"
                            
                //         }
                //     });

                // }

            }
            function hapusDetailTransaksi(id){
                // alert(id);
                if(!confirm("Apakah anda ingin menghapus data ini?")) {
                    return false;
                }

                let url = baseUrl + `/deleteDetailTransaksi/${id}`;
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data:{
                        "id":id,
                        "_token": `{{ csrf_token() }}`
                    },
                    success: function(){
                        location.reload()
                    }
                })

            }
            const numInputs = document.querySelectorAll('input[type=number]')

            numInputs.forEach(function(input) {
                input.addEventListener('change', function(e) {
                    if (e.target.value == '') {
                    e.target.value = 0
                    }
                })
            })

            function grandTotal(){
                let withPajak, totalPajak;

                let newExtraCost = parseInt(inpBiayaTambahan.val()) + parseInt(inpBiayaPengiriman.val())   ;
                if(inpBiayaTambahan.val() !== '' && inpBiayaTambahan.val() !== '' && inpBiayaPengiriman.val() !== '' && inpBiayaPengiriman.val() !== ''){
                    newExtraCost = {{ $totalDetailTransaksi->grand_total }} + newExtraCost;
                    inpTotalTransaksi.val(newExtraCost);
                }
                

                if(inpPajak.val() != 0 && inpPajak.val() != null && inpPajak.val() != undefined && inpPajak.val() !== ''){
                     totalPajak = inpTotalTransaksi.val() * (inpPajak.val() / 100);
                     withPajak = parseInt(inpTotalTransaksi.val()) + parseInt(totalPajak);
                     inpTotalTransaksi.val(withPajak);
                     console.log('totalPajak', totalPajak, 'withPajak', withPajak);
                }
                console.log('new', newExtraCost);

            }

            function getDetailProduk(id){
                // alert("Your choose Product " + id );
                
                let url = baseUrl + `/getDetailProduk/${id}`;

                $.get(url, function(data){
                    console.log('data', data);
                    lblHargaProduk.text(data.harga)
                    lblHargaSatuanProduk.text(data.satuan_produk.nama)
                    lblQtyProduk.text(data.satuan_produk.nama)
                })

            }
            

            function totalHarga(){
                let newHarga = lblHargaProduk.text() * inpQtyProduk.val();
                let newHargaDiskon = 0;
                if(inpDiskonProduk.val !== '' || inpDiskonProduk.val !== undefined){
                    newHargaDiskon = newHarga - inpDiskonProduk.val();
                }

                console.log('newHarga', newHarga);
                inpHargaProduk.val(newHarga);
                inpTotal.val(newHargaDiskon);
                lblTotalHargaProduk.text(`Rp.${newHargaDiskon.toLocaleString()}`);
            }


            $("#id-produk").change(function(){
                let idProduct = this.value;
                $("#body-tambah-pesanan").css('visibility','visible')
                getDetailProduk(idProduct);
            });
        
    </script>
@endpush