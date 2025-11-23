<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Pembayaran;
use App\Models\Ulasan;
use App\Models\Produk;
use App\Models\Event;

class AdminController extends Controller
{
    /**
     * Menampilkan Dashboard Utama (Grafik & KPI - Halaman 1).
     */
    // app/Http/Controllers/Admin/AdminController.php
    public function dashboard()
    {
        $completedBookings = Booking::where('status', 'selesao');
        $allBookings = Booking::all();

        $totalOrders = $allBookings->count();
        $totalCanceled = Booking::where('status', 'ditolak')->count();
        $totalRevenue = $completedBookings->sum('total_harga'); 
        
        $latestTransactions = Booking::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard.grafik', compact(
            'totalOrders', 
            'totalCanceled', 
            'totalRevenue', 
            'latestTransactions'
        ));
    }

    /**
     * Menampilkan Manajemen Booking (Halaman 2).
     */
    public function manageBooking()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard.manage_booking', compact('bookings'));
    }

    /**
     * Menampilkan Manajemen Pembayaran (Halaman 3).
     */
    public function managePembayaran()
    {
        $payments = Pembayaran::orderBy('tanggal_pembayaran', 'desc')->get();
        return view('admin.dashboard.manage_pembayaran', compact('payments'));
    }

    /**
     * Menampilkan Manajemen Katalog (Halaman 4 - CRUD Produk).
     */
    public function manageKatalog()
    {
        $products = Produk::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard.manage_katalog', compact('products'));
    }

    /**
     * Menampilkan Manajemen Event (Halaman 5 - CRUD Event).
     */
    public function manageEvent()
    {
        $events = Event::orderBy('tanggal', 'desc')->get();
        return view('admin.dashboard.manage_event', compact('events'));
    }

    /**
     * Menampilkan Manajemen Ulasan (Halaman 6).
     */
    public function manageUlasan()
    {
        $reviews = Ulasan::orderBy('created_at', 'desc')->with('pengguna')->get();
        return view('admin.dashboard.manage_ulasan', compact('reviews'));
    }
}