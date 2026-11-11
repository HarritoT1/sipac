<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class User
 * 
 * @property int $id
 * @property string $full_name
 * @property string $name
 * @property string $password
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $curp
 * @property bool $is_active
 * @property bool $is_visible
 * @property string $phone_number
 * @property string $home_address
 * @property string $avatar_url
 * @property string|null $remember_token
 * @property int|null $rol_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Role|null $role
 * @property Patient|null $patient
 * @property Psychologist|null $psychologist
 * @property Collection|Session[] $sessions
 *
 * @package App\Models
 */
class User extends Model
{
	use Notifiable;

	use HasFactory;

	protected $table = 'users';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'email_verified_at' => 'datetime',
		'is_active' => 'bool',
		'is_visible' => 'bool',
		'rol_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'full_name',
		'name',
		'password',
		'email',
		'curp',
		'is_active',
		'phone_number',
		'home_address',
		'avatar_url',
		'rol_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'rol_id');
	}

	public function patient()
	{
		return $this->hasOne(Patient::class);
	}

	public function psychologist()
	{
		return $this->hasOne(Psychologist::class);
	}

	public function sessions()
	{
		return $this->hasMany(Session::class, 'user_id');
	}
}
