<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap- mb-6">

    <a href="#jadwal-hari-ini" id="scroll-ke-hari-ini" class="bg-white hover:bg-green-200 hover:shadow-lg transition duration-300 aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] shadow-md rounded-md p-6">
        <h3 class="text-lg font-semibold mb-2">Jadwal Hari Ini</h3>
        @if($jadwalHariIni->isEmpty())
            <p class="text-gray-600 text-xs md:text-sm">Tidak ada jadwal hari ini.</p>
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

    <a href="#jadwal-minggu-ini" id="scroll-ke-minggu-ini" class="bg-white hover:bg-orange-200 hover:shadow-lg transition duration-300 aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] shadow-md rounded-md p-6">
        <h3 class="text-lg font-semibold mb-2">Jadwal Belum Terlaksana</h3>
        <div class="text-2xl font-bold text-blue-500">{{ $jadwalBelumTerlaksanaCount }}</div>
    </a>
    <a href="#jadwal-sudah-terlaksana" id="scroll-ke-sudah-terlaksana" class="bg-white hover:bg-blue-200 hover:shadow-lg transition duration-300 aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] shadow-md rounded-md p-6">
        <h3 class="text-lg font-semibold mb-2">Jadwal Sudah Terlaksana</h3>
        <div class="text-2xl font-bold text-green-500">{{ $jadwalSudahTerlaksanaCount }}</div>
    </a>
    <a href="#jadwal-sudah-terlaksana" id="scroll-ke-sudah-terlaksana-2" class="bg-white hover:bg-gray-300 hover:shadow-lg transition duration-300 aspect-auto sm:aspect-square md:aspect-auto lg:aspect-[4/3] xl:aspect-[3/2] shadow-md rounded-md p-6">
        <h3 class="text-lg font-semibold mb-2">Total Jadwal</h3>
        <div class="text-2xl font-bold text-gray-700">{{ $totalJadwalCount }}</div>
    </a>


    <div id="scroll-jadwal-sholat" class="scroll-mt-48 bg-white hover:bg-yellow-100 hover:shadow-lg transition duration-300 shadow-md rounded-md p-6 col-span-2 aspect-[24/9] md:aspect-[48/9] xl:aspect-[56/9] sm:col-span-2 sm:aspect-auto md:col-span-4 lg:col-span-2 lg:aspect-auto xl:col-span-4">
        <h3 id="jadwal-sholat-hari-ini" class="text-lg font-semibold mb-2">Jadwal Sholat</h3>
        <div class="flex justify-between">
            <div id="jadwal-sholat">
                <p class="text-gray-600 text-sm">Sedang memuat jadwal sholat...</p>
            </div>
            <div id="jadwal-sholat-next" class="text-right"></div>
        </div>
    </div>

</div>