<x-app-layout>

    <x-admin.menu />

    <div class="flex-1 p-4 md:p-8 overflow-y-auto">
        <x-home.header-home 
            :jadwalHariIni="$jadwalHariIni"
            :jadwalBelumTerlaksanaCount="$jadwalBelumTerlaksanaCount"
            :jadwalSudahTerlaksanaCount="$jadwalSudahTerlaksanaCount"
            :totalJadwalCount="$totalJadwalCount"
        />
        <x-home.galery-home />
        <x-home.hari-ini :jadwalHariIni="$jadwalHariIni" />
        <x-home.minggu-ini :jadwalMingguIni="$jadwalMingguIni" />
        <x-home.minggu-depan :jadwalMingguDepan="$jadwalMingguDepan" />
        <x-home.minggu-selanjutnya :jadwalMingguSelanjutnya="$jadwalMingguSelanjutnya" />
        <x-home.maps />
        <x-home.terlaksana :jadwalSudahTerlaksana="$jadwalSudahTerlaksana" />
    </div>

</x-app-layout>