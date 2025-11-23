@extends('layouts.admin')
@section('content')
<div class="min-h-screen p-0"> 
    
    {{-- KPI CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        {{-- Card 1: Total Orders (Kita ubah style card agar mirip gambar) --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-200">
            <div class="p-3 bg-[#EBF0FF] rounded-lg text-indigo-600 relative">
                {{-- Ganti icon jadi yang mirip kertas/dokumen --}}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2m-9 0V3h4v2m-4 0h4"></path></svg>
                <span class="absolute -top-1 -right-1 p-0.5 bg-white rounded-full border border-indigo-500"><svg class="w-3 h-3 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 13.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></span>
                {{-- Icon Checklist Kecil Hijau --}}
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">{{ number_format($totalOrders) }}</p>
                {{-- Tambah info 4% (30 days) --}}
                <p class="text-xs text-gray-500">Total Orders <span class="text-green-500">4% (30 days)</span></p>
            </div>
        </div>

        {{-- Card 2: Total Canceled (Kita ubah style card agar mirip gambar) --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-200">
            <div class="p-3 bg-[#FFE8E8] rounded-lg text-red-600 relative">
                {{-- Ganti icon jadi yang mirip kertas/dokumen --}}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2m-9 0V3h4v2m-4 0h4"></path></svg>
                <span class="absolute -top-1 -right-1 p-0.5 bg-white rounded-full border border-red-500"><svg class="w-3 h-3 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></span>
                {{-- Icon X Kecil Merah --}}
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">{{ number_format($totalCanceled) }}</p>
                {{-- Tambah info 25% (30 days) --}}
                <p class="text-xs text-gray-500">Total Canceled <span class="text-red-500">25% (30 days)</span></p>
            </div>
        </div>

        {{-- Card 3: Total Revenue (Kita ubah style card agar mirip gambar) --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-200">
            <div class="p-3 bg-[#E0FFF2] rounded-lg text-green-600 relative">
                {{-- Ganti icon jadi yang mirip tas belanja/keranjang --}}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="absolute -top-1 -right-1 p-0.5 bg-white rounded-full border border-green-500"><svg class="w-3 h-3 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 13.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></span>
                {{-- Icon Checklist Kecil Hijau --}}
            </div>
            <div>
                <p class="text-2xl font-extrabold text-gray-900">$128</p> 
                {{-- Ubah format uang ke $128, dan tambah info 12% (30 days) --}}
                <p class="text-xs text-gray-500">Total Revenue <span class="text-green-500">12% (30 days)</span></p>
                
            </div>
        </div>
    </div>
    
    {{-- GRAPHS & LATEST TRANSACTIONS --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Kolom Kiri: PIE CHART & LATEST TRANSACTIONS --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- PIE CHART --}}
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="flex items-center space-x-6 mb-8">
                    <label class="flex items-center space-x-2 text-sm text-gray-600">
                        <input type="checkbox" class="form-checkbox text-gray-600"> 
                        <span>Chart</span>
                    </label>
                    <label class="flex items-center space-x-2 text-sm text-gray-600">
                        <input type="checkbox" class="form-checkbox text-gray-600"> 
                        <span>Show Value</span>
                    </label>
                </div>
                <div class="flex justify-around items-center text-center">
                    
                    {{-- Placeholder Pie Chart 1: Total Order --}}
                    <div>
                        {{-- Ganti dengan div ber-warna untuk simulasi pie chart --}}
                        <div class="relative h-32 w-32 mx-auto">
                            {{-- Simulasikan Pie Chart 81% (Merah & Krem) --}}
                            <div class="absolute inset-0 rounded-full bg-red-500" style="clip-path: polygon(0 0, 50% 0, 50% 50%, 0 50%, 0 0)"></div>
                            <div class="absolute inset-0 rounded-full bg-gray-200" style="clip-path: polygon(50% 0, 100% 0, 100% 100%, 50% 100%, 50% 0)"></div>
                            <div class="absolute inset-0 flex items-center justify-center rounded-full text-xl font-bold text-gray-900">
                                81%
                            </div>
                        </div>
                        <p class="mt-3 font-semibold text-gray-700">Total Order</p>
                    </div>

                    {{-- Placeholder Pie Chart 2: Total Revenue --}}
                    <div>
                        {{-- Ganti dengan div ber-warna untuk simulasi pie chart --}}
                        <div class="relative h-32 w-32 mx-auto">
                            {{-- Simulasikan Pie Chart 62% (Biru & Krem) --}}
                            <div class="absolute inset-0 rounded-full bg-blue-500" style="clip-path: polygon(50% 0, 100% 0, 100% 100%, 50% 100%, 50% 0)"></div>
                            <div class="absolute inset-0 rounded-full bg-gray-200" style="clip-path: polygon(0 0, 50% 0, 50% 50%, 0 50%, 0 0)"></div>
                            <div class="absolute inset-0 flex items-center justify-center rounded-full text-xl font-bold text-gray-900">
                                62%
                            </div>
                        </div>
                        <p class="mt-3 font-semibold text-gray-700">Total Revenue</p>
                    </div>
                </div>
            </div>
            
            {{-- LATEST TRANSACTIONS --}}
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Latest Transaction</h3>
                    <a href="{{ route('admin.booking.index') }}" class="text-sm text-gray-600 hover:text-gray-800 font-medium">Show All</a>
                </div>
                
                {{-- Kita pake list yang lebih mirip gambar --}}
                <ul class="divide-y divide-gray-100">
                    @forelse ($latestTransactions as $transaction)
                        <li class="py-3 flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                {{-- Icon Transaksi --}}
                                <div class="p-2 bg-[#E0FFF2] rounded-full text-green-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9a1 1 0 00-1-1H5a1 1 0 00-1 1v6a1 1 0 001 1h4a1 1 0 001-1v-1m5-7a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $transaction->tipe_layanan ?? 'Transaksi Non-Booking' }}</p>
                                    <p class="text-xs text-gray-500">
                                        Today, {{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('H:i') }}
                                    </p>
                                </div>
                            </div>
                            <span class="text-base font-bold text-gray-900">
                                Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}
                            </span>
                        </li>
                    @empty
                        <li class="py-3 text-center text-gray-500">Belum ada transaksi dalam sistem.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Kolom Kanan: CUSTOMER MAP (Bar Chart Placeholder) --}}
        <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Customer Map</h3>
                {{-- Ubah style select jadi lebih flat dan kecil --}}
                <select class="text-sm border border-gray-300 rounded-lg p-1.5 focus:ring-0 focus:border-gray-400">
                    <option>Weekly</option>
                    <option>Monthly</option>
                </select>
            </div>
            
            {{-- Bar Chart Placeholder (Simulasi Bar Chart dari gambar) --}}
            <div class="h-64 relative">
                {{-- Sumbu Y --}}
                <div class="absolute inset-y-0 left-0 w-full flex flex-col justify-end pb-8 text-xs text-gray-400">
                    <p class="h-1/4 flex items-end">80</p>
                    <p class="h-1/4 flex items-end">60</p>
                    <p class="h-1/4 flex items-end">40</p>
                    <p class="h-1/4 flex items-end">20</p>
                </div>

                {{-- Bar Chart (Simulasi) --}}
                <div class="h-full pt-10 flex items-end space-x-3 justify-between pl-6 pr-2">
                    {{-- Data 1 (Merah: ~60) --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-red-400 rounded-t-sm" style="height: 75%;"></div>
                        <span class="text-xs text-gray-600 mt-1">Sun</span>
                    </div>
                    {{-- Data 2 (Kuning: ~80) --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-yellow-400 rounded-t-sm" style="height: 100%;"></div>
                        <span class="text-xs text-gray-600 mt-1">Sun</span>
                    </div>
                    {{-- Data 3 (Merah: ~40) --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-red-400 rounded-t-sm" style="height: 50%;"></div>
                        <span class="text-xs text-gray-600 mt-1">Sun</span>
                    </div>
                    {{-- Data 4 (Kuning: ~65) --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-yellow-400 rounded-t-sm" style="height: 81%;"></div>
                        <span class="text-xs text-gray-600 mt-1">Sun</span>
                    </div>
                    {{-- Data 5 (Merah: ~60) --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-red-400 rounded-t-sm" style="height: 75%;"></div>
                        <span class="text-xs text-gray-600 mt-1">Sun</span>
                    </div>
                    {{-- Data 6 (Kuning: ~25) --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-yellow-400 rounded-t-sm" style="height: 31%;"></div>
                        <span class="text-xs text-gray-600 mt-1">Sun</span>
                    </div>
                    {{-- Data 7 (Merah: ~60) --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-red-400 rounded-t-sm" style="height: 75%;"></div>
                        <span class="text-xs text-gray-600 mt-1">Sun</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection