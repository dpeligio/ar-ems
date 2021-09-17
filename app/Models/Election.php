<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Election extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $table = 'elections';

    protected $fillable = [
        'status',
        'title',
        'description',
        'election_date'
    ];

    public function candidates() {
        return $this->hasMany('App\Models\Candidate', 'election_id');
    }

    public function votes() {
        return $this->hasMany('App\Models\Vote', 'election_id');
    }
}
