<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    protected $table = 'zooms'; 
    protected $fillable = [
        'tanggal', 'waktu', 'nama', 'nama_user', 'contact_user', 'nama_petugas', 'contact_petugas', 'sector', 'status'
    ];
}
