<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Profil Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <!-- TAMPILAN SEMENTARA YANG AMAN -->
                <h3 class="text-lg font-bold mb-4">Informasi Pengguna</h3>
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p class="mt-4 text-sm text-gray-600">
                    Fitur lengkap untuk Edit Profil, Ganti Password, dan Hapus Akun akan diaktifkan di sini setelah kita fokus pada alur transaksi inti.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>