@extends('layouts.dashboard')
@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{__('Patients')}}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <a href="#" class="">
            </a>
            <a href="{{route('dashboard.patients.index')}}" class="btn btn-secondary">
                {{__('Back')}}
            </a>
        </div>
    </div>
</div>
<!-- end:: Content Head -->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{__('Existing Account')}}
                    </h3>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger text-center" style="margin: 0 40px">
                    <div class="col-lg-4 mx-auto">
                        <h3>{{ __('Whoops! Something went wrong.') }}</h3>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <!--begin::Form-->
            <form class="kt-form kt-form--label-right" id="waiting-lab-form" action="{{route('dashboard.waiting_labs.store')}}" method="post">
                @csrf
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <div class="col-lg-4" style="text-align:center">
                            <div class="form-group">
                                <label>{{__('Promo Codes')}}</label>
                                <div class="kt-radio-inline">
                                    <label class="kt-radio">
                                        <input type="radio" name="promo_code" value="0" checked  @if(old('promo_code') == 0) checked @endif  > {{__('No Codes')}}
                                        <span></span>
                                    </label>
                                    <label class="kt-radio">
                                        <input type="radio" name="promo_code" value="1"  @if(old('promo_code') == 1) checked @endif> {{__('Have A Code')}}
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8" style="text-align:center">
                            <div class="form-group">
                                <label>{{__('Transfer Destination')}}</label>
                                <div class="kt-radio-inline">
                                    <label class="kt-radio">
                                        <input type="radio"
                                               data-action="#package"
                                               name="transfer"
                                               value="{{config('enums.transfer.individual')}}" checked @if(old('transfer')==config('enums.transfer.individual')) checked @endif
                                        > {{__('Not Found')}}
                                        <span></span>
                                    </label>
                                    <label class="kt-radio">
                                        <input type="radio"
                                               data-action="#companies"
                                               name="transfer"
                                               value="{{config('enums.transfer.contract')}}"  @if(old('transfer')==config('enums.transfer.contract')) checked @endif
                                        > {{__('Contract')}}
                                        <span></span>
                                    </label>
                                    <label class="kt-radio">
                                        <input type="radio"
                                               data-action="#hospitals"
                                               name="transfer"
                                               value="{{config('enums.transfer.hospital')}}" @if(old('transfer')==config('enums.transfer.hospital')) checked @endif
                                        > {{__('Hospital')}}
                                        <span></span>
                                    </label>
                                    <label class="kt-radio">
                                        <input type="radio"
                                               data-action="#doctors"
                                               name="transfer"
                                               value="{{config('enums.transfer.doctor')}}" @if(old('transfer')==config('enums.transfer.doctor')) checked @endif
                                        > {{__('Doctor')}}
                                        <span></span>
                                    </label>
                                    <label class="kt-radio">
                                        <input type="radio"
                                               data-action="#sectors"
                                               name="transfer"
                                               value="{{config('enums.transfer.sector')}}" @if(old('transfer')==config('enums.transfer.sector')) checked @endif
                                        > {{__('Section')}}
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="patients"><span class="required" >*</span>{{__('Patient')}}</label>
                            <select class="form-control @error('patient_id') is-invalid @enderror kt-selectpicker"
                                    id="patients"
                                    data-size="7"
                                    data-live-search="true"
                                    data-show-subtext="true" name="patient_id" title="{{__('Select')}}">
                                @forelse($patients as $patient)
                                    <option
                                        value="{{$patient->id}}"
                                        @if($patient->id == old('patient_id')) selected @endif
                                    >{{$patient->name}}</option>
                                @empty
                                    <option disabled>{{__('There is no patients')}}</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="kt_select2_3">{{__('Analysis')}}</label>
                            <select class="form-control @error('main_analysis_id')is-invalid @enderror kt-selectpicker"
                                    name="main_analysis_id[]"
                                    id="main_analysis"
                                    data-size="5"
                                    data-live-search="true"
                                    multiple="multiple"
                                    title="{{__('Select')}}">
                            </select>
                        </div>
                        <div class="col-lg-4" id="package">
                            <label for="kt_select2_5">{{__('Packages')}}</label>
                            <select class="form-control @error('package_id')is-invalid @enderror kt-selectpicker"
                                    name="package_id[]"
                                    data-size="5"
                                    data-live-search="true"
                                    multiple="multiple"
                                    title="{{__('Select')}}">
                                @forelse($packages as $package)
                                    <option
                                        value="{{$package->id}}"
                                        {{ (collect(old('package_id'))->contains($package->id)) ? 'selected':'' }}
                                    >{{$package->price . ' ' . 'SAR'}} - {{$package->name}}</option>
                                @empty
                                    <option disabled>{{__('There is no Packages')}}</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="companies" style="display: none">
                        <div class="col-lg-4">
                            <label for="insurance"><span class="required" >*</span>{{__('Insurance Companies')}}</label>
                            <select class="form-control @error('company_id')is-invalid @enderror kt-selectpicker"
                                    id="insurance"
                                    data-size="7"
                                    data-live-search="true"
                                    data-show-subtext="true"
                                    name="company_id" title="{{__('Select')}}">
                                @forelse($companies as $company)
                                    <option
                                        value="{{$company->id}}"

                                    >{{$company->name}}</option>
                                @empty
                                    <option disabled>{{__('There is no Companies')}}</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="kt_select2_7"><span class="required" >*</span>{{__('Categories')}}</label>
                            <select class="form-control @error('category_id')is-invalid @enderror kt-selectpicker"
                                    data-size="7"
                                    data-live-search="true"
                                    data-show-subtext="true"
                                    name="category_id" title="{{__('Select')}}">
                                <option disabled>{{__('There Is No Categories')}}</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="policy_no"><span class="required" >*</span>{{__('Policy Name & policy no')}}:</label>
                            <input type="text"
                                   class="form-control @error('policy_no')is-invalid @enderror"
                                   name="policy_no"
                                   id="policy_no"
                                   value="{{old('policy_no')}}"
                                   placeholder="{{__('Enter policy info')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4" id="hospitals" style="display: none">
                            <label><span class="required" >*</span>{{__('Hospitals')}}</label>
                            <select
                                class="form-control @error('hospital_id')is-invalid @enderror kt-selectpicker"
                                data-size="7"
                                data-live-search="true"
                                data-show-subtext="true"
                                name="hospital_id" title="{{__('Select')}}">
                                @forelse($hospitals as $hospital)
                                    <option
                                        value="{{$hospital->id}}"
{{--                                        @if($hospital->id == old('hospital_id')) selected @endif--}}
                                    >{{$hospital->name}}</option>
                                @empty
                                    <option disabled>{{__('There is no hospitals')}}</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-4" id="doctors" style="display:none;">
                            <label for="kt_select2_4"><span class="required" >*</span>{{__('Doctor')}}</label>
                            <select class="form-control @error('doctor_id')is-invalid @enderror kt-selectpicker"
                                    data-size="7"
                                    data-live-search="true"
                                    data-show-subtext="true"
                                    name="doctor_id" title="{{__('Select')}}">
                                @forelse($doctors as $doctor)
                                    <option
                                        value="{{$doctor->id}}"
                                        @if($doctor->id == old('doctor_id')) selected @endif
                                    >{{$doctor->name}}</option>
                                @empty
                                    <option disabled>{{__('There is no doctors')}}</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-4" id="promo_codes" style="display: none">
                            <label><span class="required" >*</span>{{__('Active Promo Codes')}}</label>
                            <select class="form-control @error('code_id') is-invalid @enderror kt-selectpicker"
                                    data-size="7"
                                    data-live-search="true"
                                    data-show-subtext="true"
                                    name="code_id" title="{{__('Select')}}">
                                @forelse($promo_codes as $code)
                                    <option
                                        value="{{$code->id}}"
                                        @if($code->id == old('code_id')) selected @endif
                                    >{{$code->code . ' - ' . $code->percentage . ' % ' .__(' off on ')}} {{($code->type == 2) ? $code->main_analysis->general_name: __('Invoice')}}</option>
                                @empty
                                    <option disabled>{{__('There is no Promo Codes')}}</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-4" id="sectors" style="display: none">
                            <label  ><span class="required" >*</span>{{__('Sectors')}}</label>
                            <select class="form-control @error('sector_id') is-invalid @enderror kt-selectpicker"
                                    data-size="7"
                                    data-live-search="true"
                                    data-show-subtext="true"
                                    name="sector_id" title="{{__('Select')}}">
                                @forelse($sectors as $sector)
                                    <option
                                        value="{{$sector->id}}"
                                        @if($sector->id == old('sector_id')) selected @endif
                                    >{{$sector->name . ' - ' . $sector->percentage . __(' % off on Invoice')}}</option>
                                @empty
                                    <option disabled>{{__('There is no Sectors')}}</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="amount_paid"><span class="required" >*</span>{{__('Amount Paid')}}:</label>
                            <input type="number"
                                   id="amount_paid"
                                   class="form-control @error('amount_paid')is-invalid @enderror"
                                   name="amount_paid"
                                   step="0.01"
                                   value="{{old('amount_paid')}}"
                                   placeholder="0.00">
                        </div>
                        <div class="col-lg-3">
                            <label for="discount"><span class="required" ></span>{{__('Discount')}}:</label>
                            <input type="number"
                                   id="discount"
                                   class="form-control @error('discount')is-invalid @enderror"
                                   name="discount"
                                   step="0.01"
                                   min="0"
                                   value="{{old('discount')}}"
                                   placeholder="0.00">
                        </div>
                        <div class="col-lg-3">
                            <label for="rest">{{__('The rest')}}:</label>
                            <input type="text"
                                   id="rest"
                                   class="form-control color-white"
                                   name="rest"
                                   readonly
                                   style="background: #aaaa; font-weight:600"
                                   placeholder="0.00">
                        </div>
                        <div class="col-lg-3">
                            <label><span class="required" >*</span>{{__('Payment Method')}}:</label>
                            <select name="pay_method"
                                    class="form-control @error('pay_method')is-invalid @enderror kt-selectpicker"
                                    title="{{__('Choose')}}">
                                <option value="{{config('enums.payMethod.cash')}}" @if(old('pay_method') == config('enums.payMethod.cash')) selected @endif>{{__('Cash')}}</option>
                                <option value="{{config('enums.payMethod.credit')}}" @if(old('pay_method') == config('enums.payMethod.credit')) selected @endif>{{__('Credit')}}</option>
                                <option value="{{config('enums.payMethod.overdue')}}" @if(old('pay_method') == config('enums.payMethod.overdue')) selected @endif>{{__('Overdue')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row align-items-end">
                        @if(setting('current_branch') == 'all')
                        <div class="col-lg-4">
                            <label ><span class="required" >*</span>{{__('Branches')}}</label>
                            <select class="form-control @error('branch_id') is-invalid @enderror kt-selectpicker"
                                    data-size="7"
                                    data-live-search="true"
                                    data-show-subtext="true"
                                    name="branch_id" title="{{__('Select')}}">
                                @forelse($branches as $branch)
                                    <option
                                        value="{{$branch->id}}"
                                        @if($branch->id == old('branch_id')) selected @endif
                                    >{{$branch->name}}</option>
                                @empty
                                    <option disabled>{{__('There is no branches')}}</option>
                                @endforelse
                            </select>
                        </div>
                        @endif
                        <label class="col-2 col-form-label">{{__('Add home visit fees')}}</label>
                        <div class="col-3">
                            <span class="kt-switch kt-switch--icon">
                                <label>
                                    <input type="checkbox" @if(old('home_visit_fees') == "2") checked @endif  name="home_visit_fees">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 mx-auto text-center">
                        <h1>{{__('Total Amount')}}</h1>
                        <div>
                            <h5 id="total_amount">0.00</h5>
                        </div>
                        <button id="calculate_price" type="button" class="btn btn-brand btn-bold">{{__('Due')}}</button>
                    </div>
                </div>
                <div class="kt-portlet__foot" style="text-align: center">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" id="submit-btn" class="btn btn-primary">{{__('confirm')}}</button>
                                <a href="{{route('dashboard.patients.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>
        <!--end::Portlet-->
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{asset('js/pages/calculate_priceV2.js')}}"></script>
    <script src="{{asset('js/pages/select_ajax_manager.js')}}"></script>
    <script src="{{asset('js/pages/input_visibility_manager.js')}}"></script>
@endpush
