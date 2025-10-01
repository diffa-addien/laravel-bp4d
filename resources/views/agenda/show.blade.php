@extends('layouts.app', ['title' => $agenda->judul])

@section('content')
<div class="pt-24 bg-white">
    <div class="py-16 md:py-20">
        <div class="max-w-screen-lg mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $agenda->judul }}</h1>
            <div class="flex items-center text-gray-500 text-sm mb-8 space-x-6">
                <span><i class="fa-solid fa-calendar-days mr-2"></i>{{ $agenda->tanggal->translatedFormat('l, d F Y') }}</span>
                <span><i class="fa-solid fa-location-dot mr-2"></i>{{ $agenda->lokasi }}</span>
            </div>

            @if($agenda->getMedia('agenda_images')->count() > 0)
                <div class="mb-8 grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($agenda->getMedia('agenda_images') as $media)
                        <a href="{{ $media->getUrl() }}" target="_blank">
                            <img src="{{ $media->getUrl() }}" alt="Gambar Agenda" class="rounded-lg shadow-md w-full h-auto object-cover">
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="prose max-w-none">
                {!! $agenda->isi !!}
            </div>
        </div>
    </div>
</div>
@endsection