<x-app-layout>

    <x-admin.menu />

    @if (request()->is('schedules'))
        <x-schedules.view :jadwalCeramahs="$jadwalCeramahs" />
    @elseif (preg_match('#^schedules/[^/]+/edit$#', request()->path()))
        <x-schedules.update :jadwalCeramah="$jadwalCeramah" />
    @elseif (request()->is('schedules/create'))
        <x-schedules.create />
    @elseif (preg_match('#^schedules/[^/]+$#', request()->path()))
        <x-schedules.show :jadwalCeramah="$jadwalCeramah" />
    @endif

</x-app-layout>