@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">👨‍⚕️ All Doctors</h2>
@endsection

@section('content')
<!-- Bootstrap 4 CDN -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
    .card {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .doctor-table img {
        border-radius: 50%;
        object-fit: cover;
        height: 50px;
        width: 50px;
    }

    .btn-success {
        font-weight: bold;
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }
</style>

<div class="container mt-4">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">👨‍⚕️ All Doctors</h3>
            <a href="{{ route('doctors.create') }}" class="btn btn-success">+ Add Doctor</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive doctor-table">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Experience</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td>
                                @if($doctor->profile_image)
                                    <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="{{ $doctor->name }}">
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $doctor->name }}</strong>
                                @if(isset($doctor->appointments_count) && $doctor->appointments_count > 0)
                                    <span class="badge bg-secondary ms-1">{{ $doctor->appointments_count }} appts</span>
                                @endif
                            </td>
                            <td><span class="badge bg-primary">{{ $doctor->department }}</span></td>
                            <td>{{ $doctor->experience }} Years</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-outline-info">View</a>
                                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-outline-primary">Edit</a>
                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete Dr. {{ $doctor->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No doctors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
