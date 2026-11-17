<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psychologist;
use App\Models\SessionRecord;

class PsychologistController extends Controller
{
    public function show(Psychologist $psychologist, Request $request)
    {
        $psychologist->load('user');

        abort_if(!$psychologist->user->is_visible, 403, 'Acceso denegado.');

        $number_appointments = $psychologist->appointments()->count();
        $number_sessions = SessionRecord::whereHas('appointment', function ($query) use ($psychologist) {
            $query->where('psychologist_id', $psychologist->id);
        })->count();
        $specialities = implode(' / ', explode(',', $psychologist->specialty));

        $data = compact('psychologist', 'number_appointments', 'number_sessions', 'specialities');

        //dd($data);
        return view('admin.admin_detalle_usuario_psicologo')->with($data);
    }
}
