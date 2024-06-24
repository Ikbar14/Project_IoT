<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // Show Data
    public function index(Request $request)
    {
        $employees = Employee::all();
        return response()->json(['data' => $employees]);
    }

    // CREATE Method
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Number'        => 'required|string|max:255',
            'Name'          => 'required|string|max:255',
            'Email'         => 'required|email|max:255',
            'Address'       => 'required|string|max:255',
            'Phone_Number'  => 'required|string|max:255',
            'Position'      => 'required|string|max:255',
            'Status'        => 'required|in:Active,Deactive,Out',
            'City'          => 'required|string|max:255',
            'Country'       => 'required|string|max:255',
        ]);

        $employee = Employee::create($validatedData);

        return response()->json(['message' => 'Employee data has been added successfully', 'data' => $employee], 201);
    }

    // READ Method
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json(['data' => $employee]);
    }

    // UPDATE Method
    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'Number'        => 'sometimes|string|max:255',
            'Name'          => 'sometimes|string|max:255',
            'Email'         => 'sometimes|email|max:255',
            'Address'       => 'sometimes|string|max:255',
            'Phone_Number'  => 'sometimes|string|max:255',
            'Position'      => 'sometimes|string|max:255',
            'Status'        => 'sometimes|in:Active,Deactive,Out',
            'City'          => 'sometimes|string|max:255',
            'Country'       => 'sometimes|string|max:255',
        ]);

        $employee->update($validatedData);

        return response()->json(['message' => 'Employee updated successfully', 'data' => $employee]);
    }

    // DELETE Method
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}