<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Faculty extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $fillable = [
        'faculty_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'contact_number',
        'address'
    ];
}
