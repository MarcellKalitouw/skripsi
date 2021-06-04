<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class Pengusaha extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    protected $table = "pengusaha";
    protected $fillable = [
        'nama',
        'alamat',
        'latitude',
        'longitude',
        'no_telp',
        'email',
        'gambar',
        'deskripsi',
        'password'
    ];
}