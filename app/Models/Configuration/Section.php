<?php

namespace App\Models\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Section extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $table = 'sections';

    protected $fillable = [
        'year_level',
        'name'
    ];

    public function students()
    {
        return $this->hasMany('App\Models\StudentSection', 'section_id');
    }
}
