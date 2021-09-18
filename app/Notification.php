<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Notification extends Model
{

    protected $table = 'notifications';

    protected static function booted()
    {
        parent::booted();

        static::saved(function ($notification){

            /** get tokens based on type **/
            if (auth()->guard('employee')->check()){

                /** push notification only to interest employees **/
                $tokensList = Employee::whereHas('roles', function (Builder $query) use ($notification) {
                    $query->where('label', $notification->type);
                })->whereNotNull('device_token')->pluck('device_token')->all();

                pushNotification($notification['title'], $notification['icon'], $notification['class'], $notification['url'], $tokensList, $notification->id);
            }
        });

    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'notifiable_id')->withTrashed();
    }


    public static function authNotifications()
    {

        if (auth()->guard('employee')->check()){
            $admin = Employee::first();
            $currentUserRoles = auth()->user()->roles()->pluck('label');
            $currentUserNotifications = collect([]);

            if (auth()->id() == $admin->id){
                return collect([]);
            }

            /** check if lab employee **/
            if ($currentUserRoles->contains('Lab')){

                $currentUserNotifications = $admin->unreadNotifications->where('type','App\Notifications\WaitingLabNotification');

            }elseif($currentUserRoles->contains('Doctor')){ /** check if doctor **/

                $currentUserNotifications = $admin->unreadNotifications->where('type','App\Notifications\ResultToDoctor');

            }elseif ($currentUserRoles->contains('Receptionist')){ /** check if doctor **/

                $currentUserNotifications = $admin->unreadNotifications->where('type','App\Notifications\HomeVisitNotification');


            }elseif ($currentUserRoles->contains('Super Admin')){
                $currentUserNotifications = $admin->unreadNotifications->where('type','App\Notifications\RequestNotification');
            }

            return $currentUserNotifications->merge(auth()->user()->unreadNotifications);
        }elseif (auth()->guard('patient')->check()){

            return auth()->user()->unreadNotifications;

        }

    }
}
