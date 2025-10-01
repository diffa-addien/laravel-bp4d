<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'BP4D Halmahera Timur' }}</title>

    {{-- Tailwind CSS & Font Awesome from CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Alpine.js from CDN --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Custom Font (Inter) from Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <script>
        (function () {
            // Dapatkan tanggal hari ini dalam format YYYY-MM-DD
            const today = new Date().toISOString().slice(0, 10);

            // Ambil tanggal kunjungan terakhir dari localStorage
            const lastVisitDate = localStorage.getItem('lastVisitDate');

            // Jika belum pernah berkunjung atau kunjungan terakhir bukan hari ini
            if (lastVisitDate !== today) {
                console.log('Pengunjung unik hari ini, mengirim data...');

                // Kirim permintaan ke API untuk mencatat kunjungan
                fetch('/api/track-visit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                    .then(response => {
                        if (response.ok) {
                            // Jika berhasil, simpan tanggal hari ini ke localStorage
                            localStorage.setItem('lastVisitDate', today);
                            console.log('Kunjungan berhasil dicatat.');
                        }
                    })
                    .catch(error => console.error('Gagal mencatat kunjungan:', error));
            } else {
                console.log('Pengunjung hari ini sudah dihitung.');
            }
        })();
    </script>

</body>

</html>