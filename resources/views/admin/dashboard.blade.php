<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PUC Medic Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="dashboard">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/hospital_logo.png') }}" alt="Hospital Logo">
            <h2>PUC Medic</h2>
        </div>
        <ul class="menu">
            <li><a href="#">🏥 Dashboard</a></li>
            <li><a href="{{ route('doctors.index') }}">👨‍⚕️ Doctors List</a></li>
            <li><a href="#">🧑‍🤝‍🧑 Patients List</a></li>
            <li><a href="#">📅 Appointments List</a></li>
            <li><a href="#">🧑‍🤝‍🧑 Add Patients</a></li>
            <li><a href="#">📅 Add Appointments</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main">

        <!-- Topbar -->
        <div class="topbar">
            <div class="search-box">
                <input type="text" placeholder="Search...">
            </div>
            <div class="user">
                <img src="{{ asset('images/my formal pic.jpg') }}" alt="User Avatar">
                <span>Shihab</span>
            </div>
        </div>

        <!-- Welcome Section -->
        <section class="content">
            <p>
                Welcome to <strong>PUC Medic</strong> – a modern hospital management system designed to streamline 
                patient care, appointments, and doctor information. We aim to deliver efficient and compassionate 
                healthcare service.
            </p>
            <hr class="my-4">

            <!-- Mission & Vision -->
            <div class="mission-vision">
                <h3>🏥 Our Mission</h3>
                <p>To provide high-quality healthcare services with a focus on patient satisfaction and well-being.</p>

                <h3>🌟 Our Vision</h3>
                <p>To be a leading healthcare provider, recognized for our commitment to excellence and innovation in patient care.</p>

                <img src="{{ asset('images/19.jpg') }}" alt="Hospital" 
                     style="width: 500px; height: 300px; border-radius: 10px; margin: 20px auto; display: block;">
            </div>

            <!-- Doctors Section -->
            <h3>👨‍⚕️ Our Doctors</h3>
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div style="text-align: center;">
                    <img src="{{ asset('images/doctor1.webp') }}" alt="Doctor 1" 
                         style="width: 200px; height: 150px; border-radius: 50%;">
                    <p>Dr. Rakib Hasan<br><small>Cardiologist</small></p>
                </div>
                <div style="text-align: center;">
                    <img src="{{ asset('images/doctor2.jpg') }}" alt="Doctor 2" 
                         style="width: 120px; height: 120px; border-radius: 50%;">
                    <p>Dr. Nafisa Akter<br><small>Pediatrician</small></p>
                </div>
                <div style="text-align: center;">
                    <img src="{{ asset('images/doctor3.jpg') }}" alt="Doctor 3" 
                         style="width: 120px; height: 120px; border-radius: 50%;">
                    <p>Dr. Arman Ali<br><small>Orthopedic</small></p>
                </div>
            </div>

            <!-- About Section -->
            <h2 class="mb-3">About PUC Medic</h2>
            <p>
                PUC Medic is a state-of-the-art hospital management system designed to enhance the efficiency 
                of healthcare services. Our platform provides a comprehensive solution for managing patient 
                records, appointments, and doctor information, ensuring that healthcare providers can focus 
                on delivering the best care possible.
            </p>

            <h3 class="mt-4">Key Features</h3>
            <ul>
                <li>📋 Patient Management: Easily manage patient records and history.</li>
                <li>📅 Appointment Scheduling: Streamlined appointment booking and management.</li>
                <li>👨‍⚕️ Doctor Directory: Access detailed profiles of healthcare professionals.</li>
                <li>🔍 Search Functionality: Quickly find patients, doctors, or appointments.</li>
            </ul>
        </section>
    </main>
</div>

</body>
</html>
