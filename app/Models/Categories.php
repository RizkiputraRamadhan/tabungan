<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $primary = 'token';
    protected $fillable = [
        'token',
        'name',
        'status',
        'tanggal_pelaksanaan',
        'jam_mulai',
        'jam_selesai',
        'durasi',
    ];
}
