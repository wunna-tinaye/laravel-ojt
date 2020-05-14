<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use SoftDeletes;
    /**
	 * Perform the actual delete query on this model instance.
	 *
	 * @return void
	 */
	protected function runSoftDelete()
	{
        $this->{$this->getDeletedAtColumn()} = $this->freshTimestamp();
		if($user = Auth::user()){
			$columns['deleted_user_id'] = $user->id;
		}

		$this->update($columns);
	}
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'title', 'description', 'status', 'create_user_id', 'updated_user_id', 'deleted_user_id'
    ];
}
