<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videotron extends Model
{
    protected $table = 'videotron'; 
    protected $fillable = [
        'tanggal_mulai', 'tanggal_selesai',
        'waktumulai', 'waktuselesai',
        'nama_peminjam', 'contact_peminjam',
        'nama_acara', 'link_video',
        'nama_petugas', 'contact_petugas',
        'status', 'keterangan'
    ];
}
