<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SessionRecord
 * 
 * @property int $id
 * @property string $diagnosis
 * @property string|null $therapy_notes
 * @property string|null $clinical_history
 * @property string|null $treatment
 * @property string|null $medications
 * @property string $psychological_evaluation
 * @property int $appointment_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Appointment $appointment
 *
 * @package App\Models
 */
class SessionRecord extends Model
{
	use HasFactory;

	protected $table = 'session_records';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'appointment_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'diagnosis',
		'therapy_notes',
		'clinical_history',
		'treatment',
		'medications',
		'psychological_evaluation',
		'appointment_id'
	];

	public function appointment()
	{
		return $this->belongsTo(Appointment::class, 'appointment_id');
	}
}
