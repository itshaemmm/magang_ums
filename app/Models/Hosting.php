<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hosting extends Model
{
    protected $table = 'hostings'; 
    protected $fillable = [
       'nama_pihak', 'sector', 'petugas', 'link_github'
    ];
}
