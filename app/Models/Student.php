<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Wildside\Userstamps\Userstamps;

class Student extends Model
{
	use SoftDeletes;
	use Userstamps;
    use HasRoles;
    
    protected $table = 'students';

    protected $fillable = [
        'student_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'contact_number',
        'address'
    ];
}
