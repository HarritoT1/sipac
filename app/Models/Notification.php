<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Notification
 * 
 * @property int $id
 * @property Carbon $day_of_notification
 * @property string $status
 * @property int $appointment_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Appointment $appointment
 *
 * @package App\Models
 */
class Notification extends Model
{
	use HasFactory;

	protected $table = 'notifications';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'day_of_notification' => 'datetime',
		'appointment_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'day_of_notification',
		'status',
		'appointment_id'
	];

	public function appointment()
	{
		return $this->belongsTo(Appointment::class, 'appointment_id');
	}
}
