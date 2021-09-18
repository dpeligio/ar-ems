<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class VoteData extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $table = 'vote_data';

    protected $fillable = [
        'vote_id',
        'position_id',
        'candidate_id',
    ];

    public function position(){
        return $this->belongsTo('App\Models\Configuration\Position', 'position_id');
    }

    public function candidate(){
        return $this->belongsTo('App\Models\Candidate', 'candidate_id');
    }

    public function vote(){
        return $this->belongsTo('App\Models\Vote', 'vote_id');
    }
}
