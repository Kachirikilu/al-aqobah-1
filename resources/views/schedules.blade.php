<x-app-layout>

    <x-admin.menu />

    <div class="max-w-[1080px] mx-auto flex-1 p-4 md:p-8 overflow-y-auto">
        @if (request()->is('schedules'))
            <x-schedules.view :jadwalCeramahs="$jadwalCeramahs" />
        @elseif (preg_match('#^schedules/[^/]+/edit$#', request()->path()))
            <x-schedules.update :jadwalCeramah="$jadwalCeramah" />
        @elseif (request()->is('schedules/create'))
            <x-schedules.create />
        @elseif (preg_match('#^schedules/[^/]+$#', request()->path()))
            <x-schedules.show :jadwalCeramah="$jadwalCeramah" />
        @endif
    </div>

</x-app-layout>