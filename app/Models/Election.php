<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Carbon\Carbon;
use App\Models\Candidate;
use Auth;

class Election extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $table = 'elections';

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'status',
        'title',
        'description',
        'start_date',
        'end_date'
    ];

    public function candidates() {
        /* if(Auth::user()->hasrole('System Administrator')){
            return $this->hasMany('App\Models\Candidate', 'election_id')->withTrashed();
        } */
        return $this->hasMany('App\Models\Candidate', 'election_id');
    }

    public function votes() {
        return $this->hasMany('App\Models\Vote', 'election_id');
    }

    public function findCandidate($candidateID, $positionID)
    {
        $query = Candidate::where([
            ['election_id', $this->id],
            ['student_id', $candidateID],
            ['position_id', $positionID],
        ])->exists();
        if($query){
            return True;
        }else{
            return False;
        }
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
