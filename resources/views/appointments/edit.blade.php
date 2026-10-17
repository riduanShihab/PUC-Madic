@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-primary">✏️ Edit Appointment #{{ $appointment->serial_number }}</h4>
                        <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary btn-sm">← Back to Appointments</a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Patient (Fixed or selectable) -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Patient <span class="text-danger">*</span></label>
                            <select name="patient_id" class="form-select" required>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }} ({{ $patient->patient_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Doctor -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Consulting Doctor <span class="text-danger">*</span></label>
                            <select name="doctor_id" class="form-select" required>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->name }} ({{ $doctor->department }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date & Time Slot -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Appointment Date <span class="text-danger">*</span></label>
                                <input type="date" name="appointment_date" class="form-control" value="{{ old('appointment_date', $appointment->appointment_date) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Time Slot <span class="text-danger">*</span></label>
                                <input type="text" name="appointment_time" class="form-control" value="{{ old('appointment_time', $appointment->appointment_time) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    @foreach(['Pending', 'Confirmed', 'Completed', 'Cancelled'] as $st)
                                        <option value="{{ $st }}" {{ old('status', $appointment->status) == $st ? 'selected' : '' }}>{{ $st }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Reason / Symptoms -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Reason for Visit <span class="text-danger">*</span></label>
                            <input type="text" name="reason" class="form-control" value="{{ old('reason', $appointment->reason) }}" required>
                        </div>

                        <!-- Clinical Notes -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Clinical Notes / Prescription Remarks</label>
                            <textarea name="doctor_notes" class="form-control" rows="3">{{ old('doctor_notes', $appointment->doctor_notes) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">Update Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
