<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketHotel extends Model
{
    use HasFactory;
    
    protected $table = 'paket_hotel'; // Asumsi nama tabel Anda paket_hotel
    protected $primaryKey = 'id_paket'; // Menggunakan id_paket yang sama dengan grooming
    
    protected $fillable = [
        'id_layanan', 
        'nama_paket', // Misal: Kamar Standar, Kamar Deluxe
        'deskripsi',
        'harga', // Harga per malam
    ];

    /**
     * Relasi ke Layanan.
     */
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}