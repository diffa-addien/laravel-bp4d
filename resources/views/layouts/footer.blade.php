{{-- resources/views/layouts/footer.blade.php --}}
<footer class="bg-gray-900 text-white">
    <div class="max-w-screen-xl mx-auto p-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Kolom 1: Info Instansi --}}
            <div>
                <h3 class="font-bold text-lg mb-4">BP4D Halmahera Timur</h3>
                <p class="text-gray-400">
                    Badan Perencanaan Pembangunan, Penelitian dan Pengembangan Daerah
                    <br>
                    Jl. Lintas Halmahera, Kota Maba,
                    <br>
                    Kabupaten Halmahera Timur, Maluku Utara.
                </p>
            </div>
            {{-- Kolom 2: Tautan Cepat --}}
            <div>
                <h3 class="font-bold text-lg mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-sky-400">Profil</a></li>
                    <li><a href="#" class="hover:text-sky-400">Berita</a></li>
                    <li><a href="#" class="hover:text-sky-400">Dokumen</a></li>
                    <li><a href="#" class="hover:text-sky-400">Kontak</a></li>
                </ul>
            </div>
            {{-- Kolom 3: Media Sosial --}}
            <div>
                <h3 class="font-bold text-lg mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-sky-400"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-gray-400 hover:text-sky-400"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-gray-400 hover:text-sky-400"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-700 pt-6 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} BP4D Halmahera Timur. All rights reserved.</p>
        </div>
    </div>
</footer>