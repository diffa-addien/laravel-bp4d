{{-- resources/views/halaman.blade.php --}}
@extends('layouts.app')

@section('content')
{{-- Spacer untuk Navbar --}}
<div class="pt-24"></div>

<section class="bg-white py-16 md:py-20">
    <div class="max-w-screen-xl mx-auto px-4">
        {{-- Judul Halaman --}}
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-4">{{ $halaman->judul }}</h1>
        <p class="text-center text-gray-500 text-sm mb-12">
            Kategori: {{ ucfirst($halaman->kategori) }} | Terakhir diperbarui: {{ $halaman->updated_at->format('d F Y') }}
        </p>

        {{-- Konten Halaman --}}
        <div class="prose max-w-none">
            {!! $halaman->isi !!}
        </div>
    </div>
</section>
@endsection