<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // category model
	# 1. id
	# 2. name
	# 3. image

    use HasFactory;
	use SoftDeletes;

	public function store ()
	{
		return $this->hasMany('App\Models\Store');
		// "hasOne / hasMany" is used on the model that has not a foreign key
	}

}
