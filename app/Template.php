<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Setting;

class Template extends Model
{
    protected $guarded = [];

    public function employee_results(Employee $employee)
    {
        return [
            'fullname_arabic' => $employee->fullname_arabic(),
            'fullname_english' => $employee->fullname_english(),
            'salary' => $employee->salary() ?? 0,
            'joined_date' => $employee->joined_date->format('Y-m-d'),
            'nationality_arabic' => Nationality::find($employee->nationality_id)->nationality ?? __('سعودي'),
            'nationality_english' => Nationality::find($employee->nationality_id)->name_english ?? 'Saudi',
            'jop_title_arabic' => $employee->roles->first()->name_arabic,
            'jop_title_english' => $employee->roles->first()->name_english,
            'birthdate' => $employee->birthdate,
            'phone' => $employee->phone,
            'identity_num' => $employee->id_num,
            'identity_type_arabic' => ($employee->identity_type == 0)? __('National id'):__('Iqama'),
            'identity_type_english' => ($employee->identity_type == 0)? 'National id':'Iqama',
            'identity_issuedate' => $employee->id_issue_date ?? __('not found'),
            'identity_expiredate' => $employee->id_expire_date?? __('not found'),
        ];
    }

    public function contract_results(Employee $employee)
    {
        return [
            'period' => $employee->contract_period ?? __('not found'),
            'start_date' =>$employee->start_date->format('Y-m-d') ?? __('not found'),
            'end_date' => $employee->start_date->addMonths($employee->contract_period)->format('Y-m-d') ?? __('not found'),
        ];
    }

    public function company_results()
    {
        $setting = Setting::all();
        return [
            'arabic_name' => Setting::get('NameArabic')?? __('not found'),
            'english_name' => Setting::get('NameEnglish')?? __('not found'),
            'cr' => Setting::get('CrNumber')?? __('not found'),
            'address_arabic' => Setting::get('AddressArabic')?? __('not found'),
            'address_english' =>Setting::get('AddressEnglish')?? __('not found'),
            'ceo_name_arabic' => Employee::find(Setting::get('ChiefExecutive'))->fullname_arabic()?? __('not found'),
            'ceo_name_english' => Employee::find(Setting::get('ChiefExecutive'))->fullname_english()?? __('not found'),
            'ceo_signature' => asset($setting['ceo_signature_path'] ?? ''),
            'hr_name_arabic' => Employee::find(Setting::get('HrManager'))->fullname_english()?? __('not found'),
            'hr_name_englsh' => Employee::find(Setting::get('HrManager'))->fullname_english()?? __('not found'),
            'city_arabic' => Setting::get('CityArabic')?? __('not found'),
            'city_english' => Setting::get('CityEnglish')?? __('not found'),
            'country_arabic' => Setting::get('CountryArabic')?? __('not found'),
            'country_english' => Setting::get('CountryEnglish')?? __('not found'),
            'stamp' => asset($setting['company_stamp_path'] ?? ''),
            'email' => Setting::get('Email')?? __('not found'),
            'telephone' => Setting::get('Telephone')?? __('not found'),
            'postal_code' => Setting::get('PostalCode')?? __('not found'),
        ];
    }

    public function salary_results(Employee $employee)
    {
        return [
            'basic_salary' => $employee->basic_salary,
            'allowance' => $employee->allowance_types->where('type', 1)->pluck('value')->sum(),
            'total' => $employee->salary(),
            'table' => $this->salary_table($employee),
        ];
    }

    public function termination_results (Decision $decision)
    {
        return [
            'end_of_service' => $decision->end_of_service,
            'entitlements' => $decision->entitlements,
            'leave_balance' => $decision->employee->leave_balances->pluck('no_days_carried')->sum(),
            'date' => $decision->termination_date,
            'reason' => __($decision->termination_reason),
            'obligations' => $decision->obligations,
            'total' => $decision->end_of_service + $decision->entitlements - $decision->obligations,
        ];
    }

    public function others_results()
    {
        $setting = Setting::all();
        return [
            'logo_url' => asset(asset($setting['logo_path'] ?? ' ')),
            'header_url' => asset($setting['header_path'] ?? ' '),
            'footer_url' => asset($setting['footer_path'] ?? ' '),
            'app_url' => '????',
            'hr_name' => '??????'
        ];
    }

