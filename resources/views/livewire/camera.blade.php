<div wire:poll.2000ms="loadData" class="w-full mx-auto mt-6 mb-6 p-6 bg-white shadow-lg rounded-lg space-y-6">

    {{-- Notifikasi Gerakan --}}
    {{-- 
    @if ($motion)
        <div class="flex items-center gap-3 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
            <span>⚠️ Gerakan terdeteksi! Periksa segera.</span>

            <!-- Audio player -->
            <audio autoplay hidden>
                <source src="{{ asset('sounds/1000 Hz.mp3') }}" type="audio/mpeg">
            </audio>
        </div>
    @endif 
    --}}

    <div class="space-y-1">
        <h1 class="text-xl font-bold text-gray-800">ID: {{ $id }}</h1>
        <p class="text-gray-700">Message: {{ $message }}</p>
    </div>

    <div class="w-full flex justify-center">
        @if ($image)
            <img src="data:image/jpeg;base64,{{ $image }}" alt="Camera Image"
                 class="max-h-80 object-contain rounded-md" />
        @else
            <p class="text-gray-500 italic text-center">Tidak ada gambar</p>
        @endif
    </div>

    <div class="flex justify-center">
        <button type="button" wire:click="sendCapture"
                class="w-64 px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition">
            Kirim Perintah Capture
        </button>
    </div>

    {{-- Form Pesan Manual (opsional) --}}
    {{--
    <form wire:submit.prevent="sendMessage" class="space-y-3 pt-4 border-t border-gray-200">
        <input type="text" wire:model.defer="inputMessage" placeholder="Ketik pesan..."
               class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" required>
        <button type="submit"
                class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Kirim Pesan
        </button>
    </form>
    --}}
</div>

<script>
    window.addEventListener('notify', event => {
        alert(event.detail.message);
    });
</script>


