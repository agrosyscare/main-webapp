<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class WorkDay extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'day',
        'active',
        'morning_start',
        'morning_finish',
        'afternoon_start',
        'afternoon_finish',
        'user_id'
    ];

    public function users() {
        $this->belongsTo('App\Users');
    }
}
