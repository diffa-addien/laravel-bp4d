@extends('layouts.app', ['title' => 'Berita'])

@section('content')
<div class="pt-24 bg-gray-100">
    <div class="py-16 md:py-24">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold">Berita & Informasi</h1>
                <p class="text-gray-600 mt-2">Kumpulan berita dan informasi terbaru.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($beritas as $berita)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                        <a href="{{ route('berita.show', $berita) }}">
                            <img src="{{ $berita->getFirstMediaUrl('berita_images') ?: 'https://picsum.photos/seed/news1/600/400' }}" alt="Gambar Berita" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                        </a>
                        <div class="p-6">
                            <span class="text-sm text-gray-500">{{ $berita->created_at->translatedFormat('d F Y') }}</span>
                            <h3 class="font-bold text-xl mt-2 mb-3">
                                <a href="{{ route('berita.show', $berita) }}" class="hover:text-sky-600">{{ $berita->judul }}</a>
                            </h3>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
                @endforelse
            </div>
            <div class="mt-12">
                {{ $beritas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection