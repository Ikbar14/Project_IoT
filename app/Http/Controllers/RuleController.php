<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;

use PhpMqtt\Client\Facades\MQTT;


class RuleController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Rule::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rule_cluster_id' => 'required|integer',
            'sensor_id' => 'required|exists:logs,id',
            'sensor_operator' => 'required|in:more than,less than',
            'sensor_value' => 'required|numeric',
            'actuator_id' => 'required|exists:logs,id',
            'actuator_value' => 'required|numeric',
        ]);
        
        $rule = Rule::create($request->all());

        $data = [
            'rule_cluster_id' => $request->rule_cluster_id,
            'sensor_id' => $request-> sensor_id,
            'sensor_operator' => $request-> sensor_id,
            'sensor_value' => $request-> sensor_value,
            'actuator_id' => $request-> actuator_id,
            'actuator_value' => $request-> actuator_value,
         ];
    
            $mqtt = MQTT::connection();
            $mqtt->publish('rule/actuator', json_encode($data));

        return response()->json(['message' => 'Rule created successfully.', 'rule' => $rule], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rule = Rule::findOrFail($id);
        return $rule;
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rule_cluster_id' => 'sometimes|required|integer',
            'sensor_id' => 'sometimes|required|exists:logs,id',
            'sensor_operator' => 'sometimes|required|in:more than,less than',
            'sensor_value' => 'sometimes|required|numeric',
            'actuator_id' => 'sometimes|required|exists:logs,id',
            'actuator_value' => 'sometimes|required|numeric',
        ]);

        $rule = Rule::findOrFail($id);
        $rule->update($request->all());

        return response()->json(['message' => 'Rule updated successfully.', 'rule' => $rule], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rule = Rule::findOrFail($id);
        $rule->delete();

        return response()->json(['message' => 'Rule deleted successfully.'], 200);
    }

}
