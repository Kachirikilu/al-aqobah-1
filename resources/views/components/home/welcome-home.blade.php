<div class="header-with-backdrop-blur text-white shadow-md mt-2 mb-3 rounded-md">
    <div class="w-full h-full py-20 backdrop-blur-sm hover:backdrop-brightness-50 duration-500 ease-in-out backdrop-brightness-75 flex flex-col lg:flex-row justify-between items-center rounded-md">
        <a href="#scroll-map" id="scroll-ke-map" class="text-3xl font-semibold mb-1 lg:ml-10 sm:mb-2 lg:mb-0">Al-Aqobah 1</a>
        <div class="flex items-center">
            @if(Auth::check())
                <span class="lg:mr-10">Selamat datang, {{ Auth::user()->name }}</span>
            @else
                <span class="lg:mr-10">Selamat datang, Pengunjung</span> {{-- Atau hilangkan baris ini jika tidak ingin menampilkan apa pun --}}
            @endif
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