{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app', ['title' => 'Beranda'])

@section('content')

{{-- Hero Section --}}
<section class="relative h-[60vh] md:h-screen bg-cover bg-center flex items-center justify-center text-white overflow-hidden" style="background-image: url('https://picsum.photos/1920/1080?grayscale&blur=2');">
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-black/50"></div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 leading-tight">
            BP4D Halmahera Timur
        </h1>
        <p class="text-lg md:text-xl font-light text-gray-200">
            Mewujudkan Perencanaan Pembangunan Daerah yang Berkualitas, Inovatif, dan Berkelanjutan.
        </p>
    </div>

    {{-- Shape Divider (Wave) --}}
    <div class="absolute bottom-0 left-0 w-full z-10">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f3f4f6" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,202.7C384,192,480,160,576,144C672,128,768,128,864,154.7C960,181,1056,235,1152,240C1248,245,1344,203,1392,181.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

{{-- Berita Terbaru Section (background now matches shape divider) --}}
<section class="py-16 md:py-24 bg-gray-100"> {{-- Ubah bg-white menjadi bg-gray-100 agar sesuai warna shape divider --}}
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold">Berita Terbaru</h2>
            <p class="text-gray-600 mt-2">Informasi dan kegiatan terkini dari BP4D Halmahera Timur.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Dummy Berita Card 1 --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                <img src="https://picsum.photos/seed/news1/600/400" alt="Gambar Berita" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="p-6">
                    <span class="text-sm text-gray-500">25 September 2025</span>
                    <h3 class="font-bold text-xl mt-2 mb-3 hover:text-sky-600 cursor-pointer">Musrenbang RKPD Tahun 2026</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">BP4D berhasil menyelenggarakan Musyawarah Perencanaan Pembangunan (Musrenbang) Rencana Kerja...</p>
                </div>
            </div>
            {{-- Dummy Berita Card 2 --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                <img src="https://picsum.photos/seed/news2/600/400" alt="Gambar Berita" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="p-6">
                    <span class="text-sm text-gray-500">22 September 2025</span>
                    <h3 class="font-bold text-xl mt-2 mb-3 hover:text-sky-600 cursor-pointer">Forum Konsultasi Publik Rancangan Awal</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Dalam rangka penyempurnaan rancangan awal, BP4D mengundang seluruh elemen masyarakat untuk...</p>
                </div>
            </div>
            {{-- Dummy Berita Card 3 --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                <img src="https://picsum.photos/seed/news3/600/400" alt="Gambar Berita" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="p-6">
                    <span class="text-sm text-gray-500">18 September 2025</span>
                    <h3 class="font-bold text-xl mt-2 mb-3 hover:text-sky-600 cursor-pointer">Pelatihan Inovasi Daerah untuk ASN</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Peningkatan kapasitas aparatur sipil negara menjadi fokus utama dalam pelatihan inovasi daerah...</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection