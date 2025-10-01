<div class="mb-6 border p-6 rounded-xl bg-white shadow-lg">
    <h4 class="text-xl font-extrabold mb-4 text-indigo-700 border-b pb-2">
        <i class="fas fa-edit mr-2"></i> Edit Detail Sesi Perjalanan
    </h4>

    <form action="{{ route('perjalanan.update', $perjalananDetail->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">

            <!-- NAMA PENGGUNA -->
            <div>
                <label for="nama_pengguna" class="block text-sm font-medium text-gray-700">Nama Pengguna:</label>
                <input type="text" id="nama_pengguna" name="nama_pengguna" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    value="{{ old('nama_pengguna', $perjalananDetail->nama_pengguna ?? (Auth::user()->name ?? 'User Default')) }}">
            </div>

            <!-- NAMA TEMPAT / LOKASI -->
            <div>
                <label for="nama_tempat" class="block text-sm font-medium text-gray-700">Nama Tempat /
                    Lokasi:</label>
                <input type="text" id="nama_tempat" name="nama_tempat" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    value="{{ old('nama_tempat', $perjalananDetail->nama_tempat ?? null) }}">
            </div>

            <!-- ID PERJALANAN (Display Only - Read from $perjalananDetail) -->
            <div>
                <label for="display_id_perjalanan" class="block text-sm font-medium text-gray-700">ID
                    Perjalanan:</label>
                <input type="text" id="display_id_perjalanan"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border bg-gray-200 cursor-not-allowed"
                    value="{{ $perjalananDetail->id ?? 'ID Not Found' }}" readonly>
                <!-- Nilai ini hanya untuk tampilan, bukan untuk dikirim (karena ID sudah di URL) -->
            </div>
        </div>

        {{-- Handling Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm"
                role="alert">
                <strong class="font-semibold">Perhatian!</strong> Ada kesalahan pada input:
                <ul class="list-disc ml-5 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-orange-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-500 active:bg-orange-500 focus:outline-none focus:border-orange-900 focus:ring focus:ring-orange-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
            Simpan Perubahan Detail
        </button>
    </form>
</div>
