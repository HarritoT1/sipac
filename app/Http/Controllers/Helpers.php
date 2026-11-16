<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Helpers extends Controller
{
    public static array $status = [
        'scheduled' => 'Programada',
        'completed' => 'Completada',
        'canceled' => 'Cancelada',
        'absent' => 'Inasistencia'
    ];

    public static array $statusColors = [
        'scheduled' => 'badge-programada',
        'completed' => 'badge-completada',
        'canceled' => 'badge-cancelada',
        'absent' => 'badge-inasistencia'
    ];

    public static function emptyToNull(string | null $cadena): string | null
    {
        return trim($cadena) === '' ? null : trim($cadena);
    }

    public static function truncarDecimales(float $numero): float
    {
        return floor($numero * 100) / 100;
    }
}
