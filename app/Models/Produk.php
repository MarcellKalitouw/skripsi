<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class Produk extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    protected $table = "produk";
    protected $fillable = [
        'id_pengusaha',
        'nama',
        'harga',
        'id_satuan',
        'id_kategori',
        'gambar',
        'deskripsi'
    ];
}