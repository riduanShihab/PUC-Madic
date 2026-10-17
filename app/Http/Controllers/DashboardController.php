<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $doctorCount = 0;
        $patientCount = 0;
        $appointmentCount = 0;
        $todayAppointmentsCount = 0;

        try {
            $doctorCount = Doctor::count();
            $patientCount = Patient::count();
            $appointmentCount = Appointment::count();
            $todayAppointmentsCount = Appointment::whereDate('appointment_date', today())->count();
            $recentAppointments = Appointment::with(['doctor', 'patient'])
                ->orderBy('appointment_date', 'desc')
                ->take(5)
                ->get();
            $featuredDoctors = Doctor::take(4)->get();
        } catch (\Exception $e) {
            $recentAppointments = collect();
            $featuredDoctors = collect();
        }

        return view('admin.dashboard', compact(
            'doctorCount',
            'patientCount',
            'appointmentCount',
            'todayAppointmentsCount',
            'recentAppointments',
            'featuredDoctors'
        ));
    }
}
