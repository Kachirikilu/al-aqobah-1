<div wire:poll.2000ms="loadData" class="p-6 mb-6 max-w-xl mx-auto space-y-4 bg-white shadow-lg rounded-lg">

    @if ($motion)
        <div class="flex items-center gap-2 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
            <span>⚠️ Gerakan terdeteksi! Periksa segera.</span>
        </div>
    @endif

    <h1 class="text-xl font-bold text-gray-800">ID: {{ $id }}</h1>
    <p class="text-gray-700">Message: {{ $message }}</p>

    @if ($image)
        <img src="data:image/jpeg;base64,{{ $image }}" alt="Camera Image" class="w-full max-h-80 object-contain rounded shadow" />
    @else
        <p class="text-gray-500 italic">Tidak ada gambar</p>
    @endif

    <form wire:submit.prevent="sendMessage" class="mt-6 space-y-2">
        <input type="text" wire:model.defer="inputMessage" placeholder="Ketik pesan..."
               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" required>
        <button type="submit"
                class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Kirim Pesan
        </button>
    </form>
</div>

<script>
    window.addEventListener('notify', event => {
        alert(event.detail.message);
    });
</script>


