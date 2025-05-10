<x-app-layout>
    
    <x-home.navbar />
    
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
            <x-home.galery-home />

            <div id="grup-jadwal" class="scroll-mt-20">
                @if(!$jadwalHariIni->isEmpty())
                    <x-home.hari-ini :jadwalHariIni="$jadwalHariIni" />
                @endif
                @if(!$jadwalMingguIni->isEmpty())
                    <x-home.minggu-ini :jadwalMingguIni="$jadwalMingguIni" />
                @endif

                <x-home.terlaksana-user :jadwalSudahTerlaksana="$jadwalSudahTerlaksana" />
            </div>

            <x-home.maps />

            <x-home.footer />


        </div>
    </div>

</x-app-layout>