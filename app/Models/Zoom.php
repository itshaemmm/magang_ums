<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    protected $table = 'zooms'; 
    protected $fillable = [
        'tanggal', 'waktu', 'nama', 'sector', 'petugas'
    ];
}
