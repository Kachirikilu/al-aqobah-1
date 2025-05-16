<div class="mb-8">
    <h2 class="text-xl font-semibold mt-8 mb-4 border-b border-gray-200 pb-2">Jadwal Minggu Depan</h2>
    @if($jadwalMingguDepan->isEmpty())
        <p class="text-gray-600 text-xs sm:text-sm text-center py-20 mt-3">Tidak ada jadwal untuk minggu depan.</p>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($jadwalMingguDepan as $jadwal)
                <a href="/schedules/show/{{ $jadwal->slug }}" class="block bg-white rounded-md shadow-md overflow-hidden hover:scale-105 hover:shadow-lg  transition duration-300">
                    @if($jadwal->gambar)
                        <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="w-full aspect-square object-cover">
                    @else
                        <div class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">Tidak Ada Gambar</div>
                    @endif
                    <div class="p-3">
                        <h3 class="font-semibold sm:text-lg mb-2">{{ $jadwal->judul_ceramah }}</h3>
                        <p class="text-gray-600 text-xs sm:text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB</p>
                        <p class="text-gray-500 text-xs sm:text-sm">{{ $jadwal->nama_ustadz }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>