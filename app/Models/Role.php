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
 * Class Role
 * 
 * @property int $id
 * @property string $rol_name
 * @property string $slug
 * @property string|null $description
 * @property string $privileges
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Role extends Model
{
	use HasFactory;

	protected $table = 'roles';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'rol_name',
		'slug',
		'description',
		'privileges'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'rol_id');
	}
}
