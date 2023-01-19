<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_brg',
        'nama_brg',
        'harga_brg',
        'stok_brg',
        'foto_brg'
    ];
}
