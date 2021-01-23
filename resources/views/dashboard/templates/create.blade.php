@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Templates')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.templates.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('New Template')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.templates.store')}}">
                @csrf
                <div class="kt-portlet__body">
                    <div class="form-group row mt-2">
                        <div class="col-lg-6 col-md-9 col-sm-12">
                            <label>{{__('Arabic Name')}} *</label>
                            <input
                                class="form-control @error('arabic_name') is-invalid @enderror"
                                type="text"
                                name="arabic_name"
                                value="{{old('arabic_name')}}"
                                id="example-text-input">
                            @error('arabic_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-9 col-sm-12">
                            <label>{{__('English Name')}} *</label>
                            <input
                                class="form-control @error('english_name') is-invalid @enderror"
                                type="text"
                                name="english_name"
                                value="{{old('english_name')}}"
                                id="example-text-input">
                            @error('english_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-9 col-sm-12">
                            <label>{{__('Template Type')}} *</label>
                            <select class="form-control @error('type') is-invalid @enderror kt-select2"
                                    id="kt_select2_1"
                                    name="type">
                                <option value=""></option>
                                @forelse($types as $key => $value)
                                    <option
                                        value="{{$key}}"
                                    >{{$value}}</option>
                                @empty
                                    <option disabled>{{__('There is no Types')}}</option>
                                @endforelse
                            </select>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mt-5">
                        <div class="col-lg-12">
                            <textarea id="kt-tinymce-2" name="body" class="tox-target">

                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" style="text-align: center">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                                <a href="{{route('dashboard.templates.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')
    <script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/tinymce/src/plugin.js')}}" type="text/javascript"></script>
    <script>
        $(function (){
            let t1 = 'patientInfoBtn invoiceInfoBtn othersBtn'
            tinymce.init({
                selector: '#kt-tinymce-2',
                menu: {
                    custom: { title: 'Variables', items: t1 }
                },
                menubar: 'file edit insert custom',
                toolbar: ['undo redo | cut copy | bold italic | alignleft aligncenter alignright alignjustify',
                    'bullist numlist | advlist | autolink | print preview |  code '],
                plugins : 'advlist autolink link image lists charmap print preview code',

                setup: function(editor) {
                    editor.ui.registry.addNestedMenuItem('patientInfoBtn', {
                        text: 'Patient Info',
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: 'Arabic Name',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.arabic_name%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'English Name',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.english_name%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Identity no',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.id_no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'File No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.id%%</strong>');
                                }
                            },
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('invoiceInfoBtn', {
                        text: 'Invoice Info',
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: 'Invoice Date',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.date%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Invoice No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Serial No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.serial_no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Hospital',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.hospital%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Company',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.company%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Doctor',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.doctor%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Policy No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.policy_no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Amount without tax',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.without_tax%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Discount',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.discount%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Amount with tax',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.with_tax%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Amount Paid',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.amount_paid%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Due',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.due%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Payment method',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.pay_method%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Receiver',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.receiver%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Barcode',
                                onAction: function() {
                                    editor.insertContent(' <img src="%%invoice.barcode%%" alt="barcode"/>');
                                }
                            },
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('othersBtn', {
                        text: 'Others',
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: 'Tax No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%others.tax_no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Purchase Table',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%others.purchase_table%%</strong>');
                                }
                            },
                            ];
                        }
                    });
                }

            });

            $('#kt_select2_1, #kt_select2_1_validate').select2({
                placeholder: "{{__('Choose')}}",
                allowClear: true
            });
        });
    </script>
@endpush
