<x-app-layout>

    <x-admin.menu />

    <div class="mx-auto flex-1 p-1 sm:p-3 md:p-6 lg:p-8 overflow-y-auto">
      
        <div class="bg-gray-90 font-sans pt-2 pb-1 px-4 mb-20">
            <x-telkominfra.form-show
                :perjalanan-detail="$perjalananDetail ?? null"
            />
            <x-telkominfra.update-show
                :perjalanan-detail="$perjalananDetail ?? null"  
            />
            <x-telkominfra.signal-show
                :signal-averages="$signalAverages ?? []"
            />
            <x-telkominfra.maps
                :perjalanan-detail="$perjalananDetail ?? null"
                :mapsData="$mapsData ?? []"
            />
        </div>
    </div>

</x-app-layout>