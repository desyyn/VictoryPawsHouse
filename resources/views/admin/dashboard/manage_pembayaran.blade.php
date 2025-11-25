@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Pembayaran</h1>

    <div class="p-6 bg-white rounded-xl shadow-lg">
        <p class="text-gray-600">Halaman ini menampilkan daftar bukti transfer untuk diverifikasi.</p>
        
        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Info Booking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Transfer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bayar</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($payments as $payment)
                        <tr class="hover:bg-gray-50">
                            {{-- INFO BOOKING --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="font-bold">#{{ $payment->id_booking }}</div>
                                {{-- Menampilkan nama pengirim jika relasi ada --}}
                                <div class="text-xs text-gray-500">
                                    {{ $payment->booking->nama ?? 'User Tidak Ditemukan' }}
                                </div>
                            </td>

                            {{-- METODE PEMBAYARAN --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{-- [PERBAIKAN 1] Gunakan kolom 'metode' --}}
                                <span class="px-2 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">
                                    {{ $payment->metode }}
                                </span>
                            </td>

                            {{-- BUKTI GAMBAR --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{-- [PERBAIKAN 2] Gunakan 'bukti_gambar' dan helper asset() --}}
                                @if ($payment->bukti_gambar)
                                    <a href="{{ asset('uploads/pembayaran/' . $payment->bukti_gambar) }}" target="_blank" class="flex items-center text-indigo-600 hover:text-indigo-900 font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat Bukti
                                    </a>
                                @else
                                    <span class="text-red-400 italic text-xs">Belum upload</span>
                                @endif
                            </td>

                            {{-- TANGGAL BAYAR --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->format('d M Y H:i') }}
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-100 text-green-700 px-3 py-1 rounded-md hover:bg-green-200 transition">
                                    Verifikasi
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p>Belum ada data pembayaran masuk.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection