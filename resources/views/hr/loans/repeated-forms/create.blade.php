<!--begin::Modal-->
<div class="modal fade" id="kt_loans_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Add - General Additions')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body p-0 mx-0">
                <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add" data-ktwizard-state="step-first">
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                        <!--begin: Form Wizard Form-->
                        <form action="{{route('dashboard.hr.loans.store')}}" method="post" class="kt-form p-0" style="width: 80%" id="kt_loans">
                        @csrf
                        <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v1__content mb-0 p-0 border-0" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                <div class="kt-section kt-section--first m-0">
                                    <div class="kt-wizard-v1__form">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="kt-section__body">
                                                    <div class="kt-section">
                                                        <div class="kt-section__body">
                                                            <div class="form-group row">
                                                                <div class="col-lg-6">
                                                                    <label>{{__('Type')}} *</label>
                                                                    <select class="form-control kt-selectpicker" style="width: 100%"
                                                                            name="reason" title="{{__('Choose')}}">
                                                                        <option value="loan">Loan</option>
                                                                        <option value="dept">Debt</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-6">
                                                                    <label>{{__('Choose Employee Name / ID')}} *</label>
                                                                    <select class="form-control kt-select2" style="width: 100%"
                                                                            name="employee_id">
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>{{__('Start Date')}} *</label>
                                                                    <div class="input-group date">
                                                                        <input name="effective_date" type="text" class="form-control month_pic" readonly />
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <i class="la la-calendar"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <span class="alert-success" id="message1"></span>
                                                                    <span class="alert-danger" id="message2"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-6">
                                                                    <label>{{__('Amount')}} *</label>
                                                                    <div class="input-group">
                                                                        <input name="amount"
                                                                               type="text"
                                                                               class="form-control"
                                                                               aria-describedby="basic-addon1">
                                                                        <div class="input-group-prepend"><span class="input-group-text">{{__('SAR')}}</span></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>{{__('Number of months')}} *</label>
                                                                    <input name="num_of_months"
                                                                           type="text"
                                                                           class="form-control"
                                                                           aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 1-->
                            <div class="kt-form__actions m-5">
                                <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-auto" style="display: block" data-ktwizard-type="action-submit">
                                    {{__('Submit')}}
                                </div>
                                <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-auto" style="display: block" data-dismiss="modal">
                                    {{__('Close')}}
                                </div>
                            </div>
                        </form>

                        <!--end: Form Wizard Form-->
                    </div>
                </div>
            </div>=
        </div>
    </div>
</div>

<!--end::Modal-->
