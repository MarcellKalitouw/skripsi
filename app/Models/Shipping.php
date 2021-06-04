<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class Shipping extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    protected $table = "shipping";
    protected $fillable = [
        'id_transaksi',
        'id_user',
        'id_pengusaha',
        'nama_kurir',
        'alamat_jemput',
        'geocoding_jemput',
        'alamat_antar',
        'geocoding_antar',
        'gambar',
        'deskripsi'
    ];
}