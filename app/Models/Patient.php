<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Patient
 * 
 * @property int $id
 * @property Carbon $birth_date
 * @property string $gender
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property User $user
 * @property Collection|Appointment[] $appointments
 * @property Collection|EmergencyContact[] $emergency_contacts
 *
 * @package App\Models
 */
class Patient extends Model
{
	use HasFactory;

	protected $table = 'patients';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'birth_date' => 'datetime',
		'user_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'birth_date',
		'gender',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function appointments()
	{
		return $this->hasMany(Appointment::class, 'patient_id');
	}

	public function emergency_contacts()
	{
		return $this->hasMany(EmergencyContact::class, 'patient_id');
	}
}
