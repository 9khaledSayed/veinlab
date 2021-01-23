<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';

    public function employee()
    {
        return $this->belongsTo(Employee::class,'notifiable_id');
    }
}
