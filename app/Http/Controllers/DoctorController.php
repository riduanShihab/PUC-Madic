<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'blood_group' => 'required|string|max:10',
            'department' => 'required|string|max:100',
            'experience' => 'required|numeric',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $doctor = new Doctor($request->except('profile_image', 'specialists', 'designations'));

        // Save specialists and designations as JSON
        $doctor->specialists = json_encode($request->input('specialists', []));
        $doctor->designations = json_encode($request->input('designations', []));

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('doctors', 'public');
            $doctor->profile_image = $path;
        }

        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully!');
    }

    // You can also define edit, update, and destroy methods here as needed
    public function edit($id)
{
   $doctor = Doctor::findOrFail($id);
    return view('doctors.edit', compact('doctor'));
}
public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'age' => 'required|numeric',
        'phone' => 'required|string|max:20',
        'email' => 'required|email',
        'address' => 'required|string',
        'date_of_birth' => 'required|date',
        'date_of_joining' => 'required|date',
        'blood_group' => 'required|string|max:10',
        'department' => 'required|string|max:100',
        'experience' => 'required|numeric',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Find the doctor by ID or fail with 404
    $doctor = Doctor::findOrFail($id);

    // Fill the doctor model with request data except file and JSON fields
    $doctor->fill($request->except('profile_image', 'specialists', 'designations'));

    // Convert specialists and designations inputs to JSON (filter out empty strings)
    $doctor->specialists = json_encode(array_filter($request->input('specialists', [])));
    $doctor->designations = json_encode(array_filter($request->input('designations', [])));

    // If a new profile image is uploaded, store it and update path
    if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('doctors', 'public');
        $doctor->profile_image = $path;
    }

    // Save the updated doctor record
    $doctor->save();

    // Redirect back to doctors index with success message
    return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully!');
}



}
