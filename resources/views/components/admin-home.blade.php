<div class="flex-1 p-4 md:p-8 overflow-y-auto">

    <div class="max-w-[1080px] header-with-backdrop-blur text-white shadow-md mb-6 rounded-md">
        <div class="w-full h-full py-20 backdrop-blur-sm hover:backdrop-brightness-50 duration-500 ease-in-out backdrop-brightness-75 flex flex-col lg:flex-row justify-between items-center rounded-md">
            <a href="map" id="scroll-ke-map" class="text-3xl font-semibold mb-1 lg:ml-10 sm:mb-2 lg:mb-0">Al-Aqobah 1</a>
            <div class="flex items-center">
                <span class="lg:mr-10">Selamat datang, {{ Auth::user()->name }}</span>
            </div>
        </div> 
    </div>

    <style>
        .header-with-backdrop-blur {
            background-image: url('/images/masjid/Pic 5_Al-Aqobah 1.jpg');
            background-size: cover;
            background-position-y: 50%;
        }
    </style>


    

          
    {{-- <div class="max-w-[1080px] grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-3 mb-6">
        
         <a href="#jadwal-hari-ini" id="scroll-ke-hari-ini" class="aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] bg-white shadow-md rounded-md p-6 hover:bg-green-200 hover:shadow-lg transition duration-300">
            <h3 class="text-sm sm:text-lg font-semibold mb-2">Jadwal Hari Ini</h3>
                @if($jadwalHariIni->isEmpty())
                    <p class="text-gray-600 text-xs sm:text-sm">Tidak ada jadwal hari ini.</p>
                @else
                    <div class="text-lg sm:text-2xl font-bold text-red-500">{{ $jadwalHariIni->count() }}</div>
                    @if($jadwalHariIni->count() > 0)
                        @php
                            $jadwalTerdekat = $jadwalHariIni->sortBy('jam_mulai')->first();
                            $jadwalMingguSelanjutnyaTerdekat = $jadwalHariIni->sortBy('jam_mulai')->skip(1)->first();
                        @endphp
                        <p class="text-gray-600 text-xs sm:text-sm md:text-xs mt-1">
                            Terdekat: {{ \Carbon\Carbon::parse($jadwalTerdekat->jam_mulai)->format('H:i') }} WIB
                            @if($jadwalMingguSelanjutnyaTerdekat)
                                <br>Next: {{ \Carbon\Carbon::parse($jadwalMingguSelanjutnyaTerdekat->jam_mulai)->format('H:i') }} WIB
                            @endif
                        </p>
                    @endif
                @endif
        </a>

        <a href="#jadwal-minggu-depan" id="scroll-ke-minggu-ini" class="aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] bg-white shadow-md rounded-md p-6 hover:bg-orange-200 hover:shadow-lg transition duration-300">
            <h3 class="text-lg font-semibold mb-2">Jadwal Belum Terlaksana</h3>
            <div class="text-2xl font-bold text-blue-500">{{ $jadwalBelumTerlaksanaCount }}</div>
        </a>
        <a href="#jadwal-sudah-terlaksana" id="scroll-ke-sudah-terlaksana" class="aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] bg-white shadow-md rounded-md p-6 hover:bg-blue-200 hover:shadow-lg transition duration-300">
            <h3 class="text-lg font-semibold mb-2">Jadwal Sudah Terlaksana</h3>
            <div class="text-2xl font-bold text-green-500">{{ $jadwalSudahTerlaksanaCount }}</div>
        </a>
        <a href="#jadwal-sudah-terlaksana" id="scroll-ke-sudah-terlaksana-2" class="aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] bg-white shadow-md rounded-md p-6 hover:bg-gray-300 hover:shadow-lg transition duration-300">
            <h3 class="text-lg font-semibold mb-2">Total Jadwal</h3>
            <div class="text-2xl font-bold text-gray-700">{{ $totalJadwalCount }}</div>
        </a>
        <div></div>
    </div> --}}

    <div class="max-w-[1080px] grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap- mb-6">

        <a href="#jadwal-hari-ini" id="scroll-ke-hari-ini" class="bg-white hover:bg-green-200 hover:shadow-lg transition duration-300 aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] shadow-md rounded-md p-6">
            <h3 class="text-sm sm:text-lg font-semibold mb-2">Jadwal Hari Ini</h3>
            @if($jadwalHariIni->isEmpty())
                <p class="text-gray-600 text-xs sm:text-sm">Tidak ada jadwal hari ini.</p>
            @else
                <div class="text-2xl font-bold text-red-500">{{ $jadwalHariIni->count() }}</div>
                @if($jadwalHariIni->count() > 0)
                    @php
                        $jadwalTerdekat = $jadwalHariIni->sortBy('jam_mulai')->first();
                        $jadwalMingguSelanjutnyaTerdekat = $jadwalHariIni->sortBy('jam_mulai')->skip(1)->first();
                    @endphp
                    <p class="text-gray-600 text-xs sm:text-sm md:text-xs mt-1">
                        Terdekat: {{ \Carbon\Carbon::parse($jadwalTerdekat->jam_mulai)->format('H:i') }} WIB
                        @if($jadwalMingguSelanjutnyaTerdekat)
                            <br>Next: {{ \Carbon\Carbon::parse($jadwalMingguSelanjutnyaTerdekat->jam_mulai)->format('H:i') }} WIB
                        @endif
                    </p>
                @endif
            @endif
        </a>
    
        <a href="#jadwal-minggu-depan" id="scroll-ke-minggu-ini" class="bg-white hover:bg-orange-200 hover:shadow-lg transition duration-300 aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] shadow-md rounded-md p-6">
            <h3 class="text-lg font-semibold mb-2">Jadwal Belum Terlaksana</h3>
            <div class="text-2xl font-bold text-blue-500">{{ $jadwalBelumTerlaksanaCount }}</div>
        </a>
        <a href="#jadwal-sudah-terlaksana" id="scroll-ke-sudah-terlaksana" class="bg-white hover:bg-blue-200 hover:shadow-lg transition duration-300 aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] shadow-md rounded-md p-6">
            <h3 class="text-lg font-semibold mb-2">Jadwal Sudah Terlaksana</h3>
            <div class="text-2xl font-bold text-green-500">{{ $jadwalSudahTerlaksanaCount }}</div>
        </a>
        <a href="#total-jadwal" id="scroll-ke-total-jadwal" class="bg-white hover:bg-gray-300 hover:shadow-lg transition duration-300 aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] shadow-md rounded-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Jadwal</h3>
            <div class="text-2xl font-bold text-gray-700">{{ $totalJadwalCount }}</div>
        </a>
    
        <div class="bg-white hover:bg-yellow-100 hover:shadow-lg transition duration-300 shadow-md rounded-md p-6 col-span-2 aspect-[24/9] md:aspect-[48/9] xl:aspect-[56/9] sm:col-span-2 sm:aspect-auto md:col-span-4 lg:col-span-2 lg:aspect-auto xl:col-span-4">
            <h3 id="jadwal-sholat-hari-ini" class="text-lg font-semibold mb-2">Jadwal Sholat</h3>
            <div class="flex justify-between">
                <div id="jadwal-sholat">
                    <p class="text-gray-600 text-sm">Sedang memuat jadwal sholat...</p>
                </div>
                <div id="jadwal-sholat-next" class="text-right">
                   
                </div>
            </div>
        </div>
    
      </div>

    
    <script>

        let year, month, day, hours, minutes, seconds, today, clock;

        function updateClock() {
            const date = new Date();
            year = date.getFullYear();
            month = String(date.getMonth() + 1).padStart(2, '0');
            day = String(date.getDate()).padStart(2, '0');

            hours = String(date.getHours()).padStart(2, '0');
            minutes = String(date.getMinutes()).padStart(2, '0');
            seconds = String(date.getSeconds()).padStart(2, '0');

            today = `${year}-${month}-${day}`;
            clock = `${hours}:${minutes}`;

            const clockElement = document.getElementById('live-clock');
            if (clockElement) {
                clockElement.textContent = clock;
            }
            const jadwalSholatNext = document.getElementById('jadwal-sholat-next');
            if (jadwalSholatNext && jadwalSholatNext.querySelector('.live-time')) {
                jadwalSholatNext.querySelector('.live-time').textContent = clock + ':' + seconds;
            }
        }

        setInterval(updateClock, 1000);
        document.addEventListener('DOMContentLoaded', () => {
            updateClock(); // Panggil sekali saat DOMContentLoaded
            fetchJadwalSholat(); // Panggil untuk mendapatkan data jadwal
        });

        async function fetchJadwalSholat() {
            try {
                const idKota = '0816'; // Kode Kota Palembang
                const apiUrl = `https://api.myquran.com/v2/sholat/jadwal/${idKota}/${today}`;

                const response = await fetch(apiUrl);
                const data = await response.json();
                const ds = data.data.jadwal;

                const jadwalSholatHariIni = document.getElementById('jadwal-sholat-hari-ini');
                const jadwalSholatDiv = document.getElementById('jadwal-sholat');
                const jadwalSholatNext = document.getElementById('jadwal-sholat-next');

                let jadwalHTML = '';
                let nextPrayer = null;

                const prayerTimes = {
                    Subuh: ds.subuh,
                    Dzuhur: ds.dzuhur,
                    Ashar: ds.ashar,
                    Maghrib: ds.maghrib,
                    Isya: ds.isya
                };

                for (const waktu in prayerTimes) {
                    const prayerTime = prayerTimes[waktu];
                    const [prayerHour, prayerMinute] = prayerTime.split(':').map(Number);
                    const [currentHour, currentMinute] = clock.split(':').map(Number);

                    let isNext = false;

                    if (!nextPrayer) {
                        if (currentHour < prayerHour || (currentHour === prayerHour && currentMinute < prayerMinute)) {
                            nextPrayer = waktu;
                            isNext = true;
                        }
                    }

                    jadwalHTML += `<p class="text-sm ${isNext ? 'text-blue-600 font-bold' : 'text-gray-700'}">${waktu}: ${prayerTime}</p>`;
                }

                jadwalSholatHariIni.innerHTML = `Jadwal Sholat | ${day}/${month}/${year}`;

                jadwalSholatDiv.innerHTML = jadwalHTML;

                if (jadwalSholatNext && nextPrayer) {
                    jadwalSholatNext.innerHTML = `
                        <h1 class="text-4xl font-bold text-blue-600">${prayerTimes[nextPrayer]}</h1>
                        <p class="text-green-600 text-sm">Waktu Sholat ${nextPrayer}</p>
                        <p class="text-gray-600 text-sm live-time"></p>
                    `;
                }

            } catch (error) {
                console.error("Gagal mengambil data jadwal sholat:", error);
                document.getElementById('jadwal-sholat').innerHTML = '<p class="text-red-500 text-sm">Gagal memuat jadwal sholat.</p>';
            }
        }
    </script>







    
    
      
    






    <section class="max-w-[1080px] bg-white shadow-md rounded-md">
        <div class="py-4 px-2 mx-auto max-w-screen-xl sm:px-4 lg:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 h-full">
                <div class="col-span-2 sm:col-span-2 bg-gray-50 h-[20rem] lg:h-full flex flex-col">
                    <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 flex-grow">
                        <img src="/images/masjid/Pic 1_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                        <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl">Al-Aqobah 1</h3>
                    </a>
                </div>
                <div class="col-span-2 md:col-span-1 lg:col-span-2 bg-stone-50">
                    <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 mb-4 h-[15rem] md:h-auto">
                        <img src="/images/masjid/Pic 4_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        <div class="absolute inset-0 6g-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                        {{-- <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl">PT. PUSRI</h3> --}}
                    </a>
                    <div class="grid gap-4 grid-cols-2 md:grid-cols-2 lg:grid-cols-2 h-[20rem] md:h-auto">
                        <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40">
                            <img src="/images/masjid/Pic 2_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                            {{-- <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"></h3> --}}
                        </a>
                        <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40">
                            <img src="/images/masjid/Pic 8_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                            {{-- <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"></h3> --}}
                        </a>
                    </div>
                </div>
                <div class="col-span-2 sm:col-span-2 md:col-span-1 bg-sky-50 h-[15rem] md:h-full flex flex-col">
                    <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 flex-grow">
                        <img src="/images/masjid/Pic 11_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                        {{-- <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"></h3> --}}
                    </a>
                </div>
            </div>
        </div>
    </section>




    <div id="jadwal-hari-ini" class="max-w-[1080px] scroll-mt-20 my-6 bg-white shadow-md rounded-md p-2 md:pd-6">
        <h3 class="text-xl font-semibold my-1 ml-2">Jadwal Hari Ini</h3>
        @if($jadwalHariIni->isEmpty())
            <p class="text-gray-600 text-xs sm:text-sm">Tidak ada jadwal hari ini.</p>
        @else
            <div class="grid grid-cols-1 gap-4 pt-3">
                @foreach($jadwalHariIni as $jadwal)
                    <div class="rounded-md overflow-hidden hover:bg-gray-100 hover:shadow-lg transition duration-300 group">
                        <a href="{{ route('admin.schedules.show', $jadwal->slug) }}" class="block">
                            <div class="flex sm:flex-row flex-col items-start">
                                @if($jadwal->gambar)
                                    <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="w-full sm:w-48 aspect-[3/2] sm:aspect-square object-cover rounded-md sm:mr-4 mb-2 sm:mb-0">
                                @else
                                    <div class="w-full sm:w-32 aspect-[3/2] sm:aspect-square text-center bg-gray-100 flex items-center justify-center text-gray-500 rounded-md sm:mr-4 mb-2 sm:mb-0">Tidak Ada Gambar</div>
                                @endif
                                <div class="pt-0 pl-4 mb-3 sm:mb-5 md:mb-0 sm:pl-0 sm:pt-5">
                                    <h3 class="font-semibold text-sm sm:text-lg group-focus:underline mb-2">{{ $jadwal->judul_ceramah }}</h3>
                                    <p class="text-gray-600 text-xs sm:text-sm group-focus:underline">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB</p>
                                    <p class="text-gray-500 text-xs sm:text-sm group-focus:underline">{{ $jadwal->nama_ustadz }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="jadwal-minggu-ini" class="max-w-[1080px] scroll-mt-20 mt-8 mb-4">
        <h2 class="text-xl font-semibold mb-4 border-b border-gray-200 pb-2">Jadwal Minggu Ini</h2>
        @if($jadwalMingguIni->isEmpty())
            <p>Tidak ada jadwal untuk minggu ini.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-4">
                @foreach($jadwalMingguIni as $jadwal)
                    <a href="{{ route('admin.schedules.show', $jadwal->slug) }}" class="block bg-white rounded-md shadow-md overflow-hidden hover:scale-105 hover:shadow-lg  transition duration-300">
                        @if($jadwal->gambar)
                            <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="w-full aspect-square object-cover">
                        @else
                            <div class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">Tidak Ada Gambar</div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text:sm sm:text-lg mb-2">{{ $jadwal->judul_ceramah }}</h3>
                            <p class="text-gray-600 text-xs sm:text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB</p>
                            <p class="text-gray-500 text-xs sm:text-sm">{{ $jadwal->nama_ustadz }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <div class="max-w-[1080px] mb-8">
        <h2 class="text-xl font-semibold mt-8 mb-4 border-b border-gray-200 pb-2">Jadwal Minggu Depan</h2>
        @if($jadwalMingguDepan->isEmpty())
            <p>Tidak ada jadwal untuk minggu depan.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-4">
                @foreach($jadwalMingguDepan as $jadwal)
                    <a href="{{ route('admin.schedules.show', $jadwal->slug) }}" class="block bg-white rounded-md shadow-md overflow-hidden hover:scale-105 hover:shadow-lg  transition duration-300">
                        @if($jadwal->gambar)
                            <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="w-full aspect-square object-cover">
                        @else
                            <div class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">Tidak Ada Gambar</div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text:sm sm:text-lg">{{ $jadwal->judul_ceramah }}</h3>
                            <p class="text-gray-600 text-xs sm:text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB</p>
                            <p class="text-gray-500 text-xs sm:text-sm">{{ $jadwal->nama_ustadz }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <div>
        <h2 class="text-xl font-semibold mt-8 mb-4 border-b border-gray-200 pb-2">Jadwal Minggu Selanjutnya</h2>
        @if($jadwalMingguSelanjutnya->isEmpty())
            <p>Tidak ada jadwal minggu selanjutnya.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-4">
                @foreach($jadwalMingguSelanjutnya as $jadwal)
                    <a href="{{ route('admin.schedules.show', $jadwal->slug) }}" class="block bg-white rounded-md shadow-md overflow-hidden hover:scale-105 hover:shadow-lg  transition duration-300">
                        @if($jadwal->gambar)
                            <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="w-full aspect-square object-cover">
                        @else
                            <div class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">Tidak Ada Gambar</div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text:sm sm:text-lg">{{ $jadwal->judul_ceramah }}</h3>
                            <p class="text-gray-600 text-xs sm:text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB</p>
                            <p class="text-gray-500 text-xs sm:text-sm">{{ $jadwal->nama_ustadz }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
    
            {{ $jadwalMingguSelanjutnya->links() }}
        @endif
    </div>

    <div id="map" class="scroll-mt-20 mt-8">
        <h2 class="text-xl font-semibold mb-4 border-b border-gray-200 pb-2">Lokasi Masjid</h2>
        <div class="overflow-hidden rounded-md shadow-md">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.4424348373436!2d104.79979469999999!3d-2.974643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b77b54752dde9%3A0xa476856998a2a3b2!2sMasjid%20Al%20-%20Aqobah%201!5e0!3m2!1sid!2sid!4v1746677602550!5m2!1sid!2sid"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <div id="jadwal-sudah-terlaksana" class="scroll-mt-20 my-8 mb-40">
        <h2 class="text-xl font-semibold mb-4 border-b border-gray-200 pb-2">Jadwal yang Sudah Terlaksana</h2>
        @if($jadwalSudahTerlaksana->isEmpty())
            <p>Tidak ada jadwal untuk minggu lalu.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-md shadow-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ustadz</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($jadwalSudahTerlaksana as $jadwal)
                        <tr onclick="window.location='{{ route('admin.schedules.show', $jadwal->slug) }}'" class="cursor-pointer hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($jadwal->gambar)
                                        <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="max-w-40 rounded">
                                    @else
                                        <span class="text-gray-500 text-xs sm:text-sm">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->judul_ceramah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->nama_ustadz }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ $jadwal->jam_selesai ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->tempat_ceramah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            <div class="mt-4">
                {{ $jadwalSudahTerlaksana->links() }}
            </div>
        @endif
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollLinks = [
            { id: 'scroll-ke-hari-ini', target: '#jadwal-hari-ini' },
            { id: 'scroll-ke-minggu-ini', target: '#jadwal-minggu-ini' },
            { id: 'scroll-ke-sudah-terlaksana', target: '#jadwal-sudah-terlaksana' },
            { id: 'scroll-ke-sudah-terlaksana-2', target: '#jadwal-sudah-terlaksana' },
            { id: 'scroll-ke-map', target: '#map' }
        ];

        scrollLinks.forEach(linkInfo => {
            const scrollLink = document.getElementById(linkInfo.id);
            const targetId = linkInfo.target;
            const targetElement = document.querySelector(targetId);

            if (scrollLink && targetElement) {
                scrollLink.addEventListener('click', function(event) {
                    event.preventDefault();

                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            }
        });
    });
</script>