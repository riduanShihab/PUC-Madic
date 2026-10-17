@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h3 class="mb-1 fw-bold text-primary">🧑‍🤝‍🧑 Patients Registry</h3>
                    <p class="text-muted small mb-0">Manage registered students, faculty, and patients at PUC Medic</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        + Register New Patient
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Search Filter -->
            <form action="{{ route('patients.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by patient name, ID, phone, or blood group..." value="{{ $search ?? '' }}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                    @if(!empty($search))
                        <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Clear</a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>Age / Gender</th>
                            <th>Phone</th>
                            <th>Blood Group</th>
                            <th>Emergency Contact</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary font-monospace">{{ $patient->patient_id }}</span>
                                </td>
                                <td>
                                    <strong>{{ $patient->name }}</strong>
                                    @if($patient->email)
                                        <br><small class="text-muted">{{ $patient->email }}</small>
                                    @endif
                                </td>
                                <td>{{ $patient->age }} yrs <span class="text-muted">({{ $patient->gender }})</span></td>
                                <td>{{ $patient->phone }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ $patient->blood_group ?? 'N/A' }}</span>
                                </td>
                                <td>{{ $patient->emergency_contact ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-outline-info" title="View Profile">View</a>
                                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-outline-primary" title="Edit">Edit</a>
                                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove patient {{ $patient->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <em>No patient records found.</em>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $patients->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
