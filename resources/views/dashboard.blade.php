<x-app-layout>

    <x-admin-menu />
    <x-admin-home
        :jadwalBelumTerlaksanaCount="$jadwalBelumTerlaksanaCount"
        :jadwalSudahTerlaksanaCount="$jadwalSudahTerlaksanaCount"
        :jadwalHariIni="$jadwalHariIni"
        :jadwalMingguIni="$jadwalMingguIni"
        :jadwalMingguDepan="$jadwalMingguDepan"
        :jadwalMingguSelanjutnya="$jadwalMingguSelanjutnya"
        :jadwalSudahTerlaksana="$jadwalSudahTerlaksana"
        :user="Auth::user()"
        :appName="config('app.name')"
        :totalJadwalCount="$totalJadwalCount"
    />

</x-app-layout>