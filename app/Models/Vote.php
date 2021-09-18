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
        'vote_number',
        'election_id',
        'voter_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'voter_id');
    }

    public function election(){
        return $this->belongsTo('App\Models\Election', 'election_id');
    }

    public function vote_data()
    {
        return $this->hasMany('App\Models\VoteData', 'vote_id');
    }
}
