@extends('layouts.app')

@section('content')
<div class="container">
    <h2>✏️ Edit Doctor</h2>

    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
        </div>

        <!-- Age -->
        <div class="mb-3">
            <label>Age:</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $doctor->age) }}" required>
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}" required>
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label>Address:</label>
            <textarea name="address" class="form-control" required>{{ old('address', $doctor->address) }}</textarea>
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
            <label>Date of Birth:</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $doctor->date_of_birth) }}" required>
        </div>

        <!-- Date of Joining -->
        <div class="mb-3">
            <label>Date of Joining:</label>
            <input type="date" name="date_of_joining" class="form-control" value="{{ old('date_of_joining', $doctor->date_of_joining) }}" required>
        </div>

        <!-- Blood Group -->
        <div class="mb-3">
            <label>Blood Group:</label>
            <input type="text" name="blood_group" class="form-control" value="{{ old('blood_group', $doctor->blood_group) }}" required>
        </div>

        <!-- Department -->
        <div class="mb-3">
            <label>Department:</label>
            <input type="text" name="department" class="form-control" value="{{ old('department', $doctor->department) }}" required>
        </div>

        <!-- Experience -->
        <div class="mb-3">
            <label>Experience (years):</label>
            <input type="number" name="experience" class="form-control" value="{{ old('experience', $doctor->experience) }}" required>
        </div>

        <!-- Specialists -->
        <div class="mb-3">
            <label>Specialists:</label>
            <input type="text" name="specialists[]" class="form-control mb-1" value="{{ json_decode($doctor->specialists)[0] ?? '' }}">
            <input type="text" name="specialists[]" class="form-control mb-1" value="{{ json_decode($doctor->specialists)[1] ?? '' }}">
            <!-- Add more inputs if needed -->
        </div>

        <!-- Designations -->
        <div class="mb-3">
            <label>Designations:</label>
            <input type="text" name="designations[]" class="form-control mb-1" value="{{ json_decode($doctor->designations)[0] ?? '' }}">
            <input type="text" name="designations[]" class="form-control mb-1" value="{{ json_decode($doctor->designations)[1] ?? '' }}">
        </div>

        <!-- Profile Image -->
        <div class="mb-3">
            <label>Profile Image:</label><br>
            @if ($doctor->profile_image)
                <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="Profile" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="profile_image" class="form-control">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Doctor</button>
    </form>
</div>
@endsection
