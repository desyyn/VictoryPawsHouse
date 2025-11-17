<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiProduk extends Model
{
    use HasFactory;
    
    protected $table = 'transaksi_produk';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false; // Karena id_transaksi adalah VARCHAR ('TRX-...')

    protected $fillable = [
        'id_transaksi', // Kita isi manual di Controller
        'id_pengguna',
        'id_pembayaran', // Akan diisi setelah Pembayaran dibuat
        'tanggal_transaksi',
        'total',
        'status', // enum: Menunggu Pembayaran, Dibayar, Selesai, Dibatalkan
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];
    
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }
    
    public function pembayaran()
    {
        // Relasi balik ke Pembayaran
        return $this->hasOne(Pembayaran::class, 'id_transaksi', 'id_transaksi');
    }
    
    public function detail()
    {
        // Detail item yang dibeli/dibooking
        return $this->hasMany(DetailTransaksiProduk::class, 'id_transaksi', 'id_transaksi');
    }
}