@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-primary p-2 fs-6">👤 Patient Profile</span>
                            <h4 class="mb-0 fw-bold">{{ $patient->name }}</h4>
                            <span class="badge bg-secondary font-monospace">{{ $patient->patient_id }}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-primary btn-sm">Edit Profile</a>
                            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary btn-sm">← Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Left Column: Demographics & Contact -->
                        <div class="col-md-6 border-end">
                            <h5 class="fw-bold text-secondary mb-3">📋 Personal & Contact Details</h5>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th class="text-muted w-40">Gender:</th>
                                    <td>{{ $patient->gender }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Age:</th>
                                    <td>{{ $patient->age }} Years @if($patient->date_of_birth) <small class="text-muted">({{ $patient->date_of_birth }})</small> @endif</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Blood Group:</th>
                                    <td><span class="badge bg-danger">{{ $patient->blood_group ?? 'Not Specified' }}</span></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Phone:</th>
                                    <td><strong>{{ $patient->phone }}</strong></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Email:</th>
                                    <td>{{ $patient->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Emergency Contact:</th>
                                    <td>{{ $patient->emergency_contact ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Address:</th>
                                    <td>{{ $patient->address ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Right Column: Medical History & Notes -->
                        <div class="col-md-6">
                            <h5 class="fw-bold text-secondary mb-3">🩺 Medical Background</h5>
                            <div class="mb-3">
                                <label class="fw-semibold text-danger d-block">⚠️ Allergies:</label>
                                <div class="p-2 bg-light rounded border">
                                    {{ $patient->allergies ?: 'None reported.' }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-semibold text-primary d-block">📝 Medical History & Chronic Conditions:</label>
                                <div class="p-2 bg-light rounded border">
                                    {{ $patient->medical_history ?: 'No previous chronic medical history recorded.' }}
                                </div>
                            </div>
                            <div class="text-muted small">
                                <strong>Registered on:</strong> {{ $patient->created_at->format('M d, Y h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointments Section -->
            @if(isset($patient->appointments) && $patient->appointments->count() > 0)
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-primary">📅 Appointment History</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Doctor</th>
                                        <th>Reason / Symptoms</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patient->appointments as $apt)
                                        <tr>
                                            <td>{{ $apt->appointment_date }} ({{ $apt->appointment_time }})</td>
                                            <td>{{ $apt->doctor->name ?? 'Doctor' }}</td>
                                            <td>{{ $apt->reason }}</td>
                                            <td>
                                                <span class="badge bg-{{ $apt->status === 'Confirmed' ? 'success' : ($apt->status === 'Cancelled' ? 'danger' : 'warning') }}">
                                                    {{ $apt->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
