<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    // store model
	# 1. id
	# 2. name
	# 3. address
	# 4. phone number
	# 5. image
	# 6. category id
	# 7. ratings count
	# 8. ratings average
    
    use HasFactory;
	use SoftDeletes;

	public function category ()
	{
		return $this->belongsTo('App\Models\Category');
		// "belongsTo" is used on the model that has the foreign key
	}

}
