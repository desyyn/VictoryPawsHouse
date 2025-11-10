<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Produk;
use App\Models\Event;
use Illuminate\Http\Request;

class LayananPublikController extends Controller
{
    /**
     * Menampilkan halaman utama Layanan, Produk, dan Event untuk pelanggan.
     * Halaman 4 di flow Anda.
     */
    public function index()
    {
        // 1. Ambil Data Layanan (Grooming, Pet Hotel, Home Service)
        // Kita asumsikan data ini sudah ada di database Layanan
        $layanans = Layanan::all();

        // Pisahkan layanan berdasarkan jenis
        $grooming = $layanans->where('jenis', 'Grooming')->first();
        $hotel = $layanans->where('jenis', 'Pet Hotel')->first();
        $home_service = $layanans->where('jenis', 'Home Service')->first();

        // 2. Ambil Data Produk (Pet Supplies)
        // Kita ambil 1 item terbaru untuk display
        $produk_display = Produk::latest()->limit(1)->first(); 

        // 3. Ambil Data Event (Pet Exhibition)
        // Kita ambil 1 event yang akan datang
        $event_display = Event::where('tanggal', '>=', now())
                            ->orderBy('tanggal', 'asc')
                            ->limit(1)
                            ->first();

        // Kirim semua data ke view
        return view('layanan_publik.index', compact(
            'grooming', 
            'hotel', 
            'home_service', 
            'produk_display', 
            'event_display'
        ));
    }
}