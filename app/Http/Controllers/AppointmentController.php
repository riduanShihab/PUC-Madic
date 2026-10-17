<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $date = $request->input('date');
        $doctorId = $request->input('doctor_id');

        $appointments = Appointment::query()->with(['doctor', 'patient'])
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($date, function ($query, $date) {
                return $query->whereDate('appointment_date', $date);
            })
            ->when($doctorId, function ($query, $doctorId) {
                return $query->where('doctor_id', $doctorId);
            })
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'asc')
            ->paginate(10);

        $doctors = Doctor::query()->orderBy('name')->get();

        return view('appointments.index', compact('appointments', 'doctors', 'status', 'date', 'doctorId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $doctors = Doctor::query()->orderBy('name')->get();
        $patients = Patient::query()->orderBy('name')->get();
        $selectedPatientId = $request->input('patient_id');
        $selectedDoctorId = $request->input('doctor_id');

        return view('appointments.create', compact('doctors', 'patients', 'selectedPatientId', 'selectedDoctorId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|string',
            'reason' => 'required|string|max:255',
            'doctor_notes' => 'nullable|string|max:1000',
        ]);

        // Auto-assign serial number for this doctor on this day
        $lastSerial = Appointment::query()->where('doctor_id', $validated['doctor_id'])
            ->whereDate('appointment_date', $validated['appointment_date'])
            ->max('serial_number') ?? 0;

        $validated['serial_number'] = $lastSerial + 1;
        $validated['status'] = 'Confirmed';

        Appointment::query()->create($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully! Serial #' . $validated['serial_number']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $appointment = Appointment::query()->with(['doctor', 'patient'])->findOrFail($id);

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctors = Doctor::query()->orderBy('name')->get();
        $patients = Patient::query()->orderBy('name')->get();

        return view('appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
            'reason' => 'required|string|max:255',
            'doctor_notes' => 'nullable|string|max:1000',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled and removed successfully!');
    }
}
