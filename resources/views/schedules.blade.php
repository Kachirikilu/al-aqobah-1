<x-app-layout>

    @if (Auth::check())
        <x-admin.menu />
    @else
        <x-home.navbar />
    @endif

    <div class="max-w-[1080px] mx-auto flex-1 p-4 md:p-8 overflow-y-auto">
        @if (request()->is('schedules'))
            <x-schedules.view :jadwalCeramahs="$jadwalCeramahs" />
        @elseif (preg_match('#^schedules/[^/]+/edit$#', request()->path()))
            <x-schedules.update :jadwalCeramah="$jadwalCeramah" />
        @elseif (request()->is('schedules/create'))
            <x-schedules.create />
        @else
            <x-schedules.show :jadwalCeramah="$jadwalCeramah" />
        @endif
    </div>

    <x-home.footer />

</x-app-layout>