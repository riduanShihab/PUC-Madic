<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::query()->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('patient_id', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%")
                         ->orWhere('blood_group', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('patients.index', compact('patients', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate a suggested unique ID like PUC-P-1042
        $suggestedId = 'PUC-P-' . mt_rand(1000, 9999);
        while (Patient::query()->where('patient_id', $suggestedId)->exists()) {
            $suggestedId = 'PUC-P-' . mt_rand(1000, 9999);
        }

        return view('patients.create', compact('suggestedId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|string|max:50|unique:patients,patient_id',
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'age' => 'required|integer|min:0|max:130',
            'date_of_birth' => 'nullable|date',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'blood_group' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:500',
            'emergency_contact' => 'nullable|string|max:20',
            'medical_history' => 'nullable|string|max:2000',
            'allergies' => 'nullable|string|max:500',
        ]);

        Patient::query()->create($validated);

        return redirect()->route('patients.index')->with('success', 'Patient registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::query()->with(['appointments.doctor'])->findOrFail($id);

        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);

        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|string|max:50|unique:patients,patient_id,' . $patient->id,
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'age' => 'required|integer|min:0|max:130',
            'date_of_birth' => 'nullable|date',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'blood_group' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:500',
            'emergency_contact' => 'nullable|string|max:20',
            'medical_history' => 'nullable|string|max:2000',
            'allergies' => 'nullable|string|max:500',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Patient details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient record deleted successfully!');
    }
}
