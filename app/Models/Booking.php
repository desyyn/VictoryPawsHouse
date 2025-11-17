<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';
    
    protected $fillable = [
        'id_pengguna',
        'id_transaksi', // FK ke transaksi_produk
        
        // Data dari Form Baru
        'tipe_layanan', // Enum/String: Grooming, Pet Hotel, Home Service
        'nama', // Nama Anda (nama_anda dari form)
        'nama_hewan',
        'nomor_hp',
        'jenis_hewan',
        'gender_hewan',
        'jadwal', // Tanggal mulai/Check-in
        'durasi', // Hanya dipakai Pet Hotel
        'catatan',
        'status', 
    ];

    protected $casts = [
        'jadwal' => 'datetime',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }
    
    // Karena id_layanan tidak lagi ada di tabel booking Anda, kita hapus relasi Layanan.
    // Relasi Transaksi tetap ada.
    public function transaksi()
    {
        return $this->belongsTo(TransaksiProduk::class, 'id_transaksi', 'id_transaksi');
    }
}