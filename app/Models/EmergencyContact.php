<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EmergencyContact
 * 
 * @property int $id
 * @property string $name
 * @property string $relationship
 * @property string $phone_number
 * @property string|null $email
 * @property bool $is_primary
 * @property int $patient_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Patient $patient
 *
 * @package App\Models
 */
class EmergencyContact extends Model
{
	use HasFactory;

	protected $table = 'emergency_contacts';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'is_primary' => 'bool',
		'patient_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'name',
		'relationship',
		'phone_number',
		'email',
		'is_primary',
		'patient_id'
	];

	public function patient()
	{
		return $this->belongsTo(Patient::class, 'patient_id');
	}
}
