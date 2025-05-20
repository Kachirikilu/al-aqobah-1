    <div class="bg-white shadow-md rounded-lg p-8 w-96">
        <h1 class="text-2xl font-bold mb-4 text-center text-gray-800">Data MQTT</h1>

        <div id="statusIndicator" class="mb-4 text-sm text-gray-600 italic text-center">Menghubungkan...</div>

        <div id="mqttDataContainer" class="space-y-4">
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/mqtt@4.3.7/dist/mqtt.min.js"></script>
    <script>
        const brokerUrl = "{{ env('MQTT_BROKER_URL') }}";
        const topic = "{{ env('MQTT_TOPIC') }}";
        const client = mqtt.connect(brokerUrl, {
            username: "{{ env('MQTT_AUTH_USERNAME') }}",
            password: "{{ env('MQTT_AUTH_PASSWORD') }}",
            reconnectPeriod: 1000,
            keepalive: 60
        });

        const mqttDataContainer = document.getElementById('mqttDataContainer');
        const statusIndicator = document.getElementById('statusIndicator');

        client.on('connect', function () {
            console.log('Terhubung ke broker MQTT');
            statusIndicator.textContent = 'Connected to MQTT Broker';
            client.subscribe(topic, function (err) {
                if (err) {
                    console.error(`Gagal berlangganan ke topik: ${topic}`, err);
                    statusIndicator.textContent = `Error subscribing: ${err.message}`;
                } else {
                    console.log(`Berlangganan ke topik: ${topic}`);
                }
            });
        });

        client.on('message', function (receivedTopic, message) {
            if (receivedTopic === topic) {
                try {
                    const data = JSON.parse(message.toString());
                    console.log('Data MQTT diterima:', data);
                    displayMqttData(data);
                } catch (error) {
                    console.error('Gagal mem-parsing pesan JSON:', message.toString(), error);
                    statusIndicator.textContent = 'Gagal mem-parsing pesan JSON';
                }
            }
        });

        function displayMqttData(data) {
            const dataDiv = document.createElement('div');
            dataDiv.className = 'bg-white rounded-md shadow-sm p-4 border border-gray-200';

            const idParagraph = document.createElement('p');
            idParagraph.className = 'text-gray-700 mb-2';
            idParagraph.textContent = `ID: ${data.id}`;

            const imageElement = document.createElement('img');
            imageElement.className = 'rounded-md mb-2 w-full h-auto';
            imageElement.src = `data:image/jpeg;base64,${data.image}`; // Asumsi format JPEG, sesuaikan jika beda
            imageElement.alt = `Gambar dengan ID ${data.id}`;

            const messageParagraph = document.createElement('p');
            messageParagraph.className = 'text-gray-800';
            messageParagraph.textContent = `Pesan: ${data.message}`;

            dataDiv.appendChild(idParagraph);
            dataDiv.appendChild(imageElement);
            dataDiv.appendChild(messageParagraph);

            mqttDataContainer.prepend(dataDiv); // Tambahkan data terbaru di atas
        }

        client.on('offline', function () {
            statusIndicator.textContent = 'Disconnected from MQTT Broker';
        });

        client.on('error', function (error) {
            console.error('Error MQTT:', error);
            statusIndicator.textContent = `MQTT Error: ${error.message}`;
        });

        client.on('reconnect', function () {
            statusIndicator.textContent = 'Reconnecting to MQTT Broker...';
        });
    </script>