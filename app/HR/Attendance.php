<?php

namespace App\HR;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];
    protected $appends = ['early_hours', 'delay_hours'];
//    protected $dates = ['time_in', 'time_out'];
    protected $casts = [
        'created_at'  => 'date:d-m-Y',
        'time_in'     => 'date:h:iA',
        'time_out'     => 'date:h:iA',
    ];
    public function employee()
    {

        return $this->belongsTo(\App\Employee::class)->withTrashed();
    }

    public function getEarlyHoursAttribute()
    {
        if ($this->employee->shift_type == 1) {
            $shiftStartTime = Carbon::createFromFormat('h:i a', setting('morning_shift_start'));
        }else{
            $shiftStartTime = Carbon::createFromFormat('h:i a', setting('evening_shift_start'));
        }

        /*** check if time in greater than shift start time then there is no early hours ***/
        if($this->time_in->gt($shiftStartTime)){
            return '00:00:00';
        }else{
            return $this->time_in->diff($shiftStartTime)->format('%H:%I:%S');
        }
    }

    public function getDelayHoursAttribute()
    {
        if ($this->employee->shift_type == 1) {
            $shiftStartTime = Carbon::createFromFormat('h:i a', setting('morning_shift_start'));
        }else{
            $shiftStartTime = Carbon::createFromFormat('h:i a', setting('evening_shift_start'));
        }

        /*** check if time in less than shift start time then there is no early hours ***/
        if($this->time_in->lt($shiftStartTime)){
            return '00:00:00';
        }else{
            return $this->time_in->diff($shiftStartTime)->format('%H:%I:%S');
        }
    }
}
