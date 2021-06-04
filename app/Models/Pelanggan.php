<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class Pelanggan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    protected $table = "pelanggan";
    protected $fillable = [
        'nama',
        'no_telp',
        'email',
        'gambar',
        'status',
        'password'
    ];
}