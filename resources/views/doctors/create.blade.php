@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">Add New Doctor</h2>
  <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
      <div class="col-md-6"><input type="text" name="name" class="form-control" placeholder="Full Name" required></div>
      <div class="col-md-6"><input type="number" name="age" class="form-control" placeholder="Age" required></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6"><input type="text" name="phone" class="form-control" placeholder="Phone Number" required></div>
      <div class="col-md-6"><input type="text" name="address" class="form-control" placeholder="Address" required></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
      <div class="col-md-6"><input type="date" name="date_of_birth" class="form-control" required></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6"><input type="date" name="date_of_joining" class="form-control" required></div>
      <div class="col-md-6"><input type="text" name="blood_group" class="form-control" placeholder="Blood Group" required></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6"><input type="text" name="department" class="form-control" placeholder="Department" required></div>
      <div class="col-md-6"><input type="number" name="experience" class="form-control" placeholder="Experience (Years)" required></div>
    </div>
    <div class="mb-3">
      <label>Specialists</label>
      <select name="specialists[]" multiple class="form-control">
        <option value="Cardiomyopathy">Cardiomyopathy</option>
        <option value="Arrhythmia">Arrhythmia</option>
        <option value="Hypertension">Hypertension</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Designations</label>
      <select name="designations[]" multiple class="form-control">
        <option value="MD - Medicine">MD - Medicine</option>
        <option value="DM - Cardiology">DM - Cardiology</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Profile Image</label>
      <input type="file" name="profile_image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save Doctor</button>
  </form>
</div>
@endsection
