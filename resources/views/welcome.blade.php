{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app', ['title' => 'Beranda'])

@section('content')

{{-- Hero Section --}}
<section class="relative h-[60vh] md:h-screen bg-cover bg-center flex items-center justify-center text-white overflow-hidden" style="background-image: url('{{ $heroImageUrl ?? 'https://picsum.photos/1920/1080?grayscale&blur=2' }}');">
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-black/50"></div>
    <div class="relative z-10 text-center px-4">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 leading-tight">
            {{ $settings['hero_title']->value ?? 'BP4D Halmahera Timur' }}
        </h1>
        <p class="text-lg md:text-xl font-light text-gray-200">
            {{ $settings['hero_subtitle']->value ?? 'Mewujudkan Perencanaan Pembangunan...' }}
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
<section class="py-16 md:py-24 bg-gray-100">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold">Berita Terbaru</h2>
            <p class="text-gray-600 mt-2">Informasi dan kegiatan terkini dari BP4D Halmahera Timur.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestBeritas as $berita)
                <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                    <a href="{{ route('berita.show', $berita) }}">
                        <img src="{{ $berita->getFirstMediaUrl('berita_images') ?: 'https://picsum.photos/seed/news1/600/400' }}" alt="Gambar Berita" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                    </a>
                    <div class="p-6">
                        <span class="text-sm text-gray-500">{{ $berita->created_at->translatedFormat('d F Y') }}</span>
                        <h3 class="font-bold text-xl mt-2 mb-3">
                            <a href="{{ route('berita.show', $berita) }}" class="hover:text-sky-600">{{ $berita->judul }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ Str::limit(strip_tags($berita->isi), 100) }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
            @endforelse
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('berita.index') }}" class="px-6 py-3 bg-sky-600 text-white font-semibold rounded-lg shadow-md hover:bg-sky-700 transition-colors">Lihat Semua Berita</a>
        </div>
    </div>
</section>

@if($latestAgenda)
<section class="py-16 md:py-24 bg-gray-800 text-white">
    <div class="max-w-screen-xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-10">Agenda Terbaru</h2>

        <div class="bg-gray-900 rounded-lg shadow-lg p-8 max-w-4xl mx-auto text-left flex flex-col md:flex-row items-center gap-8">
            <div class="text-center">
                <div class="text-5xl font-bold text-sky-400">{{ $latestAgenda->tanggal->format('d') }}</div>
                <div class="text-xl font-semibold">{{ $latestAgenda->tanggal->translatedFormat('F Y') }}</div>
            </div>
            <div class="border-l border-gray-700 pl-8 flex-grow">
                <h3 class="font-bold text-2xl mb-2">{{ $latestAgenda->judul }}</h3>
                <p class="text-gray-400 mb-4"><i class="fa-solid fa-location-dot mr-2"></i>{{ $latestAgenda->lokasi }}</p>
                <a href="{{ route('agenda.show', $latestAgenda) }}" class="inline-block text-sky-400 font-semibold hover:text-sky-300">
                    Lihat Detail <i class="fa-solid fa-arrow-right fa-xs ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

@endsection