<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Carbon\Carbon;

class Election extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $table = 'elections';

    protected $fillable = [
        'status',
        'title',
        'description',
        'start_date',
        'end_date'
    ];

    public function candidates() {
        return $this->hasMany('App\Models\Candidate', 'election_id');
    }

    public function votes() {
        return $this->hasMany('App\Models\Vote', 'election_id');
    }

    /* public function status() {
        $status = "";
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $endDate = Carbon::parse(time());
        if($this->status == '1') {
            $status = "Active";
        }
        elseif($startDate) {
            $status = "Finished";
        }
        elseif($this->start_date == ) {
            $status = "Finished";
        }
        else {
            $status = "";
        }
        return $status;
    } */
}
