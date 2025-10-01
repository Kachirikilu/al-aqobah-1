<x-app-layout>

    <x-admin.menu />

    <div class="mx-auto flex-1 p-1 sm:p-3 md:p-6 lg:p-8 overflow-y-auto">
        <x-telkominfra.data
        :perjalanans="$perjalanans ?? []"
        />
    </div>

</x-app-layout>