<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - @yield('title', 'Dashboard') | Victory Paws House</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    @include('partials.adminHeader')

    <div class="min-h-screen flex">
        <div class="w-64 bg-[#AF8F6F] text-white flex flex-col py-6 px-4">
            <div class="p-6 text-center border-b border-gray-700">
                <h1 class="text-xl font-extrabold text-white-400 tracking-wide">DASHBOARD ADMIN</h1>
            </div>
            
            <nav class="flex-grow p-4 space-y-2">
                @php
                    $navItems = [
                        'grafik' => ['Grafik & KPI', 'admin.dashboard'],
                        'booking' => ['Manajemen Booking', 'admin.booking.index'],
                        'pembayaran' => ['Manajemen Pembayaran', 'admin.pembayaran.index'],
                        'katalog' => ['Manajemen Katalog', 'admin.katalog.index'],
                        'event' => ['Manajemen Event', 'admin.event.index'],
                        'ulasan' => ['Manajemen Ulasan', 'admin.ulasan.index'],
                    ];
                    $currentRoute = Route::currentRouteName();
                @endphp

                @foreach ($navItems as $key => $item)
                    @php
                        $isActive = (Str::contains($currentRoute, $key) && $key !== 'grafik') 
                            || ($currentRoute === 'admin.dashboard' && $key === 'grafik');
                    @endphp
                    
                    <a href="{{ route($item[1]) }}" 
                       class="flex items-center space-x-3 p-3 rounded-lg transition duration-200
                       @if ($isActive)
                            !bg-[#543310] text-white shadow-none font-semibold
                       @else
                            hover:bg-[#8b6a4b]
                       @endif">
                        <span>{{ $item[0] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#F8F4E1] p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
