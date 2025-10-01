@extends('layouts.app', ['title' => 'Dokumen'])

@section('content')
<div class="pt-24 bg-gray-100 min-h-screen">
    <div class="py-16 md:py-24">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold">Pusat Dokumen</h1>
                <p class="text-gray-600 mt-2">Unduh dokumen publik yang telah kami sediakan.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul Dokumen
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($dokumens as $dokumen)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $dokumen->judul }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $dokumen->deskripsi ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ $dokumen->getFirstMediaUrl('dokumens') }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-700">
                                        <i class="fa-solid fa-download mr-2"></i> Unduh
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                    Belum ada dokumen yang diunggah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-8">
                {{ $dokumens->links() }}
            </div>
        </div>
    </div>
</div>
@endsection