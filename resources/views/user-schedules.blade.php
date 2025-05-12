<x-app-layout>

    <x-home.navbar />

    <div class="max-w-[1080px] mx-auto flex-1 p-4 md:p-8 overflow-y-auto">
        <x-schedules.show :jadwalCeramah="$jadwalCeramah" />
    </div>

</x-app-layout>