<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PUC Medic Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="dashboard">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/hospital_logo.png') }}" alt="Hospital Logo" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3063/3063823.png'">
            <h2>PUC Medic</h2>
            <small class="text-white-50">University Medical Care</small>
        </div>
        <ul class="menu p-0">
            <li><a href="{{ route('dashboard') }}" class="active">🏥 Dashboard</a></li>
            <li><a href="{{ route('doctors.index') }}">👨‍⚕️ Doctors Directory</a></li>
            <li><a href="{{ route('patients.index') }}">🧑‍🤝‍🧑 Patients Registry</a></li>
            <li><a href="{{ route('appointments.index') }}">📅 Appointments Schedule</a></li>
            <hr class="text-white-50 my-3">
            <li><a href="{{ route('patients.create') }}">➕ Register Patient</a></li>
            <li><a href="{{ route('appointments.create') }}">📅 Book Appointment</a></li>
            <li><a href="{{ route('doctors.create') }}">👨‍⚕️ Add Doctor</a></li>
            <hr class="text-white-50 my-3">
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link text-white text-decoration-none p-0 text-start">
                        🚪 Log Out
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main overflow-auto">

        <!-- Topbar -->
        <div class="topbar">
            <div>
                <h4 class="fw-bold mb-0 text-dark">Hospital Overview & Statistics</h4>
                <small class="text-muted">Welcome back to PUC Dispensary Administration</small>
            </div>
            <div class="user d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <span class="fw-bold d-block text-dark">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <small class="text-muted">{{ Auth::user()->email ?? 'admin@puc.ac.bd' }}</small>
                </div>
                <img src="{{ asset('images/my formal pic.jpg') }}" alt="User Avatar" class="rounded-circle border" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3135/3135715.png'">
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-3 border-start border-primary border-4 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-semibold text-uppercase">Total Doctors</small>
                            <h2 class="fw-bold mb-0 text-primary">{{ $doctorCount ?? 0 }}</h2>
                        </div>
                        <span class="fs-1">👨‍⚕️</span>
                    </div>
                    <a href="{{ route('doctors.index') }}" class="small text-primary text-decoration-none mt-2 d-inline-block">View Doctors →</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-3 border-start border-success border-4 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-semibold text-uppercase">Registered Patients</small>
                            <h2 class="fw-bold mb-0 text-success">{{ $patientCount ?? 0 }}</h2>
                        </div>
                        <span class="fs-1">🧑‍🤝‍🧑</span>
                    </div>
                    <a href="{{ route('patients.index') }}" class="small text-success text-decoration-none mt-2 d-inline-block">View Patients →</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-3 border-start border-info border-4 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-semibold text-uppercase">Total Appointments</small>
                            <h2 class="fw-bold mb-0 text-info">{{ $appointmentCount ?? 0 }}</h2>
                        </div>
                        <span class="fs-1">📅</span>
                    </div>
                    <a href="{{ route('appointments.index') }}" class="small text-info text-decoration-none mt-2 d-inline-block">View Schedule →</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-3 border-start border-warning border-4 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-semibold text-uppercase">Today's Visits</small>
                            <h2 class="fw-bold mb-0 text-warning">{{ $todayAppointmentsCount ?? 0 }}</h2>
                        </div>
                        <span class="fs-1">⏰</span>
                    </div>
                    <a href="{{ route('appointments.index', ['date' => date('Y-m-d')]) }}" class="small text-warning text-decoration-none mt-2 d-inline-block">Today's Queue →</a>
                </div>
            </div>
        </div>

        <!-- Quick Action Shortcuts -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('appointments.create') }}" class="btn btn-primary fw-semibold shadow-sm">
                + Book New Appointment
            </a>
            <a href="{{ route('patients.create') }}" class="btn btn-success fw-semibold shadow-sm">
                + Register New Patient
            </a>
            <a href="{{ route('doctors.create') }}" class="btn btn-outline-primary fw-semibold shadow-sm">
                + Add Doctor Profile
            </a>
        </div>

        <!-- Recent Appointments & Active Doctors Section -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">📋 Recent Appointments</h5>
                        <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date/Slot</th>
                                        <th>Patient</th>
                                        <th>Doctor</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentAppointments ?? [] as $apt)
                                        <tr>
                                            <td>
                                                <small class="fw-bold">{{ $apt->appointment_date }}</small>
                                                <br><span class="text-muted small">{{ $apt->appointment_time }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $apt->patient->name ?? 'Patient' }}</strong>
                                            </td>
                                            <td>Dr. {{ $apt->doctor->name ?? 'Doctor' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $apt->status === 'Confirmed' ? 'success' : 'warning' }}">
                                                    {{ $apt->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                No appointments booked yet. Click "+ Book New Appointment" to get started.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Doctors Card -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">👨‍⚕️ Available Doctors</h5>
                        <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-outline-primary">Directory</a>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @forelse($featuredDoctors ?? [] as $doc)
                                <li class="d-flex align-items-center gap-3 mb-3 pb-2 border-bottom">
                                    @if($doc->profile_image)
                                        <img src="{{ asset('storage/' . $doc->profile_image) }}" alt="{{ $doc->name }}" class="rounded-circle" style="width: 48px; height: 48px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary" style="width: 48px; height: 48px; font-size: 1.5rem;">👨‍⚕️</div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold"><a href="{{ route('doctors.show', $doc->id) }}" class="text-decoration-none text-dark">Dr. {{ $doc->name }}</a></h6>
                                        <small class="text-muted">{{ $doc->department }} • {{ $doc->experience }} yrs exp</small>
                                    </div>
                                    <a href="{{ route('appointments.create', ['doctor_id' => $doc->id]) }}" class="btn btn-sm btn-outline-success">Book</a>
                                </li>
                            @empty
                                <li class="text-center text-muted py-3">No doctors added yet.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission & About Section -->
        <section class="card shadow-sm border-0 p-4">
            <h5 class="fw-bold text-primary mb-3">🏥 About PUC Medic & University Healthcare</h5>
            <p class="text-secondary">
                <strong>PUC Medic</strong> is the dedicated healthcare and dispensary portal for Premier University Chittagong.
                It streamlines doctor consultations, medical profiles, student patient records, and daily appointment scheduling.
            </p>
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
