@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-primary">➕ Register New Patient</h4>
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

                    <form action="{{ route('patients.store') }}" method="POST">
                        @csrf

                        <!-- Row 1: ID, Name, Gender -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Patient ID <span class="text-danger">*</span></label>
                                <input type="text" name="patient_id" class="form-control font-monospace" value="{{ old('patient_id', $suggestedId) }}" required>
                                <small class="text-muted">Auto-suggested unique identifier</small>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Tanvir Ahmed" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 2: Age, Date of Birth, Blood Group -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Age (Years) <span class="text-danger">*</span></label>
                                <input type="number" name="age" class="form-control" placeholder="e.g. 21" min="0" max="130" value="{{ old('age') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Blood Group</label>
                                <select name="blood_group" class="form-select">
                                    <option value="" selected>Unknown / Unspecified</option>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg)
                                        <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Row 3: Phone, Email, Emergency Contact -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="e.g. 018XXXXXXXX" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="patient@example.com" value="{{ old('email') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Emergency Contact</label>
                                <input type="text" name="emergency_contact" class="form-control" placeholder="Contact number" value="{{ old('emergency_contact') }}">
                            </div>
                        </div>

                        <!-- Row 4: Address -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Residential / Campus Address</label>
                            <input type="text" name="address" class="form-control" placeholder="e.g. PUC Campus Hall / Chittagong" value="{{ old('address') }}">
                        </div>

                        <!-- Row 5: Allergies & Medical History -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Allergies (if any)</label>
                                <input type="text" name="allergies" class="form-control" placeholder="e.g. Penicillin, Dust, Peanuts" value="{{ old('allergies') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Known Medical History / Chronic Conditions</label>
                                <textarea name="medical_history" class="form-control" rows="2" placeholder="e.g. Asthma, Diabetes, Hypertension...">{{ old('medical_history') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">Save Patient Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
