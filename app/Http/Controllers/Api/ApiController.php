<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ApiController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum')->except(['handleHttpData']); // Tambahkan 'except'
    // }

    public function handleMqttData(array $data)
    {
        $jsonData = [
            'id_device' => $data['id'],
            'message' => $data['message'],
            'image' => $data['image']
        ];
        cache()->put('esp32Cam', $jsonData, now()->addMinutes(30));

        if ($data['message'] == "Gerakan terdeteksi!") {
            cache()->put('esp32Cam_motion', $data['message'], now()->addSeconds(30));
        }
    }
    public function sendMqttMessage(Request $request)
    {
        $data = $request->validate([
            'id_device' => 'required|integer',
            'message' => 'required|string',
            'image' => 'nullable|string',
        ]);

        MQTT::connection()->publish('iot/PlantCare', json_encode($data));
        return response()->json(['success' => true]);
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
        return response()->json(['message' => 'Data belum tersedia'], 404);
    }



    public function handleHttpData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_device' => 'required|integer', 
            'message' => 'required|string|max:255', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        $validatedData = $validator->validated();

        $imageFileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageFileName = 'ESP32_' . $validatedData['id_device'] . '_' . $file->getClientOriginalName() . '_' . time();
            $imagePath = $file->move(public_path('images/iot'), $imageFileName);
        }

        $dataToCache = [
            'id_device' => $validatedData['id_device'],
            'message' => $validatedData['message'],
            'image' => $imageFileName
        ];

        cache()->put('esp32Cam', $dataToCache, now()->addMinutes(30));

        if ($validatedData['message'] == "Gerakan terdeteksi!") {
            cache()->put('esp32Cam_motion', $validatedData['message'], now()->addSeconds(30));
        }

        return response()->json(['status' => 'success', 'message' => 'Data and image received successfully'], 200);
    }



}
