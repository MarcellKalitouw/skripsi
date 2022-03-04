<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class DetailTransaksi extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    public $timestamps = true;
    protected $table = "detail_transaksi";
    protected $fillable = [
        'id_transaksi',
        'id_user',
        'id_pengusaha',
        'id_produk',
        'id_satuan',
        'harga',
        'qty',
        'diskon',
        'total'
    ];
}