@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        .leaflet-control.info {
            z-index: 1000;
        }

        .info i {
            display: inline-block !important;
        }
    </style>
@endpush

<div class="mt-8">
    <h3 class="text-2xl font-extrabold text-gray-800 mb-6 border-b pb-2">Visualisasi Data Log</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-4">
        <div class="grid grid-cols-1 gap-4">
            @forelse (collect($mapsData)->where('status', 'Before') as $mapItem)
                <x-telkominfra.map.item-map :mapItem="$mapItem" />
            @empty
                <div class="lg:col-span-3">
                    <p class="text-center text-gray-500 py-10 border rounded-lg bg-gray-50">
                        Tidak ada data sinyal 'Before' yang ditemukan untuk perjalanan ini.
                    </p>
                </div>
            @endforelse
        </div>
        <div class="grid grid-cols-1 gap-4">
            @forelse (collect($mapsData)->where('status', 'After') as $mapItem)
                <x-telkominfra.map.item-map :mapItem="$mapItem" />
            @empty
                <div class="lg:col-span-3">
                    <p class="text-center text-gray-500 py-10 border rounded-lg bg-gray-50">
                        Tidak ada data sinyal 'After' yang ditemukan untuk perjalanan ini.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        var allMapsData = @json($mapsData ?? []);

        document.addEventListener('DOMContentLoaded', function() {

            // ----------------------------------------------------------------------
            // B. FUNGSI PENENTU WARNA RSRQ (Tetap sama)
            // ----------------------------------------------------------------------
            function getColorByRSRQ(rsrq) {
                if (rsrq >= -70) {
                    return '#2ECC71'; // Hijau (Sangat Baik)
                } else if (rsrq >= -90) {
                    return '#F4D03F'; // Kuning (Baik/Sedang)
                } else {
                    return '#E74C3C'; // Merah (Buruk)
                }
            }
            
            // C & D & E & F. LOOPING DAN INISIALISASI PETA UNTUK SETIAP LOG
            allMapsData.forEach(function(mapItem) {

                // Ambil ID unik dan data
                var mapId = 'map-' + mapItem.id;
                var centerCoords = mapItem.centerCoords;
                var visualData = mapItem.visualData;

                // 1. Inisialisasi Peta Baru
                // Periksa: Pastikan elemen peta sudah tersedia
                var mapElement = document.getElementById(mapId);
                if (!mapElement) {
                    // console.error("Elemen peta tidak ditemukan: " + mapId);
                    return; // Lewati jika elemen tidak ada di DOM
                }

                // Inisialisasi Peta
                // Menggunakan titik tengah yang didapat dari Controller
                var map = L.map(mapId).setView(centerCoords, 18);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // --- Proses Data Visual (Polyline & Marker) hanya jika ada data ---
                if (visualData.length > 0) {
                    // 2. Format Ulang Data Titik Pengukuran
                    var measurementPoints = visualData.map(function(data) {
                        return [
                            data.latitude,
                            data.longitude,
                            data.rsrp,
                            data.rsrq,
                            data.sinr,
                            data.pci,
                            data.earfcn,
                            data.band,
                            data.frekuensi,
                            data.timestamp_waktu
                        ];
                    });

                    // 3. LOGIKA SEGMENTED POLYLINE 
                    for (var i = 1; i < measurementPoints.length; i++) {
                        var startPoint = measurementPoints[i - 1];
                        var endPoint = measurementPoints[i];

                        var rsrp = endPoint[2];
                        var rsrq = endPoint[3];
                        var sinr = endPoint[4];
                        var pci = endPoint[5];
                        var earfcn = endPoint[6];
                        var band = endPoint[7];
                        var frequency = endPoint[8];
                        var latitude = endPoint[0];
                        var longitude = endPoint[1];
                        var waktu = endPoint[9];
                        var segmentColor = getColorByRSRQ(rsrq);

                        var segment = L.polyline([
                            [startPoint[0], startPoint[1]],
                            [endPoint[0], endPoint[1]]
                        ], {
                            color: segmentColor,
                            weight: 6,
                            opacity: 0.9
                        }).addTo(map);

                        segment.bindPopup(
                            "Segmen Drive Test<br>" +
                            "RSRP: <b>" + rsrp + " dBm</b><br>" +
                            "RSRQ: <b>" + rsrq + " dB</b><br>" +
                            "SINR: <b>" + sinr + " dB</b><br>" +
                            "PCI: <b>" + pci + "</b><br>" +
                            "Earfcn: <b>" + earfcn + "</b><br>" +
                            "Band: <b>" + band + "</b><br>" +
                            "Freq: <b>" + frequency + "</b><br>" +
                            "Waktu: <b>" + waktu + "</b><br>" +
                            "Koordinat: " + latitude.toFixed(6) + ", " + longitude.toFixed(6)
                        );
                    }

                    // 4. MARKER PENGUKURAN (Titik Data)
                    var measurementIcon = L.icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
                        iconSize: [0, 0], // Marker size zeroed out because we mainly show polyline
                        iconAnchor: [7, 25],
                        popupAnchor: [1, -90]
                    });

                    measurementPoints.forEach(function(point) {
                        var rsrp = point[2];
                        var rsrq = point[3];
                        var infoTambahan = point[4];

                        L.marker([point[0], point[1]], {
                                icon: measurementIcon
                            })
                            .addTo(map)
                            .bindPopup(
                                "<b>Titik Data</b><br>" +
                                "RSRP: " + rsrp + " dBm<br>" +
                                "RSRQ: " + rsrq + " dB<br>" +
                                infoTambahan + "<br>" +
                                "Koordinat: " + point[0].toFixed(6) + ", " + point[1].toFixed(6)
                            );
                    });

                    // OPTIONAL: Sesuaikan batas peta (fit bounds)
                    var latLngs = measurementPoints.map(p => [p[0], p[1]]);
                    map.fitBounds(L.polyline(latLngs).getBounds());
                }


                // 5. TAMBAH LEGENDA 
                var legend = L.control({
                    position: 'bottomright'
                });
                legend.onAdd = function(map) {
                    var div = L.DomUtil.create('div',
                            'info p-2 text-sm bg-white bg-opacity-90 shadow-md rounded-md'),
                        rsrq_colors = ['#E74C3C', '#F4D03F', '#2ECC71'];
                    var rsrq_labels = ["< -90 dB (Buruk)", "-90 s/d -70 dB (Sedang)",
                        "> -70 dB (Baik)"
                    ];

                    div.innerHTML += '<b class="font-bold">Kualitas RSRQ (dB)</b><br>';

                    for (var i = 0; i < rsrq_colors.length; i++) {
                        div.innerHTML +=
                            '<i style="background:' + rsrq_colors[i] +
                            '; width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; border-radius: 3px;"></i> ' +
                            rsrq_labels[i] + '<br>';
                    }

                    return div;
                };
                legend.addTo(map);

            }); // END of allMapsData.forEach()
        }); // END of DOMContentLoaded
    </script>
@endpush
