<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('is_visible', true)->whereNot('rol_id', 1)->count();
        $totalActiveUsers = User::where('is_visible', true)->whereNot('rol_id', 1)->where('is_active', true)->count();
        $totalInactiveUsers = $totalUsers - $totalActiveUsers;

        $newMonthUsers = User::where('is_visible', true)->whereNot('rol_id', 1)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $percentageActiveUsers = Helpers::truncarDecimales(($totalActiveUsers / $totalUsers) * 100);
        $percentageInactiveUsers = Helpers::truncarDecimales(($totalInactiveUsers / $totalUsers) * 100);

        $lastFiveUsersCreated = User::with('role')->where('is_visible', true)->whereNot('rol_id', 1)->latest()->limit(5)->get();
        $lastFiveAppointmentsRegistered = Appointment::with(['patient.user', 'psychologist.user'])->latest()->limit(5)->get();

        //dd($lastFiveAppointmentsRegistered);

        $data = [
            'totalUsers' => $totalUsers,
            'totalActiveUsers' => $totalActiveUsers,
            'totalInactiveUsers' => $totalInactiveUsers,
            'newMonthUsers' => $newMonthUsers,
            'percentageActiveUsers' => $percentageActiveUsers,
            'percentageInactiveUsers' => $percentageInactiveUsers,
            'lastFiveUsersCreated' => $lastFiveUsersCreated,
            'lastFiveAppointmentsRegistered' => $lastFiveAppointmentsRegistered,
            'status' => Helpers::$status,
            'statusColors' => Helpers::$statusColors
        ];

        return view('admin.admin_dashboard', $data);
    }
}
