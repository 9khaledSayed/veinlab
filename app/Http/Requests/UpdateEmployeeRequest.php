<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('Update_employees');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $employee = request()->route('employee');

        return [
        'fname_arabic' => ['required', 'string'],
        'mname_arabic' => ['nullable', 'string'],
        'lname_arabic' => ['required', 'string'],
        'fname_english' => ['required', 'string'],
        'mname_english' => ['nullable', 'string'],
        'lname_english' => ['required', 'string'],
        'branch_id' => 'required',
        'birthdate' => ['required'],
        'email' => "required|email|unique:employees,email,$employee->id",
        'phone' => "required|numeric|unique:employees,phone,$employee->id",
        'emp_num' => "required|numeric|unique:employees,emp_num,$employee->id",
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
        'emp_num' => "required|unique:employees,emp_num,$employee->id",
        'joined_date' => ['required'],
        'shift_type' => ['required'],
        'contract_type' => ['required'],
        'start_date' => ['required'],
        'contract_period' => 'nullable|exclude_if:contract_type,1|numeric',
        'basic_salary' => ['required'],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
