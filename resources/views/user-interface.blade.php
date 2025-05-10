<x-app-layout>
    
    <div>
        <x-home.protofolio />

        <div class="max-w-[1080px] mx-auto flex-1 p-4 md:p-8 overflow-y-auto">
            <x-home.header-home />

            <x-home.info-home 
                :jadwalHariIni="$jadwalHariIni"
                :jadwalBelumTerlaksanaCount="$jadwalBelumTerlaksanaCount"
                :jadwalSudahTerlaksanaCount="$jadwalSudahTerlaksanaCount"
                :totalJadwalCount="$totalJadwalCount"
            />
            <x-home.maps />

            <x-home.galery-home />
            <x-home.hari-ini :jadwalHariIni="$jadwalHariIni" />
            <x-home.minggu-ini :jadwalMingguIni="$jadwalMingguIni" />
            <x-home.minggu-depan :jadwalMingguDepan="$jadwalMingguDepan" />
            <x-home.minggu-selanjutnya :jadwalMingguSelanjutnya="$jadwalMingguSelanjutnya" />
            <x-home.terlaksana :jadwalSudahTerlaksana="$jadwalSudahTerlaksana" />
        </div>
    </div>

</x-app-layout>