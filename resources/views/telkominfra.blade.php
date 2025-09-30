<x-app-layout>

    <x-admin.menu />

    <div class="max-w-[1080px] mx-auto flex-1 p-1 sm:p-3 md:p-6 lg:p-8 overflow-y-auto">
        <x-telkominfra.maps :visual-data="$visualData" />
    </div>

</x-app-layout>