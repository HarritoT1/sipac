<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Appointment
 * 
 * @property int $id
 * @property Carbon $scheduled_at
 * @property int $duration
 * @property string $modality
 * @property string $status
 * @property string $reason
 * @property int $psychologist_id
 * @property int $patient_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Patient $patient
 * @property Psychologist $psychologist
 * @property Notification|null $notification
 * @property SessionRecord|null $session_record
 *
 * @package App\Models
 */
class Appointment extends Model
{
	use HasFactory;

	protected $table = 'appointments';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'scheduled_at' => 'datetime',
		'duration' => 'int',
		'psychologist_id' => 'int',
		'patient_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'scheduled_at',
		'duration',
		'modality',
		'status',
		'reason',
		'psychologist_id',
		'patient_id'
	];

	public function patient()
	{
		return $this->belongsTo(Patient::class, 'patient_id');
	}

	public function psychologist()
	{
		return $this->belongsTo(Psychologist::class, 'psychologist_id');
	}

	public function notification()
	{
		return $this->hasOne(Notification::class);
	}

	public function session_record()
	{
		return $this->hasOne(SessionRecord::class);
	}
}
