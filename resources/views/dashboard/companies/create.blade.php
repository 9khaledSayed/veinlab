@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Companies')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.companies.index')}}" class="btn btn-secondary">
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
                    {{__('New Company')}}
                </h3>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.companies.store')}}">
            @method('POST')
            @csrf
            <div class="kt-portlet__body">

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name') }}" id="example-text-input" name="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div id="classes_field">
                    <div class="form-group form-group-last row">
                        <label class="col-form-label col-lg-3 col-sm-12">{{__('Class Name')}}</label>
                        <div  class="col-lg-9 col-md-9 col-sm-12">
                            <div  class="form-group row align-items-center">
                                <div class="col-md-3">
                                    <div class="kt-form__group--inline">

                                        <div class="kt-form__control">
                                            <input type="text" name="class_name1"  class="form-control"  placeholder="{{__('Class Name')}} 1">
                                            @error('class_name1')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kt-form__group--inline">

                                        <div class="kt-form__control">
                                            <input type="number" name="class_offer1"  class="form-control"  placeholder="{{__('Class Offer')}} 1">
                                            @error('class_offer1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button onclick="add_class()" type="button" class="btn btn-bold btn-sm btn-label-brand">
                                        <i class="la la-plus"></i> {{__('Add')}}
                                    </button>
                                    <button   style="display:none" type="button" class="btn-sm btn btn-label-danger btn-bold">
                                        <i class="la la-trash-o"></i>
                                        Delete
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
                            <a href="{{route('dashboard.companies.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>

            <input type="number" id="number_classes" value="1" style="display:none" name="number_classes" >


        </form>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')

    <script type="text/javascript" >

        var no_classes = 1;


        function add_class()
        {

            no_classes++;

            var field = document.getElementById('classes_field');

            var container = document.createElement('DIV');
            container.className += "form-group";
            container.className += " form-group-last";
            container.className += " row";
            container.setId = no_classes;

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

            var container4_perc = document.createElement('DIV');
            container4_perc.className += "col-md-3";

            var container5_perc = document.createElement('DIV');
            container5_perc.className += "kt-form__group--inline";

            var class_counter = document.getElementById('number_classes');
            class_counter.value = no_classes;


            var div_btns = document.createElement('DIV');
            div_btns.className = "col-md-3";

            var div_class_name = document.createElement('DIV');
            div_class_name.className += "kt-form__control";

            var div_class_perc = document.createElement('DIV');
            div_class_perc.className += "kt-form__control";

            var class_name = document.createElement("INPUT");
            class_name.setAttribute("type", "text");
            class_name.setAttribute("name", "class_name" + no_classes);
            class_name.className = 'form-control';
            class_name.placeholder = "{{__('Class Name')}} " + no_classes;

            var class_perc = document.createElement("INPUT");
            class_perc.setAttribute("type", "number");
            class_perc.setAttribute("name", "class_offer" + no_classes);
            class_perc.className = 'form-control';
            class_perc.placeholder = "{{__('Class Offer')}} " + no_classes;

            var plus_btn = document.createElement("BUTTON");
            plus_btn.setAttribute("type", "button");
            plus_btn.className  = "btn";
            plus_btn.className += " btn-bold";
            plus_btn.className += " btn-sm";
            plus_btn.className += " btn-label-brand";
            plus_btn.style.marginRight = '10px'
            plus_btn.addEventListener("click", add_class);
            plus_btn.innerHTML = '<i class="la la-plus"></i> {{__("Add")}}';


            var minus_btn = document.createElement("BUTTON");
            minus_btn.setAttribute("type", "button");
            minus_btn.className  = "btn-sm";
            minus_btn.className += " btn";
            minus_btn.className += " btn-label-danger";
            minus_btn.className += " btn-bold";
            minus_btn.addEventListener("click", function(){
                remove_class( container )
            });
            minus_btn.innerHTML = '<i class="la la-trash-o"></i> {{__('Delete')}}';

            var label = document.createElement('LABEL');
            label.className += "col-form-label";
            label.className += " col-lg-3";
            label.className += " col-sm-12";

            div_btns.appendChild(plus_btn);
            div_btns.appendChild(minus_btn);

            div_class_name.appendChild(class_name);
            div_class_perc.appendChild(class_perc);

            container4.appendChild(div_class_name);
            container4_perc.appendChild(div_class_perc);
            container3.appendChild(container4);
            container3.appendChild(container4_perc);
            container2.appendChild(container3);
            container.appendChild(label);
            container.appendChild(container2);
            container3.appendChild(div_btns);

            field.appendChild(container);

        }

        function remove_class( container )
        {
            container.remove();
        }

    </script>

@endpush
