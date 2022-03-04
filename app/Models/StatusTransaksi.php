<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class StatusTransaksi extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    protected $table = "status_transaksi";
    protected $fillable = [
        'id_transaksi',
        'id_user',
        'nama',
        'tipe',
        'keterangan',
        'updated_by',
        
    ];
}