<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layanan - Victory Paws House</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#fcf8f0]">

    <!-- Header atas -->
    <div class="bg-[#6b4423] text-white text-sm py-2">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/ig.png') }}" alt="paw" class="w-5 h-5">
                <a href="https://instagram.com/victorypawshouse" target="_blank" class="hover:underline">victorypawshouse</a>
                <img src="{{ asset('images/wa.png') }}" alt="wa" class="w-5 h-5">
                <span> 08111511050</span>
            </div>

            <!-- Kanan: Auth Links -->
            <div class="flex items-center space-x-4">
                @auth
                    <span>HELLO, {{ strtoupper(Auth::user()->username) }}!</span>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">LOGIN</a> 
                    <a> | </a> 
                    <a href="{{ route('register') }}" class="hover:underline">SIGN UP</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Navbar utama -->
    <nav class="bg-[#f5e8d0] shadow">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-20">
            <!-- Logo dan alamat -->
            <div class="flex items-start space-x-3">
    <img src="{{ asset('images/paw.png') }}" alt="paw" class="w-10 h-10 mt-1">

    <!-- Teks Nama & Alamat -->
    <div>
        <div class="text-2xl font-bold text-gray-900">VICTORY PAWSHOUSE</div>
        <p class="text-xs text-gray-700 leading-tight">
            GROOMING & PET CARE BANJARMASIN <br>
        </p>
    </div>
</div>
                <!-- Navigasi Utama -->
                <div class="flex space-x-6 text-base font-medium">
                    @php $isActive = Request::is('/') || Request::routeIs('home'); @endphp
                    <a href="/" 
                    class="@if ($isActive) 
                                text-gray-900 border-b-2 border-[#6b4423] pb-1 
                            @else 
                                text-gray-700 hover:text-gray-900 
                            @endif">Home</a>
                    @php $isActive = Request::routeIs('layanan.publik.index'); @endphp
                    <a href="{{ route('layanan.publik.index') }}" 
                    class="@if ($isActive) 
                                text-gray-900 border-b-2 border-[#6b4423] pb-1 
                            @else 
                                text-gray-700 hover:text-gray-900 
                            @endif">Layanan</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Katalog</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Booking</a>
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Event</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- KONTEN UTAMA: LAYANAN, PRODUK, DAN EVENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- 1. Grooming & Styling (Layanan) --}}
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border-2 border-gray-100 transform hover:scale-[1.02] transition duration-300">
                <img src="{{ asset($grooming->gambar ?? 'images/placeholder_grooming.jpg') }}" alt="Grooming & Styling" class="w-full h-48 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-custom-brown mb-2">Grooming & Styling</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ $grooming->deskripsi ?? 'Perawatan bulu, kulit, kuku, dan telinga oleh groomer profesional untuk kesehatan dan penampilan prima.' }}
                    </p>
                    <a href="#" class="bg-custom-brown text-white px-6 py-2 rounded-full font-semibold hover:bg-[#4a3719] transition duration-300">
                        Booking Now
                    </a>
                </div>
            </div>

            {{-- 2. Pet Hotel (Layanan) --}}
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border-2 border-gray-100 transform hover:scale-[1.02] transition duration-300">
                <img src="{{ asset($hotel->gambar ?? 'images/placeholder_hotel.jpg') }}" alt="Pet Hotel" class="w-full h-48 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-custom-brown mb-2">Pet Hotel</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ $hotel->deskripsi ?? 'Penginapan aman dan nyaman dengan fasilitas lengkap. Peliharaan terjamin terawat selama Anda berpergian.' }}
                    </p>
                    <a href="#" class="bg-custom-brown text-white px-6 py-2 rounded-full font-semibold hover:bg-[#4a3719] transition duration-300">
                        Booking Now
                    </a>
                </div>
            </div>

            {{-- 3. Home Service (Layanan) --}}
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border-2 border-gray-100 transform hover:scale-[1.02] transition duration-300">
                <img src="{{ asset($home_service->gambar ?? 'images/placeholder_homeservice.jpg') }}" alt="Home Service" class="w-full h-48 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-custom-brown mb-2">Home Service</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ $home_service->deskripsi ?? 'Layanan grooming langsung ke rumah Anda. Praktis, cepat, dan nyaman!' }}
                    </p>
                    <a href="#" class="bg-custom-brown text-white px-6 py-2 rounded-full font-semibold hover:bg-[#4a3719] transition duration-300">
                        Booking Now
                    </a>
                </div>
            </div>
        </div>

        <!-- Bagian Bawah: Event dan Produk -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
            
            {{-- 4. Pet Exhibition (Event) --}}
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border-2 border-gray-100 flex flex-col transform hover:scale-[1.02] transition duration-300">
                <img src="{{ asset($event_display->gambar ?? 'images/placeholder_event.jpg') }}" alt="Pet Exhibition" class="w-full h-64 object-cover">
                <div class="p-6 flex-grow text-center">
                    <h3 class="text-xl font-bold text-custom-brown mb-2">Pet Exhibition</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Ajeng pameran dan kontes menarik. More info on Instagram <a href="https://instagram.com/victorypawshouse" class="text-blue-600 hover:underline">@victorypawshouse</a>
                    </p>
                    <a href="#" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full font-semibold hover:bg-gray-300 transition duration-300">
                        Lihat Detail Event
                    </a>
                </div>
            </div>

            {{-- 5. Pet Supplies (Produk) --}}
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border-2 border-gray-100 flex flex-col transform hover:scale-[1.02] transition duration-300">
                <img src="{{ asset($produk_display->gambar ?? 'images/placeholder_supplies.jpg') }}" alt="Pet Supplies" class="w-full h-64 object-cover">
                <div class="p-6 flex-grow text-center">
                    <h3 class="text-xl font-bold text-custom-brown mb-2">Pet Supplies</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Untuk kebutuhan hewan kesayangan Anda.
                    </p>
                    <a href="#" class="bg-custom-brown text-white px-6 py-2 rounded-full font-semibold hover:bg-[#4a3719] transition duration-300">
                        Shop Now
                    </a>
                </div>
            </div>

        </div>

    </main>
</body>
</html>