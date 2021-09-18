<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Candidate extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $table = 'candidates';

    protected $fillable = [
        'student_id',
        'election_id',
        'position_id'
    ];

    public function student(){
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function election(){
        return $this->belongsTo('App\Models\Election', 'election_id');
    }

    public function position(){
        return $this->belongsTo('App\Models\Configuration\Position', 'position_id');
    }

    public function votes()
    {
        return $this->hasMany('App\Models\VoteData', 'candidate_id');
    }
    
}
