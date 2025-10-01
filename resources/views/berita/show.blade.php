@extends('layouts.app', ['title' => $berita->judul])

@section('content')
<div class="pt-24 bg-white">
    <div class="py-16 md:py-20">
        <div class="max-w-screen-lg mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $berita->judul }}</h1>
            <p class="text-gray-500 text-sm mb-8">
                Dipublikasikan pada {{ $berita->created_at->translatedFormat('d F Y') }}
            </p>

            @if($berita->getMedia('berita_images')->count() > 0)
                <div class="mb-8 grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($berita->getMedia('berita_images') as $media)
                        <a href="{{ $media->getUrl() }}" target="_blank">
                            <img src="{{ $media->getUrl() }}" alt="Gambar Berita" class="rounded-lg shadow-md w-full h-auto object-cover">
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="prose max-w-none">
                {!! $berita->isi !!}
            </div>
        </div>
    </div>
</div>
@endsection