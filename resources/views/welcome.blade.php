<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Speed Boat Depari | Danau Lau Kawar</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            scroll-behavior: smooth;
        }

        .text-primary {
            color: #1B4F72;
        }

        .bg-primary {
            background-color: #1B4F72;
        }

        .bg-secondary {
            background-color: #117A65;
        }

        /* Animasi Hero */
        @keyframes slowZoom {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }

        .animate-slow-zoom {
            animation: slowZoom 20s infinite alternate;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 1.5s ease-out;
        }
    </style>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonColor: '#117A65',
                    confirmButtonText: 'Oke'
                });
            });
        </script>
    @endif
</head>

<body class="bg-gray-50 text-gray-800">

    <nav class="bg-[#1B4F72] p-4 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex-1">
                <h1 class="text-xl font-bold tracking-widest italic text-white">DEPARI BOAT</h1>
            </div>

            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>

            <div id="nav-menu"
                class="hidden md:flex flex-1 justify-center items-center space-x-8 font-medium absolute md:relative top-full left-0 w-full md:w-auto bg-[#1B4F72] md:bg-transparent p-5 md:p-0 shadow-xl md:shadow-none z-40">
                <a href="#"
                    class="block py-2 hover:text-teal-300 transition border-b-2 border-transparent hover:border-teal-300">Home</a>
                <a href="#about-section"
                    class="block py-2 hover:text-teal-300 transition border-b-2 border-transparent hover:border-teal-300">Tentang
                    Kami</a>
                @auth
                    <a href="{{ route('tiket.saya') }}"
                        class="py-2 hover:text-teal-300 transition border-b-2 border-transparent hover:border-teal-300 flex items-center">
                        <i class="fas fa-ticket-alt mr-2 text-xs"></i> Tiket Saya
                    </a>
                @endauth

                <div class="md:hidden border-t border-white/20 mt-4 pt-4">
                    @auth
                        <div class="flex items-center justify-between">
                            <span class="italic text-teal-100">{{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 px-3 py-1 rounded text-[10px] font-black uppercase">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('google.login') }}"
                            class="bg-white text-gray-800 px-4 py-2 rounded-full text-center font-bold block">Login
                            Google</a>
                    @endauth
                </div>
            </div>

            <div class="hidden md:flex flex-1 justify-end items-center">
                <div class="flex items-center space-x-5">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center space-x-2 text-teal-100 hover:text-white transition group border-r border-white/20 pr-5">
                                <i class="fas fa-user-shield text-sm group-hover:scale-110 transition"></i>
                                <span class="text-xs font-bold uppercase tracking-widest">Admin</span>
                            </a>
                        @endif
                        <div class="flex items-center space-x-3 bg-white/10 px-4 py-2 rounded-full border border-white/10">
                            <span class="text-xs font-semibold italic text-teal-100">{{ Auth::user()->name }}</span>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();"
                                class="text-[10px] bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md transition font-black uppercase">Logout</a>
                            <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="hidden">@csrf
                            </form>
                        </div>
                    @else
                        <a href="{{ route('google.login') }}"
                            class="flex items-center space-x-2 bg-white text-gray-800 px-4 py-2 rounded-full text-sm font-bold shadow-md hover:bg-gray-100 transition">
                            <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4" alt="Google">
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="relative h-screen flex items-center justify-center text-white overflow-hidden">
        <div class="absolute inset-0 bg-black/40 z-10"></div>
        <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=2070"
            class="absolute inset-0 w-full h-full object-cover scale-105 animate-slow-zoom" alt="Danau Lau Kawar">

        <div class="relative z-20 text-center px-6 max-w-4xl">
            <span class="uppercase tracking-[0.3em] text-xs md:text-sm mb-4 block animate-fade-in">Welcome to Lau
                Kawar</span>
            <h2 class="text-4xl md:text-7xl font-black mb-6 leading-tight drop-shadow-2xl">
                Jelajahi Pesona <span class="text-teal-400">Lau Kawar</span>
            </h2>
            <p class="text-base md:text-2xl mb-10 opacity-90 font-light max-w-2xl mx-auto">
                Nikmati perjalanan speedboat yang aman dan nyaman bersama keluarga di jantung Tanah Karo.
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="#booking"
                    class="bg-[#117A65] hover:bg-teal-700 text-white px-10 py-4 rounded-full text-lg font-bold transition-all transform hover:scale-110 shadow-xl">
                    Pesan Tiket Sekarang
                </a>
            </div>
        </div>
    </header>

    <section id="about-section" class="py-16 md:py-24 bg-white border-b px-6">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('img/tentang-depari.jpeg') }}" alt="Tentang Depari Boat"
                        class="rounded-3xl shadow-2xl w-full h-[300px] md:h-[450px] object-cover border-4 border-white">
                </div>
                <div class="w-full md:w-1/2">
                    <h2
                        class="text-3xl font-bold text-[#1B4F72] mb-6 italic underline decoration-teal-500 underline-offset-8">
                        Tentang DEPARI BOAT</h2>
                    <p class="text-gray-600 leading-relaxed mb-6 text-justify">
                        Depari Boat adalah layanan transportasi air terpercaya di Danau Lau Kawar. Kami berkomitmen
                        memberikan pengalaman perjalanan yang aman, nyaman, dan tak terlupakan bagi setiap wisatawan
                        yang ingin menikmati pesona alam Lau Kawar.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="bg-teal-100 p-3 rounded-lg text-[#117A65]"><i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Alamat Kami</h4>
                                <p class="text-sm text-gray-500 text-pretty">Kawasan Wisata Danau Lau Kawar, Kab. Karo,
                                    Sumatera Utara.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="bg-teal-100 p-3 rounded-lg text-[#117A65]"><i class="fas fa-clock"></i></div>
                            <div>
                                <h4 class="font-bold text-gray-800">Jam Operasional</h4>
                                <p class="text-sm text-gray-500">Setiap Hari: 08:00 - 17:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="py-16 bg-gray-50 px-6">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-[#1B4F72] mb-2">Daftar Layanan & Harga</h2>
            <div class="w-20 h-1 bg-[#117A65] mx-auto mb-12"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto text-left">
                <div
                    class="bg-white border-2 border-gray-100 rounded-2xl p-8 shadow-lg hover:border-[#117A65] transition-all group">
                    <div class="text-[#117A65] mb-4 text-4xl"><i class="fas fa-ship"></i></div>
                    <h3 class="text-2xl font-bold text-[#1B4F72] mb-2">Paket Wisata Keliling</h3>
                    <p class="text-gray-600 mb-6">Menikmati keindahan Danau Lau Kawar dari tengah air dengan durasi
                        15-20 menit.</p>
                    <div class="text-3xl font-bold text-[#117A65]">Rp 50.000 <span
                            class="text-sm text-gray-400 font-normal">/ pax</span></div>
                </div>
                <div
                    class="bg-white border-2 border-gray-100 rounded-2xl p-8 shadow-lg hover:border-[#117A65] transition-all group">
                    <div class="text-[#117A65] mb-4 text-4xl"><i class="fas fa-camera-retro"></i></div>
                    <h3 class="text-2xl font-bold text-[#1B4F72] mb-2">Sesi Prewedding</h3>
                    <p class="text-gray-600 mb-6">Layanan khusus dokumentasi prewedding dengan kapal standby di
                        titik-titik estetik.</p>
                    <div class="text-3xl font-bold text-[#117A65]">Rp 500.000 <span
                            class="text-sm text-gray-400 font-normal">/ Sesi</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white px-6">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[#1B4F72]">Galeri Lau Kawar</h2>
                <div class="w-20 h-1 bg-[#117A65] mx-auto mt-2"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=500"
                    class="w-full h-48 object-cover rounded-xl shadow-md hover:scale-105 transition duration-300">
                <img src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&q=80&w=500"
                    class="w-full h-48 object-cover rounded-xl shadow-md hover:scale-105 transition duration-300">
                <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&q=80&w=500"
                    class="w-full h-48 object-cover rounded-xl shadow-md hover:scale-105 transition duration-300">
                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=500"
                    class="w-full h-48 object-cover rounded-xl shadow-md hover:scale-105 transition duration-300">
            </div>
        </div>
    </section>

    <section id="booking" class="py-16 container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row border">
            <div class="bg-[#1B4F72] text-white p-8 md:w-1/3">
                <h3 class="text-2xl font-bold mb-4">Formulir Pesanan</h3>
                <p class="text-sm opacity-80 mb-8">Silakan isi data kunjungan Anda. Pastikan tanggal dan jumlah orang
                    sesuai.</p>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 text-sm"><i class="fas fa-map-marker-alt"></i> <span>Dermaga
                            Lau Kawar</span></div>
                    <div class="flex items-center space-x-3 text-sm"><i class="fas fa-phone-alt"></i>
                        <span>0812-xxxx-xxxx</span>
                    </div>
                </div>
            </div>

            <div class="p-8 md:w-2/3">
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm border-l-4 border-red-500">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-1">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" required
                                value="{{ Auth::check() ? Auth::user()->name : '' }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-teal-500 outline-none"
                                placeholder="Budi">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Tanggal Kunjungan</label>
                            <input type="date" name="tgl_kunjungan" id="tgl_kunjungan" required
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-teal-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Jumlah Orang</label>
                            <input type="number" name="jumlah_orang" required
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-teal-500 outline-none"
                                min="1">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Kategori Jasa</label>
                            <select name="kategori" required
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-teal-500 outline-none">
                                <option value="wisata">Keliling Danau (Wisata)</option>
                                <option value="prewed">Sesi Prewedding</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-[#117A65] text-white font-bold py-3 rounded-lg hover:bg-teal-700 transition flex justify-center items-center shadow-lg">
                        Booking Sekarang
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-8 text-center">
        <p>&copy; 2026 Speed Boat Depari - Lau Kawar</p>
    </footer>

    <script>
        // Toggle Mobile Menu
        const menuBtn = document.getElementById('mobile-menu-button');
        const navMenu = document.getElementById('nav-menu');
        menuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('hidden');
        });

        // Set min date to today
        const dateInput = document.getElementById('tgl_kunjungan');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    </script>

</body>

</html>