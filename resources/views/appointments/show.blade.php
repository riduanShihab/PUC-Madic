@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary p-2 fs-6">📅 Appointment Slip</span>
                            <span class="badge bg-secondary font-monospace fs-6">Serial #{{ $appointment->serial_number }}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary btn-sm">← Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Top Status Banner -->
                    <div class="d-flex justify-content-between align-items-center p-3 mb-4 rounded bg-light border">
                        <div>
                            <small class="text-muted d-block">Scheduled Consultation</small>
                            <h5 class="mb-0 fw-bold text-dark">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }} at {{ $appointment->appointment_time }}
                            </h5>
                        </div>
                        <div>
                            @php
                                $badgeColor = match($appointment->status) {
                                    'Confirmed' => 'success',
                                    'Completed' => 'info',
                                    'Cancelled' => 'danger',
                                    default => 'warning'
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeColor }} fs-6">{{ $appointment->status }}</span>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <!-- Patient Info -->
                        <div class="col-md-6 border-end">
                            <h6 class="fw-bold text-secondary text-uppercase mb-3">🧑‍🤝‍🧑 Patient Details</h6>
                            <h5 class="fw-bold mb-1">{{ $appointment->patient->name }}</h5>
                            <p class="text-muted small mb-2">ID: <span class="font-monospace">{{ $appointment->patient->patient_id }}</span></p>
                            <ul class="list-unstyled small mb-0">
                                <li><strong>Age/Gender:</strong> {{ $appointment->patient->age }} yrs ({{ $appointment->patient->gender }})</li>
                                <li><strong>Phone:</strong> {{ $appointment->patient->phone }}</li>
                                <li><strong>Blood Group:</strong> <span class="badge bg-danger">{{ $appointment->patient->blood_group ?? 'N/A' }}</span></li>
                                @if($appointment->patient->allergies)
                                    <li class="text-danger mt-1"><strong>Allergies:</strong> {{ $appointment->patient->allergies }}</li>
                                @endif
                            </ul>
                        </div>

                        <!-- Doctor Info -->
                        <div class="col-md-6">
                            <h6 class="fw-bold text-secondary text-uppercase mb-3">👨‍⚕️ Assigned Doctor</h6>
                            <div class="d-flex align-items-center gap-3">
                                @if($appointment->doctor->profile_image)
                                    <img src="{{ asset('storage/' . $appointment->doctor->profile_image) }}" alt="{{ $appointment->doctor->name }}" class="rounded-circle" style="width: 55px; height: 55px; object-fit: cover;">
                                @endif
                                <div>
                                    <h5 class="fw-bold mb-0">Dr. {{ $appointment->doctor->name }}</h5>
                                    <p class="text-primary small mb-1">{{ $appointment->doctor->department }}</p>
                                    <p class="text-muted small mb-0">Exp: {{ $appointment->doctor->experience }} Years • Phone: {{ $appointment->doctor->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Reason & Doctor Notes -->
                    <div class="mb-3">
                        <label class="fw-bold text-secondary text-uppercase small d-block">Reason for Visit / Chief Complaint:</label>
                        <div class="p-3 bg-light rounded border mt-1">
                            {{ $appointment->reason }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold text-secondary text-uppercase small d-block">Doctor's Clinical Notes / Instructions:</label>
                        <div class="p-3 bg-light rounded border mt-1">
                            {{ $appointment->doctor_notes ?: 'No notes or prescription recorded yet.' }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center text-muted small border-top pt-3">
                        <span>Booked on: {{ $appointment->created_at->format('M d, Y h:i A') }}</span>
                        <button onclick="window.print()" class="btn btn-sm btn-outline-dark">🖨️ Print Slip</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
