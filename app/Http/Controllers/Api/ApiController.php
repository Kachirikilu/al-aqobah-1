<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    public function handleMqttData(array $data)
    {
        Log::debug('MQTT Data Received', $data);
        $jsonData = [
            'id' => $data['id'],
            'message' => $data['message'],
            'image' => $data['image']
        ];
        cache()->put('esp32Cam', $jsonData, now()->addMinutes(30));

        if ($data['message'] == "Gerakan terdeteksi!") {
            cache()->put('esp32Cam_motion', $data['message'], now()->addSeconds(30));
        }
    }

    public function getData()
    {
        $jsonData = cache()->get('esp32Cam');

        if ($jsonData) {
            return response()->json(['data' => $jsonData]);
        }
        return response()->json(['message' => 'Data belum tersedia'], 404);
    }
    
    public function getMotion()
    {
        $jsonData = cache()->get('esp32Cam_motion');

        if ($jsonData) {
            return response()->json(['data' => $jsonData]);
        }
        // return response()->json(['message' => 'Data belum tersedia'], 404);
    }

    public function sendMqttMessage(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'message' => 'required|string',
            'image' => 'nullable|string',
        ]);

        MQTT::connection()->publish('iot/PlantCare', json_encode($data));
        return response()->json(['success' => true]);
    }


}
