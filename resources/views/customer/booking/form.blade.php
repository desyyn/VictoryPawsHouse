@extends('layouts.app') 

@section('title', 'Form Booking Layanan')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="bg-[#f6e3d3] rounded-xl shadow-2xl overflow-hidden md:grid md:grid-cols-3">
            
            <!-- KOLOM KIRI: FORMULIR -->
            <div class="md:col-span-2 p-8 md:p-12">
                <h2 class="text-3xl font-extrabold text-[#6b4423] mb-6">Select Service(s)</h2>
                <p class="text-gray-700 mb-8">Please select any services you're interested in and fill out the form</p>

                <!-- FORM -->
                <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                    @csrf
                    
                    {{-- Pesan Error Validasi Umum --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong class="font-bold">Whoops!</strong>
                            <span class="block sm:inline">Ada beberapa masalah pada input Anda.</span>
                        </div>
                    @endif

                    {{-- 1. PILIH LAYANAN (CHECKBOX/BOX) --}}
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-[#6b4423] mb-3">Select Service(s) *</label>
                        <div class="flex space-x-6">
                            @php 
                                $services = ['Pet Grooming', 'Pet Hotel', 'Home Service'];
                                // Harga dasar diambil dari Controller $layananHarga
                            @endphp
                            @foreach($services as $service)
                            {{-- Setiap label memiliki data-harga dasar --}}
                            <label class="flex flex-col items-center p-4 border-2 rounded-xl cursor-pointer transition duration-200 service-option hover:border-[#6b4423] hover:bg-white" data-service="{{ $service }}">
                                <input type="checkbox" name="layanan_pilih[]" value="{{ $service }}" class="hidden service-checkbox">
                                <span class="text-3xl mb-1">
                                    {{ $service === 'Pet Grooming' ? '🛁' : ($service === 'Pet Hotel' ? '🏨' : '🏡') }}
                                </span>
                                <span class="text-sm font-semibold text-gray-700">{{ $service }}</span>
                            </label>
                            @endforeach
                        </div>
                         @error('layanan_pilih') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        
                        {{-- Nama Anda (Nama Pengguna) --}}
                        <div>
                            <label for="nama_anda" class="block text-sm font-bold text-[#6b4423] mb-1">Nama Anda *</label>
                            <input type="text" name="nama_anda" id="nama_anda" required value="{{ Auth::user()->username }}"
                                   class="w-full border-gray-300 rounded-lg shadow-sm p-3">
                        </div>

                        {{-- Nama Hewan --}}
                        <div>
                            <label for="nama_hewan" class="block text-sm font-bold text-[#6b4423] mb-1">Nama Hewan *</label>
                            <input type="text" name="nama_hewan" id="nama_hewan" required
                                   class="w-full border-gray-300 rounded-lg shadow-sm p-3">
                        </div>

                        {{-- Tipe Layanan --}}
                        <div>
                            <label for="tipe_layanan" class="block text-sm font-bold text-[#6b4423] mb-1">Tipe Layanan *</label>
                            <select name="tipe_layanan" id="tipe_layanan" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3">
                                <option value="">Pilih Tipe Layanan</option>
                                <option value="Grooming">Pet Grooming</option>
                                <option value="Hotel">Pet Hotel</option>
                                <option value="Home Service">Home Service</option>
                            </select>
                        </div>
                        
                        {{-- Nomor HP --}}
                        <div>
                            <label for="nomor_hp" class="block text-sm font-bold text-[#6b4423] mb-1">Nomor HP *</label>
                            <input type="text" name="nomor_hp" id="nomor_hp" required 
                                   class="w-full border-gray-300 rounded-lg shadow-sm p-3">
                        </div>

                        {{-- Jenis Hewan --}}
                        <div>
                            <label for="jenis_hewan" class="block text-sm font-bold text-[#6b4423] mb-1">Jenis Hewan *</label>
                            <select name="jenis_hewan" id="jenis_hewan" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3">
                                <option value="">Pilih Jenis</option>
                                <option value="Anjing">Anjing</option>
                                <option value="Kucing">Kucing</option>
                            </select>
                        </div>

                        {{-- Jadwal (Start Date/Check-in) --}}
                        <div>
                            <label for="jadwal" class="block text-sm font-bold text-[#6b4423] mb-1">Jadwal (Mulai Layanan/Check-in) *</label>
                            <input type="date" name="jadwal" id="jadwal" required 
                                   min="{{ now()->format('Y-m-d') }}"
                                   class="w-full border-gray-300 rounded-lg shadow-sm p-3 total-calculation">
                        </div>
                        
                        {{-- Jenis Kelamin Hewan --}}
                        <div>
                            <label for="gender_hewan" class="block text-sm font-bold text-[#6b4423] mb-1">Jenis Kelamin Hewan *</label>
                            <select name="gender_hewan" id="gender_hewan" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3">
                                <option value="">Pilih Gender</option>
                                <option value="Jantan">Jantan</option>
                                <option value="Betina">Betina</option>
                            </select>
                        </div>
                        
                        {{-- Durasi (Check-out) - Hanya Muncul jika Pet Hotel dipilih --}}
                        <div id="checkout-field" class="hidden">
                            <label for="jadwal_checkout" class="block text-sm font-bold text-[#6b4423] mb-1">Durasi (Check-out) *</label>
                            <input type="date" name="jadwal_checkout" id="jadwal_checkout"
                                   class="w-full border-gray-300 rounded-lg shadow-sm p-3 total-calculation" disabled>
                        </div>
                        
                        {{-- Catatan --}}
                        <div class="col-span-2">
                            <label for="catatan" class="block text-sm font-bold text-[#6b4423] mb-1">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3"
                                      class="w-full border-gray-300 rounded-lg shadow-sm p-3"></textarea>
                        </div>
                        
                    </div>
                </form>
            </div>
            
            <!-- KOLOM KANAN: Contact & Total -->
            <div class="md:col-span-1 p-8 bg-[#c0a880] text-white">
                
                {{-- Contact Us --}}
                <h2 class="text-3xl font-extrabold mb-6">Contact Us</h2>
                <div class="space-y-4 text-sm">
                    <p>We're open for any suggestion or just to have a chat!</p>
                    <p class="flex items-center space-x-2"><span class="text-lg">📞</span><span>Phone: 08111511050</span></p>
                    <p class="flex items-center space-x-2"><span class="text-lg">📧</span><span>Email: VictoryPawsHouse@gmail.com</span></p>
                    <p class="flex items-start space-x-2"><span class="text-lg">📍</span><span>Address: Jl. Veteran no.11,13,15,17, RT.7/RW.1, Kota Banjarmasin, Kalimantan Selatan</span></p>
                </div>
                
                {{-- Total & Button --}}
                <div class="mt-12 p-4 bg-white bg-opacity-30 rounded-xl text-lg font-bold text-gray-800 flex justify-between shadow-inner">
                    <span>Total Estimasi:</span>
                    <span id="total-estimasi-harga">Rp 0</span>
                </div>
                
                <button type="submit" form="booking-form"
                        class="w-full mt-6 bg-custom-brown text-white font-bold py-3 rounded-xl shadow-lg hover:bg-[#4a3719] transition duration-300">
                    Booking sekarang
                </button>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalSpan = document.getElementById('total-estimasi-harga');
            const checkboxes = document.querySelectorAll('.service-checkbox');
            const hotelServices = ['Pet Hotel'];
            const groomingServices = ['Pet Grooming', 'Home Service'];
            const checkoutField = document.getElementById('checkout-field');
            const jadwalInput = document.getElementById('jadwal');
            const dateInputs = document.querySelectorAll('.total-calculation');
            
            // Harga dasar yang dikirim dari Controller (Model Layanan)
            const basePrices = @json($layananHarga);

            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            });

            function calculateTotal() {
                let total = 0;
                let isHotelSelected = false;

                // 1. Cek Pilihan Layanan dan Tentukan Visibility
                checkboxes.forEach(chk => {
                    const isChecked = chk.checked;
                    const serviceName = chk.value;
                    
                    // Styling
                    const label = chk.closest('label');
                    label.classList.toggle('border-4', isChecked);
                    label.classList.toggle('border-[#6b4423]', isChecked);
                    label.classList.toggle('bg-white', isChecked);

                    if (hotelServices.includes(serviceName)) {
                        isHotelSelected = isChecked;
                    }
                    
                    // Kalkulasi Harga (Grooming & Home Service adalah harga flat)
                    if (groomingServices.includes(serviceName) && isChecked) {
                        total += parseFloat(basePrices[serviceName] || 0);
                    }
                });
                
                // Toggle Durasi/Checkout based on Hotel selection
                checkoutField.classList.toggle('hidden', !isHotelSelected);
                document.getElementById('jadwal_checkout').required = isHotelSelected;
                document.getElementById('jadwal_checkout').disabled = !isHotelSelected;


                // 2. Kalkulasi Harga Hotel (Complex: needs date calculation)
                if (isHotelSelected) {
                    const checkin = new Date(jadwalInput.value);
                    const checkout = new Date(document.getElementById('jadwal_checkout').value);
                    
                    if (checkin && checkout && checkout > checkin) {
                        const diffTime = Math.abs(checkout - checkin);
                        const durasiMalam = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                        
                        const hargaPerMalam = parseFloat(basePrices['Pet Hotel'] || 0);
                        total += hargaPerMalam * durasiMalam;
                    }
                }

                // 3. Update Tampilan Total
                totalSpan.textContent = formatter.format(total);
            }
            
            // 4. Inisialisasi Listener
            checkboxes.forEach(chk => chk.addEventListener('change', calculateTotal));
            dateInputs.forEach(input => input.addEventListener('change', calculateTotal));

            // Initial call
            calculateTotal();
        });
    </script>
    @endpush
@endsection