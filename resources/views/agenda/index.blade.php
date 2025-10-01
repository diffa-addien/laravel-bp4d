@extends('layouts.app', ['title' => 'Agenda'])

@section('content')
<div class="pt-24 bg-gray-100">
    <div class="py-16 md:py-24">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold">Agenda Kegiatan</h1>
                <p class="text-gray-600 mt-2">Jadwal kegiatan yang akan datang dan yang telah lampau.</p>
            </div>
            <div class="space-y-8">
                @forelse($agendas as $agenda)
                    <a href="{{ route('agenda.show', $agenda) }}" class="flex flex-col md:flex-row items-center bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="w-full md:w-1/4 p-4 text-center border-b md:border-b-0 md:border-r border-gray-200">
                            <div class="text-3xl font-bold text-sky-600">{{ $agenda->tanggal->format('d') }}</div>
                            <div class="text-lg font-semibold">{{ $agenda->tanggal->translatedFormat('F Y') }}</div>
                        </div>
                        <div class="p-6 flex-grow">
                            <h3 class="font-bold text-xl mb-1 hover:text-sky-600">{{ $agenda->judul }}</h3>
                            <p class="text-gray-600 text-sm"><i class="fa-solid fa-location-dot mr-2"></i>{{ $agenda->lokasi }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-center text-gray-500">Belum ada agenda yang dipublikasikan.</p>
                @endforelse
            </div>
            <div class="mt-12">
                {{ $agendas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection