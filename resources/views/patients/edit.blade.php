@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-primary">✏️ Edit Patient Record</h4>
                        <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary btn-sm">← Back to Patients List</a>
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

                    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Row 1: ID, Name, Gender -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Patient ID <span class="text-danger">*</span></label>
                                <input type="text" name="patient_id" class="form-control font-monospace" value="{{ old('patient_id', $patient->patient_id) }}" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $patient->name) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select" required>
                                    <option value="Male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $patient->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 2: Age, Date of Birth, Blood Group -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Age (Years) <span class="text-danger">*</span></label>
                                <input type="number" name="age" class="form-control" min="0" max="130" value="{{ old('age', $patient->age) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $patient->date_of_birth) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Blood Group</label>
                                <select name="blood_group" class="form-select">
                                    <option value="">Unknown / Unspecified</option>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg)
                                        <option value="{{ $bg }}" {{ old('blood_group', $patient->blood_group) == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Row 3: Phone, Email, Emergency Contact -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $patient->phone) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Emergency Contact</label>
                                <input type="text" name="emergency_contact" class="form-control" value="{{ old('emergency_contact', $patient->emergency_contact) }}">
                            </div>
                        </div>

                        <!-- Row 4: Address -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Residential / Campus Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $patient->address) }}">
                        </div>

                        <!-- Row 5: Allergies & Medical History -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Allergies (if any)</label>
                                <input type="text" name="allergies" class="form-control" value="{{ old('allergies', $patient->allergies) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Known Medical History / Chronic Conditions</label>
                                <textarea name="medical_history" class="form-control" rows="2">{{ old('medical_history', $patient->medical_history) }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">Update Patient Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
