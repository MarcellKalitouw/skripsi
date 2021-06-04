<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class Paket extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    protected $table = "paket";
    protected $fillable = [
        'id_pengusaha',
        'harga',
        'nama',
        'gambar',
        'deskripsi'
    ];
}