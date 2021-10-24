<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Achievement extends Model
{
    use SoftDeletes;
    use Userstamps;

    protected $table = 'achievements';

    protected $fillable = [
        'title',
        'content',
    ];
}
