<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Rating extends Model
{
    use HasFactory, Uuids;

    public $timestamps = true;
    protected $table = "rating";
    protected $fillable = [
        'id_pelanggan',
        'id_pengusaha',
        'deskripsi',
        'nilai'
    ];
}