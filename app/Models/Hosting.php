<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hosting extends Model
{
    protected $table = 'hostings'; 
    protected $fillable = [
       'nama_website', 'sector', 'nama_user', 'link_github', 'contact_user', 'nama_petugas', 'contact_petugas', 'status'
    ];
}
