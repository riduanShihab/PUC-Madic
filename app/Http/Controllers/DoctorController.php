<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::withCount('appointments')->orderBy('name')->get();
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
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'blood_group' => 'required|string|max:10',
            'department' => 'required|string|max:100',
            'experience' => 'required|numeric',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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

    /**
     * Display the specified doctor profile.
     */
    public function show($id)
    {
        $doctor = Doctor::with(['appointments.patient'])->findOrFail($id);
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'blood_group' => 'required|string|max:10',
            'department' => 'required|string|max:100',
            'experience' => 'required|numeric',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->fill($request->except('profile_image', 'specialists', 'designations'));

        $doctor->specialists = json_encode(array_filter($request->input('specialists', [])));
        $doctor->designations = json_encode(array_filter($request->input('designations', [])));

        if ($request->hasFile('profile_image')) {
            // Delete previous image if exists
            if ($doctor->profile_image && Storage::disk('public')->exists($doctor->profile_image)) {
                Storage::disk('public')->delete($doctor->profile_image);
            }
            $path = $request->file('profile_image')->store('doctors', 'public');
            $doctor->profile_image = $path;
        }

        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully!');
    }

    /**
     * Remove the specified doctor from storage.
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        if ($doctor->profile_image && Storage::disk('public')->exists($doctor->profile_image)) {
            Storage::disk('public')->delete($doctor->profile_image);
        }

        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully!');
    }
}
