<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
use Laravel\Sanctum\HasApiTokens;

class Kurir extends Model
{
    use HasFactory, SoftDeletes, Uuids, HasApiTokens;

    protected $table = 'kurir';
    public $timestamps = true;
    protected $fillable = [
        'id_pengusaha',
        'nama_kurir',
        'password',
        'foto_kurir',
    ];
}