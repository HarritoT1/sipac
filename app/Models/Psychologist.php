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
 * Class Psychologist
 * 
 * @property int $id
 * @property string $professional_license
 * @property string $specialty
 * @property string|null $professional_bio
 * @property int $years_experience
 * @property float $consultation_fee
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property User $user
 * @property Collection|Appointment[] $appointments
 * @property Collection|PsychologistAvailability[] $psychologist_availabilities
 *
 * @package App\Models
 */
class Psychologist extends Model
{
	use HasFactory;

	protected $table = 'psychologists';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'years_experience' => 'int',
		'consultation_fee' => 'float',
		'user_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'professional_license',
		'specialty',
		'professional_bio',
		'years_experience',
		'consultation_fee',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function appointments()
	{
		return $this->hasMany(Appointment::class, 'psychologist_id');
	}

	public function psychologist_availabilities()
	{
		return $this->hasMany(PsychologistAvailability::class, 'psychologist_id');
	}
}
