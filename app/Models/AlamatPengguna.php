<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class AlamatPengguna extends Model
{
    use HasFactory, SoftDeletes, Uuids;
    public $timestamps = true;
    protected $table = "alamat_pengguna";
    protected $fillable = [
        'id',
        'id_pelanggan',
        'alamat',
        'long',
        'lat'
    ];
}