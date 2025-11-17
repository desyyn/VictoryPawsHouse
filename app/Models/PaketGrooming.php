<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketGrooming extends Model
{
    use HasFactory;
    protected $table = 'paket_grooming';
    
    protected $primaryKey = 'id_paket';
    
    protected $fillable = [
        'id_layanan', 
        'nama_paket',
        'deskripsi',
        'harga',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}