<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class Transaksi extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    protected $table = "transaksi";
    protected $fillable = [
        'tgl',
        'id_status',
        'id_pelanggan',
        'id_pengusaha',
        // 'id_shipping',
        'id_alamat',
        'kode_transaksi',
        'total_qty',
        'subtotal',
        'pajak',
        'diskon',
        'biaya_tambahan',
        'biaya_pengiriman',
        'total',
        'keterangan'
    ];
}