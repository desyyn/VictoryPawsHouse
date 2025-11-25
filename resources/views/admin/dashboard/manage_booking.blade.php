@extends('layouts.admin')

@section('title', 'Manajemen Booking')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Booking</h1>

<div class="p-6 bg-white rounded-xl shadow-lg">
    <p class="text-gray-600">Halaman ini menampilkan daftar pesanan dengan rincian layanan yang dipilih oleh customer.</p>

    <div class="mt-6 overflow-x-auto"> {{-- Tambah overflow-x-auto agar responsif di HP --}}
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Customer</th>
                    {{-- KOLOM LAYANAN (YANG AKAN KITA ISI LOOPING) --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rincian Layanan</th>
                    {{-- TAMBAHAN KOLOM TOTAL --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($bookings as $booking)
                <tr class="hover:bg-gray-50 transition duration-150">

                    {{-- ID BOOKING --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                        #{{ $booking->id_booking }}
                    </td>

                    {{-- NAMA CUSTOMER --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        {{ $booking->nama }}
                        <div class="text-xs text-gray-400">{{ $booking->nomor_hp }}</div>
                    </td>

                    {{-- [BAGIAN YANG DIGANTI] RINCIAN LAYANAN --}}
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($booking->details as $detail)
                            <li>
                                {{-- Ambil Nama Layanan dari Relasi --}}
                                <span class="font-medium text-gray-700">
                                    {{ $detail->layanan->nama_layanan ?? 'Layanan Dihapus' }}
                                </span>

                                {{-- Tampilkan Harga Satuan (Optional) --}}
                                <span class="text-xs text-gray-400 ml-1">
                                    (Rp {{ number_format($detail->harga_saat_ini, 0, ',', '.') }})
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </td>

                    {{-- TOTAL HARGA --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#6b4423]">
                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                    </td>

                    {{-- JADWAL --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex flex-col">
                            <span>Check-in: {{ \Carbon\Carbon::parse($booking->jadwal)->format('d M Y') }}</span>
                            @if($booking->tanggal_checkout)
                            <span class="text-xs text-gray-400">Out: {{ \Carbon\Carbon::parse($booking->tanggal_checkout)->format('d M Y') }}</span>
                            @endif
                            @if($booking->jam_booking)
                            <span class="text-xs text-orange-600 font-bold">Jam: {{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}</span>
                            @endif
                        </div>
                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                        $statusColor = match(strtolower($booking->status)) {
                        'selesai', 'dibayar' => 'bg-green-100 text-green-800',
                        'pending', 'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                        'ditolak', 'batal' => 'bg-red-100 text-red-800',
                        default => 'bg-gray-100 text-gray-800',
                        };
                        @endphp
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3 font-bold">Detail</a>
                        <a href="#" class="text-red-600 hover:text-red-900">PDF</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <p>Belum ada data booking yang masuk.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection