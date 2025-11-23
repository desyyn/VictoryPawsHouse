<header>
    <nav class="bg-[#F8F4E1] shadow" style="border-bottom: 5px solid #543310;">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-20">

            <div class="flex items-start space-x-3">
                <img src="{{ asset('images/paw.png') }}" alt="paw" class="w-10 h-10 mt-1">

                <div>
                    <div class="text-2xl font-bold text-gray-900">VICTORY PAWSHOUSE</div>
                    <p class="text-xs text-gray-700 leading-tight">
                        GROOMING & PET CARE BANJARMASIN <br>
                    </p>
                </div>
            </div>

            <!-- KANAN: Hello + Logout -->
            <div class="flex items-center space-x-3 font-bold uppercase">
                <span class="text-sm">HELLO, {{ strtoupper(Auth::user()->username) }}</span>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <span class="text-sm">|</span>
                    <button type="submit" class="hover:underline text-sm ml-2 font-bold uppercase">
                        LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>
