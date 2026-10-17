@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-primary">📅 Book New Appointment</h4>
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

                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf

                        <!-- Patient Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Select Patient <span class="text-danger">*</span></label>
                            <select name="patient_id" class="form-select" required>
                                <option value="" disabled {{ empty($selectedPatientId) ? 'selected' : '' }}>-- Choose Patient --</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ (old('patient_id') ?? $selectedPatientId) == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }} ({{ $patient->patient_id }} • {{ $patient->phone }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Not in list? <a href="{{ route('patients.create') }}" target="_blank">Register new patient here</a></small>
                        </div>

                        <!-- Doctor Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Consulting Doctor <span class="text-danger">*</span></label>
                            <select name="doctor_id" class="form-select" required>
                                <option value="" disabled {{ empty($selectedDoctorId) ? 'selected' : '' }}>-- Choose Doctor --</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ (old('doctor_id') ?? $selectedDoctorId) == $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->name }} — {{ $doctor->department }} (Exp: {{ $doctor->experience }} yrs)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date & Time Slot -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Appointment Date <span class="text-danger">*</span></label>
                                <input type="date" name="appointment_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('appointment_date', date('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Time Slot <span class="text-danger">*</span></label>
                                <select name="appointment_time" class="form-select" required>
                                    <option value="" disabled selected>-- Select Time Slot --</option>
                                    @php
                                        $slots = [
                                            '09:00 AM - 09:30 AM', '09:30 AM - 10:00 AM',
                                            '10:00 AM - 10:30 AM', '10:30 AM - 11:00 AM',
                                            '11:00 AM - 11:30 AM', '11:30 AM - 12:00 PM',
                                            '02:00 PM - 02:30 PM', '02:30 PM - 03:00 PM',
                                            '03:00 PM - 03:30 PM', '03:30 PM - 04:00 PM',
                                            '04:00 PM - 04:30 PM', '04:30 PM - 05:00 PM'
                                        ];
                                    @endphp
                                    @foreach($slots as $slot)
                                        <option value="{{ $slot }}" {{ old('appointment_time') == $slot ? 'selected' : '' }}>{{ $slot }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Reason / Symptoms -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Reason for Visit / Symptoms <span class="text-danger">*</span></label>
                            <input type="text" name="reason" class="form-control" placeholder="e.g. Fever, persistent cough, routine health checkup..." value="{{ old('reason') }}" required>
                        </div>

                        <!-- Clinical Notes -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Initial Notes / Clinical Remarks (Optional)</label>
                            <textarea name="doctor_notes" class="form-control" rows="2" placeholder="Any advance instructions or intake notes...">{{ old('doctor_notes') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">Confirm & Book Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
