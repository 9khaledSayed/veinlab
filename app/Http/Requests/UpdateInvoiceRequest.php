<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $validationStatus = request()->ajax() ? 'nullable' : 'required';
        return [
            "patient_id" => 'required',
            "amount_paid" => "$validationStatus|required_unless:pay_method," . config('enums.payMethod.overdue'),
            "transfer" => 'required',
            "pay_method" => $validationStatus,
            "discount" => 'nullable|numeric|min:0',
            "code_id" => 'required_if:promo_code,1',
            "hospital_id" => 'required_if:transfer,' . config('enums.transfer.hospital'),
            "sector_id" => 'required_if:transfer,' . config('enums.transfer.sector'),
            "doctor_id" => 'required_if:transfer,' . config('enums.transfer.doctor'),
            'company_id' => 'required_if:transfer,' . config('enums.transfer.contract'),
            'category_id' => 'required_if:transfer,' . config('enums.transfer.contract'),
            'policy_no' => 'required_if:transfer,' . config('enums.transfer.contract'),
            "main_analysis_id" => 'required_without:package_id', 'string', 'max:255',
        ];
    }
}
