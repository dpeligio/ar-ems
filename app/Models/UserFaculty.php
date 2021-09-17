<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class UserFaculty extends Model
{
	use SoftDeletes;
	use Userstamps;
    
    protected $table = 'user_faculties';

    protected $fillable = [
        'user_id',
        'faculty_id'
    ];
}
