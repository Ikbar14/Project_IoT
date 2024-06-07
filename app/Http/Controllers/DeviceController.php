<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

use PhpMqtt\Client\Facades\MQTT;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        
           return Device::all();
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'device_name' => 'required',
            'device_type' => 'required|in:sensor,actuator',
        ]);

        $device = new Device();
        $device->device_name = $request->device_name;
        $device->device_type = $request->device_type;
        $device->save();

        $data = [
            'device_name' => $request->device_name,
            'device_type' => $request->device_type,
        ];

        $mqtt = MQTT::connection();
        $mqtt->publish('device/sensor', json_encode($data));



        return response()->json(["message" => "Device updated."], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Device::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'device_name' => 'required',
            'device_type' => 'required|in:sensor,actuator',
        ]);

        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->device_name = $request->input('device_name', $device->device_name);
            $device->device_type = $request->input('device_type', $device->device_type);
            $device->save();



            return response()->json(["message" => "Device updated."], 201);
        } else {
            return response()->json(["message" => "Device not found."], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->delete();
            return response()->json(["message" => "Device deleted."], 201);
        } else {
            return response()->json(["message" => "Device not found."], 404);
        }
    }
}
