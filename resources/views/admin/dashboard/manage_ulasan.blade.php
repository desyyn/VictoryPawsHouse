@extends('layouts.admin')

@section('title', 'Manajemen Ulasan')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Ulasan Pelanggan</h1>

    <div class="p-6 bg-white rounded-xl shadow-lg">
        <p class="text-gray-600">Halaman ini menampilkan semua ulasan dari pelanggan dan memberikan kemampuan bagi Admin untuk membalas ulasan tersebut.</p>
        
        <div class="mt-6 space-y-4">
            @forelse ($reviews as $review)
                <div class="border p-4 rounded-lg shadow-sm bg-gray-50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-bold text-gray-800">{{ $review->pengguna->username ?? 'Pengguna Dihapus' }}</p>
                            <p class="text-sm text-gray-500">Rating: 
                                <span class="text-yellow-500">
                                    {{ str_repeat('⭐', $review->rating) }} ({{ $review->rating }}/5)
                                </span>
                            </p>
                            <p class="text-xs text-gray-400 mt-1">Tanggal: {{ \Carbon\Carbon::parse($review->tanggal)->translatedFormat('d M Y H:i') }}</p>
                        </div>
                        <button class="bg-indigo-600 text-white text-xs py-1 px-3 rounded hover:bg-indigo-700">
                            Balas Ulasan
                        </button>
                    </div>
                    <p class="mt-3 text-gray-700 italic border-l-2 border-gray-300 pl-3">"{{ $review->komentar }}"</p>
                    {{-- Area untuk Balasan Admin (Opsional) --}}
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada ulasan dari pelanggan.</p>
            @endforelse
        </div>
    </div>
@endsection