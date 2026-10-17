@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary p-2 fs-6">👨‍⚕️ Doctor Profile</span>
                            <h4 class="mb-0 fw-bold">Dr. {{ $doctor->name }}</h4>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('appointments.create', ['doctor_id' => $doctor->id]) }}" class="btn btn-success btn-sm">+ Book Appointment</a>
                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('doctors.index') }}" class="btn btn-outline-secondary btn-sm">← Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Profile Image & Quick Facts -->
                        <div class="col-md-4 text-center border-end">
                            @if($doctor->profile_image)
                                <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="{{ $doctor->name }}" 
                                     class="rounded-circle shadow-sm mb-3" style="width: 140px; height: 140px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3 text-secondary" style="width: 140px; height: 140px; font-size: 3rem;">
                                    👨‍⚕️
                                </div>
                            @endif
                            <h5 class="fw-bold mb-1">Dr. {{ $doctor->name }}</h5>
                            <p class="badge bg-primary mb-2">{{ $doctor->department }}</p>
                            <p class="text-muted small mb-0">Experience: <strong>{{ $doctor->experience }} Years</strong></p>
                        </div>

                        <!-- Professional & Contact Information -->
                        <div class="col-md-8">
                            <h5 class="fw-bold text-secondary mb-3">📋 Professional Credentials & Contacts</h5>
                            <div class="row g-2 mb-3">
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Specializations:</small>
                                    @php
                                        $specialists = is_string($doctor->specialists) ? json_decode($doctor->specialists, true) : $doctor->specialists;
                                    @endphp
                                    @if(!empty($specialists) && is_array($specialists))
                                        @foreach($specialists as $spec)
                                            <span class="badge bg-info text-dark me-1">{{ $spec }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted small">General Practitioner</span>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Designations & Degrees:</small>
                                    @php
                                        $designations = is_string($doctor->designations) ? json_decode($doctor->designations, true) : $doctor->designations;
                                    @endphp
                                    @if(!empty($designations) && is_array($designations))
                                        @foreach($designations as $desig)
                                            <span class="badge bg-light text-dark border me-1">{{ $desig }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted small">MBBS</span>
                                    @endif
                                </div>
                            </div>

                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th class="text-muted w-30">Phone:</th>
                                    <td>{{ $doctor->phone }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Email:</th>
                                    <td>{{ $doctor->email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Date of Joining:</th>
                                    <td>{{ $doctor->date_of_joining }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Blood Group:</th>
                                    <td><span class="badge bg-danger">{{ $doctor->blood_group }}</span></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Address:</th>
                                    <td>{{ $doctor->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Doctor's Consultations / Appointments -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold text-primary">📅 Patient Consultations Scheduled</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Serial</th>
                                    <th>Date & Time</th>
                                    <th>Patient Name</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($doctor->appointments as $apt)
                                    <tr>
                                        <td>#{{ $apt->serial_number }}</td>
                                        <td>{{ $apt->appointment_date }} ({{ $apt->appointment_time }})</td>
                                        <td>{{ $apt->patient->name ?? 'N/A' }}</td>
                                        <td>{{ $apt->reason }}</td>
                                        <td>
                                            <span class="badge bg-{{ $apt->status === 'Confirmed' ? 'success' : 'warning' }}">
                                                {{ $apt->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <em>No consultations scheduled yet for this doctor.</em>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
