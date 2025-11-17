<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Booking;
use App\Models\Pembayaran;
use App\Models\TransaksiProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Menampilkan form booking All-in-One (Halaman Utama Booking).
     */
    public function index()
    {
        // Ambil harga dasar layanan (untuk Grooming, Hotel, Home Service)
        // Harga ini digunakan untuk perhitungan di JavaScript/Frontend
        $layananHarga = Layanan::whereIn('nama_layanan', ['Pet Grooming', 'Pet Hotel', 'Home Service'])->pluck('harga', 'nama_layanan')->toArray();

        // View yang dipanggil adalah resources/views/customer/booking/form.blade.php
        return view('customer.booking.form', compact('layananHarga'));
    }

    /**
     * Memproses form booking All-in-One (Satu method untuk Grooming/Hotel/Home Service).
     */
    public function store(Request $request)
    {
        // 1. Validasi Dasar
        $request->validate([
            'layanan_pilih' => 'required|array',
            'nama_anda' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'nama_hewan' => 'required|string|max:255',
            'jenis_hewan' => 'required|in:Anjing,Kucing,Lainnya',
            'gender_hewan' => 'required|in:Jantan,Betina',
            'jadwal' => 'required|date|after:now',
            'catatan' => 'nullable|string',
        ]);

        $layananPilih = $request->layanan_pilih;
        $totalHarga = 0;
        $durasi = null;
        
        // 2. Hitung Harga Total Berdasarkan Pilihan
        $layananData = Layanan::whereIn('nama_layanan', $layananPilih)->get();
        $layananTipeString = implode(', ', $layananPilih);
        
        foreach ($layananData as $item) {
            $hargaSatuan = $item->harga;

            if ($item->nama_layanan === 'Pet Hotel') {
                $request->validate(['jadwal_checkout' => 'required|date|after:jadwal']);
                
                $checkin = Carbon::parse($request->jadwal);
                $checkout = Carbon::parse($request->jadwal_checkout);
                $durasi = $checkin->diffInDays($checkout); // Dalam malam
                
                if ($durasi <= 0) {
                     return back()->withErrors(['jadwal_checkout' => 'Durasi inap harus minimal 1 malam.'])->withInput();
                }
                $totalHarga += $hargaSatuan * $durasi;
            } else {
                // Grooming dan Home Service harganya flat per layanan
                $totalHarga += $hargaSatuan;
            }
        }

        if ($totalHarga == 0) {
             return back()->withErrors(['layanan_pilih' => 'Total harga harus lebih dari Rp 0.'])->withInput();
        }

        // 3. Proses Transaksi Database
        try {
            DB::beginTransaction();

            // A. Buat entri PEMBAYARAN
            $pembayaran = Pembayaran::create([
                'id_transaksi' => null, 
                'id_booking' => null,
                'metode' => null, 
                'status' => 'Pending',
            ]);
            
            // B. Buat entri TRANSAKSI PRODUK/LAYANAN
            $transaksi = TransaksiProduk::create([
                'id_transaksi' => 'TRX-' . time() . Str::random(4),
                'id_pengguna' => Auth::user()->id_pengguna, // Menggunakan PK kustom
                'id_pembayaran' => $pembayaran->id_pembayaran,
                'tanggal_transaksi' => now(),
                'total' => $totalHarga,
                'status' => 'Menunggu Pembayaran',
            ]);

            // C. Buat entri BOOKING tunggal (sesuai schema baru)
            $booking = Booking::create([
                'id_pengguna' => Auth::user()->id_pengguna,
                'id_transaksi' => $transaksi->id_transaksi,
                'tipe_layanan' => $layananTipeString, // Contoh: "Pet Grooming, Pet Hotel"
                'nama' => $request->nama_anda,
                'nama_hewan' => $request->nama_hewan,
                'nomor_hp' => $request->nomor_hp,
                'jenis_hewan' => $request->jenis_hewan,
                'gender_hewan' => $request->gender_hewan,
                'jadwal' => $request->jadwal,
                'durasi' => $durasi, 
                'catatan' => $request->catatan,
                'status' => 'Pending',
            ]);
            
            // D. Update relasi balik
            $pembayaran->update(['id_transaksi' => $transaksi->id_transaksi, 'id_booking' => $booking->id_booking]);

            DB::commit();

            // 4. Redirect ke Halaman Pembayaran (Halaman 11)
            return redirect()->route('payment.show', ['transaction_id' => $transaksi->id_transaksi])
                             ->with('success', 'Booking berhasil dibuat, lanjutkan pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses booking: ' . $e->getMessage())->withInput();
        }
    }
    
    // ====================================================
    // PEMBAYARAN (Halaman 11)
    // ====================================================

    /**
     * Menampilkan halaman pembayaran dengan detail transaksi (Halaman 11).
     */
    public function showPayment($transaction_id)
    {
        // Asumsi relasi sudah didefinisikan di Model TransaksiProduk, Pembayaran, dan Booking
        $transaksi = TransaksiProduk::with(['pembayaran.booking'])->find($transaction_id);

        if (!$transaksi || $transaksi->status !== 'Menunggu Pembayaran') {
            return redirect('/dashboard')->with('error', 'Transaksi tidak ditemukan atau status sudah berubah.');
        }

        return view('customer.payment.show', compact('transaksi'));
    }

    /**
     * Memproses pilihan metode pembayaran.
     */
    public function processPayment(Request $request, $transaction_id)
    {
        $request->validate(['metode' => 'required|string']);

        $transaksi = TransaksiProduk::find($transaction_id);
        
        if (!$transaksi || $transaksi->status !== 'Menunggu Pembayaran') {
             return back()->with('error', 'Transaksi tidak valid.');
        }

        $transaksi->pembayaran->update(['metode' => $request->metode]);
        
        // Redirect ke halaman upload bukti transfer (Simulasi: Halaman Payment Upload)
        return redirect()->route('payment.upload', $transaksi->id_transaksi)
                         ->with('success', 'Metode pembayaran ' . $request->metode . ' telah dipilih. Mohon lanjutkan proses transfer.');
    }
}