@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h3 class="mb-1 fw-bold text-primary">📅 Appointments Schedule</h3>
                    <p class="text-muted small mb-0">Track and manage patient-doctor consultations at PUC Medic</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                        + Book New Appointment
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filters -->
            <form action="{{ route('appointments.index') }}" method="GET" class="card bg-light border-0 p-3 mb-4">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted">Filter by Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="">All Statuses</option>
                            @foreach(['Pending', 'Confirmed', 'Completed', 'Cancelled'] as $st)
                                <option value="{{ $st }}" {{ ($status ?? '') == $st ? 'selected' : '' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted">Filter by Doctor</label>
                        <select name="doctor_id" class="form-select form-select-sm">
                            <option value="">All Doctors</option>
                            @foreach($doctors as $doc)
                                <option value="{{ $doc->id }}" {{ ($doctorId ?? '') == $doc->id ? 'selected' : '' }}>Dr. {{ $doc->name }} ({{ $doc->department }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted">Filter by Date</label>
                        <input type="date" name="date" class="form-control form-control-sm" value="{{ $date ?? '' }}">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary flex-grow-1">Filter</button>
                        <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Serial #</th>
                            <th>Date & Time</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Reason / Symptoms</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $apt)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary font-monospace fs-6">#{{ $apt->serial_number }}</span>
                                </td>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($apt->appointment_date)->format('M d, Y') }}</strong>
                                    <br><small class="text-muted">⏰ {{ $apt->appointment_time }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('patients.show', $apt->patient->id) }}" class="text-decoration-none fw-semibold">
                                        {{ $apt->patient->name }}
                                    </a>
                                    <br><small class="text-muted">{{ $apt->patient->patient_id }} • {{ $apt->patient->phone }}</small>
                                </td>
                                <td>
                                    <strong>Dr. {{ $apt->doctor->name }}</strong>
                                    <br><small class="text-muted">{{ $apt->doctor->department }}</small>
                                </td>
                                <td>
                                    <span>{{ Str::limit($apt->reason, 40) }}</span>
                                </td>
                                <td>
                                    @php
                                        $badgeColor = match($apt->status) {
                                            'Confirmed' => 'success',
                                            'Completed' => 'info',
                                            'Cancelled' => 'danger',
                                            default => 'warning'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeColor }}">{{ $apt->status }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('appointments.show', $apt->id) }}" class="btn btn-outline-info">View</a>
                                        <a href="{{ route('appointments.edit', $apt->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <form action="{{ route('appointments.destroy', $apt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this appointment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Cancel</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <em>No appointments found matching your criteria.</em>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $appointments->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
