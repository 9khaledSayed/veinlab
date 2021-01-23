@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Main Analysis')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.main_analysis.index')}}" class="btn btn-secondary">
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
                    {{__('New Analysis')}}
                </h3>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.main_analysis.store')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('General Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('general_name') form-control is-invalid @enderror"
                            type="text"
                            name="general_name"
                            value="{{old('general_name')}}"
                            id="example-text-input">
                        @error('general_name')
                            <div class="invalid-feedback">{{$errors->first('general_name')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Abbreviated Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('abbreviated_name') form-control is-invalid @enderror"
                            type="text"
                            name="abbreviated_name"
                            value="{{old('abbreviated_name')}}"
                            id="example-text-input">
                        @error('abbreviated_name')
                            <div class="invalid-feedback">{{$errors->first('abbreviated_name')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Code')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('code') form-control is-invalid @enderror"
                            type="text"
                            name="code"
                            value="{{old('code')}}"
                            id="example-text-input">
                        @error('code')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Discount')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('discount') form-control is-invalid @enderror"
                            type="number"
                            name="discount"
                            placeholder="0.00"
                            value="{{old('discount')}}"
                            id="example-text-input">
                        @error('discount')
                        <div class="invalid-feedback">{{$errors->first('discount')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Cost')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('cost') form-control is-invalid @enderror"
                            type="number"
                            name="cost"
                            placeholder="0.00"
                            value="{{old('cost')}}"
                            id="example-text-input">
                            @error('cost')
                                <div class="invalid-feedback">{{$errors->first('cost')}}</div>
                            @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Price')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('price') form-control is-invalid @enderror"
                            type="number"
                            name="price"
                            placeholder="0.00"
                            value="{{old('price')}}"
                            id="example-text-input">
                            @error('price')
                                <div class="invalid-feedback">{{$errors->first('price')}}</div>
                            @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Insurance Price')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('price_insurance') form-control is-invalid @enderror"
                            type="text"
                            name="price_insurance"
                            placeholder="0.00"
                            value="{{old('price_insurance')}}"
                            id="example-text-input">
                        @error('price_insurance')
                        <div class="invalid-feedback">{{$errors->first('price_insurance')}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Hospitals Price')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('price_hospital') form-control is-invalid @enderror"
                            type="text"
                            name="price_hospital"
                            placeholder="0.00"
                            value="{{old('price_hospital')}}"
                            id="example-text-input">
                        @error('price_hospital')
                        <div class="invalid-feedback">{{$errors->first('price_hospital')}}</div>
                        @enderror
                    </div>
                </div>

                <div id="sub_analysis_field">
                    <div class="form-group form-group-last row">
                        <label class="col-form-label col-lg-3 col-sm-12">{{__('Sub Analysis')}}</label>
                        <div  class="col-lg-9 col-md-9 col-sm-12">
                            <div  class="form-group row align-items-center">
                                <div class="col-md-3">
                                    <div class="kt-form__group--inline">

                                        <div class="kt-form__control">
                                            <input type="text" name="sub_analysis1"  class="form-control" required placeholder="{{__('Sub Analysis')}} 1">
                                            @error('sub_analysis1')
                                            <span style="color:red" role="alert">
                                            <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kt-form__group--inline">

                                        <div class="kt-form__control">
                                            <input type="text" name="unit1"  class="form-control"  placeholder="{{__('Unit')}}">
                                            @error('sub_analysis1')
                                            <span style="color:red" role="alert">
                                            <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <button onclick="add_sub_analysis()" type="button" class="btn btn-bold btn-sm btn-label-brand">
                                        <i class="la la-plus"></i> {{__('Add')}}
                                    </button>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.main_analysis.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>

            <input type="number" id="number_sub_analysis" value="1" style="display:none" name="number_sub_analysis" >


        </form>

        <!--end::Form-->
    </div>

    <!--end::Portlet-->
@endsection

@push('scripts')

<script type="text/javascript" >

        var no_sub_analysis = 1;


        function add_sub_analysis()
        {

            no_sub_analysis++;

            var field = document.getElementById('sub_analysis_field');

            var container = document.createElement('DIV');
            container.className += "form-group";
            container.className += " form-group-last";
            container.className += " row";
            container.setId = no_sub_analysis;

            var container2 = document.createElement('DIV');
            container2.className += "col-lg-9";
            container2.className += " col-md-9";
            container2.className += " col-sm-12";

            var container3 = document.createElement('DIV');
            container3.className += "form-group";
            container3.className += " align-items-center";
            container3.className += " row";

            var container4 = document.createElement('DIV');
            container4.className += "col-md-3";

            var container5 = document.createElement('DIV');
            container5.className += "kt-form__group--inline";

            var container6 = document.createElement('DIV');
            container6.className += "kt-form__group--inline";

            var container7 = document.createElement('DIV');
            container7.className += "col-md-3";

            var class_counter = document.getElementById('number_sub_analysis');
            class_counter.value = no_sub_analysis;


            var div_btns = document.createElement('DIV');
            div_btns.className = "col-md-3";

            var div_sub_analysis = document.createElement('DIV');
            div_sub_analysis.className += "kt-form__control";

            var div_unit = document.createElement('DIV');
            div_unit.className += "kt-form__control";

            var sub_analysis_name = document.createElement("INPUT");
            sub_analysis_name.setAttribute("type", "text");
            sub_analysis_name.setAttribute("name", "sub_analysis" + no_sub_analysis);
            sub_analysis_name.className = 'form-control';
            sub_analysis_name.placeholder = "{{__('Sub Analysis')}} " + no_sub_analysis;

            var unit = document.createElement("INPUT");
            unit.setAttribute("type", "text");
            unit.setAttribute("name", "unit" + no_sub_analysis);
            unit.className = 'form-control';
            unit.placeholder = "{{__('Unit')}}" ;

            var plus_btn = document.createElement("BUTTON");
            plus_btn.setAttribute("type", "button");
            plus_btn.className  = "btn";
            plus_btn.className += " btn-bold";
            plus_btn.className += " btn-sm";
            plus_btn.className += " btn-label-brand";
            plus_btn.style.marginRight = '10px'
            plus_btn.addEventListener("click", add_sub_analysis);
            plus_btn.innerHTML = '<i class="la la-plus"></i> {{__('Add')}}';


            var minus_btn = document.createElement("BUTTON");
            minus_btn.setAttribute("type", "button");
            minus_btn.className  = "btn-sm";
            minus_btn.className += " btn";
            minus_btn.className += " btn-label-danger";
            minus_btn.className += " btn-bold";
            minus_btn.addEventListener("click", function(){
                remove_sub_analysis( container )
            });
            minus_btn.innerHTML = '<i class="la la-trash-o"></i> {{__('Delete')}}';

            var label = document.createElement('LABEL');
            label.className += "col-form-label";
            label.className += " col-lg-3";
            label.className += " col-sm-12";

            div_btns.appendChild(plus_btn);
            div_btns.appendChild(minus_btn);


            div_sub_analysis.appendChild(sub_analysis_name);
            container5.appendChild(div_sub_analysis);
            container4.appendChild(container5);

            div_unit.appendChild(unit);
            container6.appendChild(div_unit);
            container7.appendChild(container6);

            container3.appendChild(container4);
            container3.appendChild(container7);
            container2.appendChild(container3);
            container.appendChild(label);
            container.appendChild(container2);
            container3.appendChild(div_btns);

            field.appendChild(container);

        }

        function remove_sub_analysis( container )
        {
            container.remove();
        }

</script>

@endpush
