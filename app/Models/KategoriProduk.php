<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriProduk extends Model
{
    
    protected $table = 'kategori_produk';
    use HasFactory, SoftDeletes, Uuids;
    public $timestamps = true;
    protected $fillable = [
        'nama'
    ];
    
}