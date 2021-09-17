<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Vote extends Model
{
	use SoftDeletes;
    use Userstamps;
    
    protected $table = 'votes';

    protected $fillable = [
        'election_id',
        'candidate_id',
        'student_id',
    ];

    public function student(){
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function candidate(){
        return $this->belongsTo('App\Models\Candidate', 'cadidate_id');
    }

    public function election(){
        return $this->belongsTo('App\Models\Election', 'election_id');
    }
}
