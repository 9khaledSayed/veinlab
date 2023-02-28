<?php

namespace App;
use App\HR\Addition;
use App\HR\Attendance;
use App\HR\Branch;
use App\HR\Decision;
use App\HR\Deduction;
use App\HR\LeaveBalance;
use App\HR\Loan;
use App\HR\EmployeeRequest;
use App\HR\Salary;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Support\Facades\Hash;

class Employee extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;


    protected $dates = ['deleted_at', 'joined_date', 'start_date'];

    protected $guard = 'employee';

    protected $guarded = [];

    protected $casts = [
        'created_at'  => 'date:D M d Y',
        'updated_at'  => 'date:D M d Y',
        'joined_date'   =>'date:D M d Y'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [
        'email' => 'sometimes|required|email|unique:employees',
        'branch_id' => 'required',
        'fname_arabic' => ['required', 'string'],
        'mname_arabic' => ['nullable', 'string'],
        'lname_arabic' => ['required', 'string'],
        'fname_english' => ['required', 'string'],
        'mname_english' => ['nullable', 'string'],
        'lname_english' => ['required', 'string'],
        'birthdate' => ['required'],
        'nationality_id' => ['required'],
        'marital_status' => ['nullable'],
        'gender' => ['nullable'],
        'identity_type' => ['nullable'],
        'id_num' => ['required', 'numeric'],
        'id_issue_date' => ['nullable'],
        'id_expire_date' => ['nullable'],
        'passport_num' => ['nullable'],
        'passport_issue_date' => ['nullable'],
        'passport_expire_date' => ['nullable'],
        'issue_place' => ['nullable'],
        'emp_num' => 'required|sometimes|unique:employees',
        'joined_date' => ['required'],
        'shift_type' => ['required'],
        'contract_type' => ['required'],
        'start_date' => ['required'],
        'contract_period' => 'nullable|exclude_if:contract_type,1|numeric',
        'basic_salary' => ['required'],
        'phone' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],

    ];
    
   public function setPasswordAttribute($password)
   {
       $this->attributes['password'] = Hash::make($password);
   }


    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        if(is_string($role)){
            $role = Role::where('name_english', $role)->firstOrFail();
        }
        return $this->roles()->sync($role, false);
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function deductions()
    {
        return $this->hasMany(Deduction::class)->where('type', 1);
    }

    public function Additions()
    {
        return $this->hasMany(Addition::class)->where('type', 2);
    }

    public function Loans()
    {
        return $this->hasMany(Loan::class)->where('type', 3);
    }

    public function decisions()
    {
        return $this->hasMany(Decision::class);
    }

    public function workDays($month)
    {
        $work_days = Attendance::where('employee_id', $this->id)->whereNotNull(['time_in', 'time_out'])->whereMonth('created_at', $month)->count();
        return $work_days;
    }

    public function fullname()
    {
        $mname_arabic = $this->mname_arabic ?? '';
        $mname_english = $this->mname_english ?? '';
        if(\Illuminate\Support\Facades\App::isLocale('ar')){
            return $this->fname_arabic . ' ' . $mname_arabic . ' ' . $this->lname_arabic;
        }else{
            return $this->fname_english . ' ' . $mname_english . ' ' . $this->lname_english;
        }
    }
    public function fullname_arabic()
    {
        $mname = $this->mname_arabic ?? '';
        return $this->fname_arabic . ' ' . $mname . ' ' . $this->lname_arabic;

    }
    public function fullname_english()
    {
        $mname = $this->mname_english ?? '';
        return $this->fname_english . ' ' . $mname   . ' ' . $this->lname_english;
    }
    public function salary()
    {
        $add = 0;
        $deduc = 0;
        foreach ($this->allowance_types as $allowance) {
            if($allowance->type == 1){
                if(isset($allowance->value_perc)){
                    $add += $this->basic_salary * ($allowance->value_perc/100);
                }else{
                    $add += $allowance->value;
                }
            }
            if($allowance->type == 0){
                if(isset($allowance->value_perc)){
                    $deduc += $this->basic_salary * ($allowance->value_perc/100);
                }else{
                    $deduc += $allowance->value;
                }
            }
        }
        return $this->basic_salary + $add + $deduc;
    }
    public function allowance_types()
    {
        return $this->belongsToMany(AllowanceType::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function employee_requests()
    {
        return $this->hasMany(EmployeeRequest::class);
    }

    public function leave_balances()
    {
        return $this->hasMany(LeaveBalance::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function duration($termination_date)
    {
        $termination_date = Carbon::parse($termination_date);
        $total_days = $termination_date->diffInDays($this->start_date);
        $years = floor($total_days / 365);
        $x = ($total_days / 365) - $years;
        $months = floor($x * 12);
        $x = ($x * 12) - $months;
        $days = floor($x * 30);
        return [
            'months' => $months,
            'days'   => $days,
            'years'  => $years
        ];
    }

    protected static function boot() {
        parent::boot();
        static::deleting(function($employee) {
//            $employee->decisions()->delete();
            $employee->attendance()->delete();
            $employee->deductions()->delete();
            $employee->Additions()->delete();
            $employee->salaries()->delete();
            $employee->employee_requests()->delete();
        });
    }

    public function salaryIsSuspended($month)
    {
        $suspend_decisions = $this->decisions->where('type', '2')->where('status', '1');
        foreach ($suspend_decisions as $decision) {

            if(isset($decision->to_date)){
                if($decision->from_date->month <= $month && $decision->to_date->month >= $month){

                    return true;
                }
            }else{
                if($decision->from_date->month == $month){

                    return true;
                }
            }
        }
        return false;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }


    public function setMobileOwner()
    {
        auth()->user()->mobile_owner = true;
        auth()->user()->save();
    }

    public function unsetMobileOwner()
    {
        auth()->user()->mobile_owner = false;
        auth()->user()->save();
    }

    public function setInLab()
    {
        auth()->user()->in_lab = true;
        auth()->user()->save();
    }

    public function unsetInLab()
    {
        auth()->user()->in_lab = false;
        auth()->user()->save();
    }

}
