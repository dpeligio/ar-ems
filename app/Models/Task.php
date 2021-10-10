<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Task extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $table = 'tasks';

    protected $fillable = [
        'is_done',
        'task',
        'student_id',
        'description',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Configuration\Position', 'position_id');
    }
}
