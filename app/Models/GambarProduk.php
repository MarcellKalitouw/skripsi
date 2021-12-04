<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class GambarProduk extends Model
{
    use HasFactory, Uuids;
    protected $table = 'gambar_produk';
    public $timestamps = true;
    protected $fillable = [
        'id_produk',
        'file'
    ];
}