<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PsychologistAvailability
 * 
 * @property int $id
 * @property Carbon $day
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property bool $is_available
 * @property int $psychologist_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Psychologist $psychologist
 *
 * @package App\Models
 */
class PsychologistAvailability extends Model
{
	use HasFactory;

	protected $table = 'psychologist_availabilities';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'day' => 'datetime',
		'start_time' => 'datetime',
		'end_time' => 'datetime',
		'is_available' => 'bool',
		'psychologist_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'day',
		'start_time',
		'end_time',
		'is_available',
		'psychologist_id'
	];

	public function psychologist()
	{
		return $this->belongsTo(Psychologist::class, 'psychologist_id');
	}
}
