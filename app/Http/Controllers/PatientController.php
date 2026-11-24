<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function show(Patient $patient, Request $request)
    {
        $patient->load(['user', 'emergency_contacts']);

        abort_if(!$patient->user->is_visible, 403, 'Acceso denegado.');

        $number_appointments = $patient->appointments()->count();
        $lastAppointment = $patient->appointments()->where('status', 'completed')->latest('scheduled_at')->value('scheduled_at');
        $lastAppointmentDate = $lastAppointment ? $lastAppointment->locale('es')->isoFormat('D MMM') : 'Sin citas';

        $lastFiveAppointments = $patient->appointments()->latest()->limit(5)->get();

        $lastFiveAppointments->load(['psychologist.user']);

        $data = compact('patient', 'number_appointments', 'lastAppointmentDate', 'lastFiveAppointments');

        //dd($data);
        return view('admin.admin_detalle_usuario_paciente')->with($data)->with('status', Helpers::$status)->with('statusColors', Helpers::$statusColors);
    }

    public function store(Request $request)
    {
        dd($request->all());
        return;
    }
}
