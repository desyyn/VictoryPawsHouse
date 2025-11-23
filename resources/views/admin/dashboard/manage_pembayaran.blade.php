@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Pembayaran</h1>

    <div class="p-6 bg-white rounded-xl shadow-lg">
        <p class="text-gray-600">Halaman ini akan menampilkan daftar semua bukti transfer yang dikirim oleh pelanggan untuk verifikasi pembayaran.</p>
        
        <div class="mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Booking</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Transfer</th>
                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($payments as $payment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $payment->id_booking }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->metode_pembayaran }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{-- Asumsi field bukti_transfer menyimpan path/url gambar --}}
                                @if ($payment->bukti_transfer)
                                    <a href="{{ $payment->bukti_transfer }}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
                                @else
                                    <span class="text-red-500">Belum Ada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-green-600 hover:text-green-900">Verifikasi</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data pembayaran untuk diverifikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection