<x-app-layout>

    <x-admin.menu />

    <div class="max-w-[1080px] mx-auto flex-1 p-1 sm:p-3 md:p-6 lg:p-8 overflow-y-auto">
        <x-home.welcome-home />
        <x-home.info-home 
            :jadwalHariIni="$jadwalHariIni"
            :jadwalBelumTerlaksanaCount="$jadwalBelumTerlaksanaCount"
            :jadwalSudahTerlaksanaCount="$jadwalSudahTerlaksanaCount"
            :totalJadwalCount="$totalJadwalCount"
        />

        @livewire('data-device.camera')

        <x-home.galery-home />
        <x-home.hari-ini :jadwalHariIni="$jadwalHariIni" />

        <x-home.mingguan :jadwalMingguan="$jadwalMingguIni" :name="$x='Minggu Ini'" />
        <x-home.mingguan :jadwalMingguan="$jadwalMingguDepan" :name="$x='Minggu Depan'" />
        <x-home.mingguan :jadwalMingguan="$jadwalMingguSelanjutnya" :name="$x='Minggu Selanjutnya'" />
        
        {{-- <x-home.minggu-ini :jadwalMingguIni="$jadwalMingguIni" />
        <x-home.minggu-depan :jadwalMingguDepan="$jadwalMingguDepan" /> --}}
        {{-- <x-home.minggu-selanjutnya :jadwalMingguSelanjutnya="$jadwalMingguSelanjutnya" /> --}}
        <x-home.maps />
        <x-home.terlaksana :jadwalSudahTerlaksana="$jadwalSudahTerlaksana" />
    </div>

</x-app-layout>