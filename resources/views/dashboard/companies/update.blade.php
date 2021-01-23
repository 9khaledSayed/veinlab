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
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.companies.update',$company)}}">
            @method('PUT')
            @csrf
            <div class="kt-portlet__body" id="form">

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Company Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('name') is-invalid @enderror"
                               type="text"
                               style="text-align:center;font-weight:bold"
                               value="{{ old('name') ??  $company->name }}"
                               id="example-text-input"
                               name="name">
                        @error('name')
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @enderror
                    </div>
                </div>


                @foreach( $company->categories as $category )

                    <div id="classes_field{{++$count}}">
                        <div class="form-group form-group-last row">
                            <label class="col-form-label col-lg-3 col-sm-12">{{__('Class Name')}}</label>
                            <div  class="col-lg-9 col-md-9 col-sm-12">
                                <div  class="form-group row align-items-center">
                                    <div class="col-md-3">
                                        <div class="kt-form__group--inline">

                                            <div class="kt-form__control">
                                                <input
                                                    type="text"
                                                    name="class_name{{$count}}"
                                                    class="form-control"
                                                    value="{{old('class_name' .$count) ?? $category->name}}"
                                                    placeholder="{{__('Class Name')}} 1">
                                                @error('class_name'.$count)
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
                                                <input
                                                    type="text"
                                                    name="class_offer{{$count}}"
                                                    class="form-control"
                                                    value="{{old('class_offer' . $count) ?? $category->percentage}}"
                                                    placeholder="{{__('Class Offer')}} 1">
                                                @error('class_offer'.$count)
                                                <span style="color:red" role="alert">
                                            <small>{{ $message }}</small>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <button  onclick="remove_old_class({{$count}})"  type="button" class="btn-sm btn btn-label-danger btn-bold">
                                            <i class="la la-trash-o"></i>
                                            {{__('Delete')}}
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

                <input
                    type="number"
                    id="number_classes"
                    value="{{old('number_classes') ?? $count}}"
                    style="display:none"
                    name="number_classes" >
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-12" style="text-align:center">
                            <button onclick="add_class()" type="button"  class="btn btn-secondary"><i class="la la-plus"></i> {{__('Add New Class')}}</button>
                            <br><br>
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{ route('dashboard.companies.index') }}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')


    <script type="text/javascript" >

        var no_classes = document.getElementById('number_classes').value;
        var form = document.getElementById('form');



        function add_class()
        {

            no_classes++;

            var field = document.createElement('DIV');
            field.setAttribute("id", "classes_field" + no_classes);

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

            var container4_offer = document.createElement('DIV');
            container4_offer.className += "col-md-3";

            var container5 = document.createElement('DIV');
            container5.className += "kt-form__group--inline";

            var container5_offer = document.createElement('DIV');
            container5_offer.className += "kt-form__group--inline";

            class_counter = document.getElementById('number_classes');
            class_counter.value = no_classes;


            var div_btns = document.createElement('DIV');
            div_btns.className = "col-md-3";

            var div_class_name = document.createElement('DIV');
            div_class_name.className += "kt-form__control";

            var div_class_offer = document.createElement('DIV');
            div_class_offer.className += "kt-form__control";

            var class_name = document.createElement("INPUT");
            class_name.setAttribute("type", "text");
            class_name.setAttribute("name", "class_name" + no_classes);
            class_name.className = 'form-control';
            class_name.placeholder = "{{__('Class Name')}} " + no_classes;

            var class_offer = document.createElement("INPUT");
            class_offer.setAttribute("type", "text");
            class_offer.setAttribute("name", "class_offer" + no_classes);
            class_offer.className = 'form-control';
            class_offer.placeholder = "{{__('Class Offer')}} " + no_classes;

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
            label.innerHTML = '{{__("Class Name")}}';
            label.className += "col-form-label";
            label.className += " col-lg-3";
            label.className += " col-sm-12";

            div_btns.appendChild(minus_btn);

            div_class_name.appendChild(class_name);
            div_class_offer.appendChild(class_offer);

            container4.appendChild(div_class_name);
            container4_offer.appendChild(div_class_offer);

            container3.appendChild(container4);
            container3.appendChild(container4_offer);
            container2.appendChild(container3);
            container.appendChild(label);
            container.appendChild(container2);
            container3.appendChild(div_btns);

            field.appendChild(container);
            form.appendChild(field);

        }

        function remove_class( container )
        {
           // no_classes--;
            container.remove();
            // var class_counter = document.getElementById('number_classes');
            // class_counter.value = no_classes;
        }


        function remove_old_class(id) {

         document.getElementById('classes_field' + id).remove();

        }
    </script>


@endpush