    public function analysis_results_tables(Invoice $invoice)
    {
        $content = '';
        $waiting_labs = $invoice->waiting_labs;
        $gender = $waiting_labs[0]->patient->gender;
        $index       = 0;
        foreach($waiting_labs as $waiting_lab){
            $notes = $waiting_lab->notes->lab_notes ?? null;
            $content .= '<table class="table table-striped- table-bordered table-hover">';
            if($waiting_lab->results->count() > 0 || isset($notes)){
                $content .= '
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label" style="margin: auto">
                            <h3 class="kt-portlet__head-title text-center" dir="rtl">'
                    . __('Analysis') .  ' : ' . $waiting_lab->main_analysis->general_name . '
                            </h3>
                        </div>
                    </div>';
            }

            if($index == 0){
                $content .= '<thead class="thead-light">
                                <tr>
                                    <td style="width: 10%">#</td>
                                    <td style="width: 22.5%">' . __('Test Name') . '</td>
                                    <td style="width: 22.5%">' . __('Result') . '</td>
                                    <td style="width: 22.5%">' . __('Unit') . '</td>
                                    <td style="width: 22.5%">' . __('Normal Range') . '</td>
                                </tr>
                            </thead>';
                $index++;
            }
            $content .= '<tbody>';
            $counter = 1;
            foreach($waiting_lab->results as $result){
                $normal_range = '';
                if(isset($result->sub_analysis->normal_ranges)){
                    $normal_range = $result->sub_analysis->normal_ranges->whereIn('gender', [$gender, 3])->first()->value ??' ';
                }
                if($result->sub_analysis){
                    $content .= '<tr>
                    <td style="width: 10%">' . $counter++ . '</td>
                    <td style="width: 22.5%">' . $result->sub_analysis->name  . '</td>
                    <td style="width: 22.5%">' . $result->result . '</td>
                    <td style="width: 22.5%">' . $result->sub_analysis->unit  . '</td>
                    <td style="width: 22.5%">' . $normal_range  . '</td>
                </tr>';
                }
            }
            $content .= '</tbody></table>';
            if(isset($notes)){
                $content .=
                    '<div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row " style="text-align: center" >
                                <div class="col-lg-12" >
                                    <h4 class="mt-3 mb-3 lab" dir="rtl">' .__('Lab Notes') . ' : ' . '</h4>
                                    <p>' . $notes . '</p>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }
        return $content;
    }
    public function purchase_table(Invoice $invoice)
    {
        $content = '<tr>
                        <td>م</td>
                        <td>الخدمة :: service</td>
                        <td>كود :: code</td>
                        <td>التحاليل :: Analysis</td>
                        <td>سعر :: Price</td>
                        <td>خصم :: Disc</td>
                        <td>الصافي :: Net</td>
                        <td>ض ق %</td>
                        <td>ض ق</td>
                        <td>اﻹجمالي</td>
                    </tr>';
        $i = 0;

        foreach(unserialize($invoice->purchases)as $key => $value){
            $content .= '<tr>
                <td>' . (++$i) . '</td>
                <td>' . $key . '</td>
                <td>' . ($value['code']) . '</td>
                <td>1</td>
                <td>' . $value['price'] . '</td>
                <td>' . $value['discount'] . '</td>
                <td>' . ($value['price'] - $value['discount']) . '</td>
                <td></td>
                <td></td>
                <td>'. ($value['price'] - $value['discount']) . '</td>
            </tr>';
        }

        return $content;

    }
    public function print_results()
    {
        return ['date' => now()->format('Y-m-d')];
    }
    public function salary_table(Employee $employee)
    {
        $table_start = '<table dir="rtl" style="border-collapse: collapse; width: 100%;" border="1">
                        <tbody>
                        <tr style="height: 21px;">
                        <td style="background-color: #d0cece; width: 25%; height: 21px; text-align: center;"><span style="text-align: center;">معلومات الموظف</span></td>
                        <td style="background-color: #d0cece; width: 25%; height: 21px;">&nbsp;</td>
                        <td style="background-color: #d0cece; width: 25%; height: 21px;">&nbsp;</td>
                        <td style="background-color: #d0cece; width: 25%; height: 21px; text-align: center;">Employee Info</td>
                        </tr>
                        ';
        $table_end = '<tr style="height: 21px;">
                        <td style="width: 25%; height: 21px; text-align: center;">اجمالي الراتب</td>
                        <td style="height: 21px; text-align: center;" colspan="2">&nbsp;<strong>'  . $employee->salary() . '</strong></td>
                        <td style="width: 25%; height: 21px; text-align: center;">Total Salary</td>
                    </tr></tbody></table>';
        $table_content = '';
        foreach ($employee->allowance_types as $allowance) {
            if($allowance->type == 1){
                if(isset($allowance->value_perc)){
                    $amount = $this->basic_salary * ($allowance->value_perc/100);
                }else{
                    $amount= $allowance->value;
                }
                $table_content .='
                    <tr style="height: 21px;">
                        <td style="width: 25%; height: 21px; text-align: center;">'  . $allowance->name . '</td>
                        <td style="height: 21px; text-align: center;" colspan="2">&nbsp;<strong>'  . $amount . '</strong></td>
                        <td style="width: 25%; height: 21px; text-align: center;">'  . $allowance->name . '</td>
                    </tr>';
            }
            if($allowance->type == 0){
                if(isset($allowance->value_perc)){
                    $amount += $this->basic_salary * ($allowance->value_perc/100);
                }else{
                    $amount += $allowance->value;
                }
                $table_content .='
                    <tr style="height: 21px;">
                        <td style="width: 25%; height: 21px; text-align: center;">'  . $allowance->name . '</td>
                        <td style="height: 21px; text-align: center;" colspan="2">&nbsp;<strong> -'  . $amount . '</strong></td>
                        <td style="width: 25%; height: 21px; text-align: center;">'  . $allowance->name . '</td>
                    </tr>';
            }
        }
        return $table_start . $table_content . $table_end;
    }
    public function collect_replace($results, $text)
    {
        $corresponding = [];
        $out = [];
        preg_match_all("/%%\w+.\w+%%/",
            $text,
            $out);
        $variables = $out[0];
//        dd($variables);
        foreach ($variables as $variable) {
            $keys = str_replace('%%', '', $variable);
            $keys = explode('.', $keys);    // keys = ['employee', 'fullname']
            if(isset($keys[1]) && isset($results[$keys[0]][$keys[1]])){
                $corresponding[$variable] = $results[$keys[0]][$keys[1]];
                $text = preg_replace('/' . $variable . '/', $corresponding[$variable], $text);
            }

        }
        return $text;
    }
    public function decision_results(Decision $decision)
    {
        $employee = $decision->employee;
        $results = [
            'employee' => $this->employee_results($employee),
            'company' => $this->company_results(),
            'salary' => $this->salary_results($employee),
            'termination' => $this->termination_results($decision),
            'others' =>$this->others_results(),
            'print' => $this->print_results()
        ];
        return $results;
    }

    public function stock_purchases($purchases)
    {
        $results = [];
        $content = '
                <table class="table" style="font-size: 1.5rem;">
                    <thead>
                        <tr>
                            <th class="border-1 text-uppercase small font-weight-bold">#</th>
                            <th class="border-1 text-uppercase small font-weight-bold">العنصر</th>
                            <th class="border-1 text-uppercase small font-weight-bold">الكميه</th>
                            <th class="border-1 text-uppercase small font-weight-bold">سعر المنتج</th>
                            <th class="border-1 text-uppercase small font-weight-bold">الأجمالي</th>
                        </tr>
                    </thead>
                <tbody>';
        $index = 0;
        $total = 0;
        foreach( $purchases as $purchase ){
            $content.='
                <tr>
                    <td>' . ++$index . '</td>
                    <td>' . $purchase['item'] . '</td>
                    <td>' . $purchase['quantity'] . '</td>
                    <td>' . $purchase['price'] . ' ' .  __('SAR') . '</td>
                    <td>' . $purchase['price'] * $purchase['quantity'] . ' ' .  __('SAR') . '</td>
                </tr>';
            $total += $purchase['price'] * $purchase['quantity'];
        }
        $content .=' </tbody></table>';
        $results['content'] = $content;
        $results['total'] = $total;
        return $results;
    }



    public function header()
    {
        if($this->header == 0){
            return ' ';
        }
        $corresponding = [];
        $results = [
            'company' => $this->company_results(),
            'others' => $this->others_results(),
            'print' => $this->print_results()
        ];
        $template = Template::where('type', 5)->first();
        return $this->collect_replace($results, $template->body);
    }

    public function footer()
    {
        if($this->footer == 0){
            return ' ';
        }
        $corresponding = [];
        $results = [
            'company' => $this->company_results(),
            'others' => $this->others_results(),
            'print' => $this->print_results()
        ];
        $template = Template::where('type', 6)->first();
        return $this->collect_replace($results, $template->body);
    }
}
