<?php

namespace App\Rules;

use App\HR\SalaryReport;
use Illuminate\Contracts\Validation\Rule;

class UniqueMonth implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //2020-10
        $monthsCreated = SalaryReport::get()->map(function ($salaryReport) {
            return $salaryReport->date->year . '-' . sprintf('%02d', $salaryReport->date->month);
        });
        return !in_array($value, $monthsCreated->toArray());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.uniqueMonth');
    }
}
