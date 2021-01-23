@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Stock')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.stock.index')}}" class="btn btn-secondary">
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
                    {{__('New Item')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.stock.store')}}">
            @method('POST')
            @csrf
            <div class="kt-portlet__body">

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('New Company')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('company_name') is-invalid @enderror" type="text" value="{{ old('company_name') }}" id="example-text-input" name="company_name">
                        @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Or Existing Company')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control @error('company_name_exist')is-invalid @enderror kt-selectpicker"
                                name="company_name_exist">
                            <option  value="0" selected>{{__('Choose')}}</option>
                            @foreach( $companies as $company)
                                <option value="{{$company}}" >{{ $company }}</option>
                            @endforeach
                        </select>
                        @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div id="sales_field">

                    <div class="form-group row">
                        <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Item Name')}}</label>
                        <div class="col-lg-6 col-md-9 col-sm-12">
                            <input class="form-control @error('item_name1') is-invalid @enderror" type="text" value="{{ old('item_name1') }}"
                                   id="example-text-input" name="item1" required
                                   placeholder="{{__('Item Name')}}">
                            @error('item_name1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-group-last row">
                        <label class="col-form-label col-lg-3 col-sm-12">{{__('')}}</label>
                        <div  class="col-lg-9 col-md-9 col-sm-12">
                            <div  class="form-group row align-items-center">
                                <div class="col-md-4">
                                    <div class="kt-form__group--inline">

                                        <div class="kt-form__control">
                                            <input type="number" name="quantity1"  class="form-control" required placeholder="{{__('Quantity')}}">
                                            @error('quantity1')
                                            <span style="color:red" role="alert">
                                            <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="kt-form__group--inline">

                                        <div class="kt-form__control">
                                            <input type="number" name="price1"  class="form-control" required placeholder="{{__('Price')}}">
                                            @error('price1')
                                            <span style="color:red" role="alert">
                                            <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <button onclick="add_sale()" type="button" class="btn btn-bold btn-sm btn-label-brand">
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
                            <a href="{{route('dashboard.stock.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>

            <input type="number" id="number_sales" value="1" style="display:none" name="number_sales" >

        </form>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')
    <script>
        $('.kt-selectpicker').selectpicker();
    </script>



    <script type="text/javascript" >

        var no_sales = 1;


        function add_sale()
        {

            no_sales++;

            var field = document.getElementById('sales_field');

            var parent_container  = document.createElement('DIV');

            var container_item_name  = document.createElement('DIV');
            container_item_name.className += "form-group";
            container_item_name.className += " row";
            container_item_name.className += " mt-3";

            var label_item_name = document.createElement('LABEL');
            label_item_name.className += "col-form-label";
            label_item_name.className += " col-lg-3";
            label_item_name.className += " col-sm-12";

            var container_2_item_name        = document.createElement('DIV');
            container_2_item_name.className += "col-lg-6";
            container_2_item_name.className += " col-md-9";
            container_2_item_name.className += " col-sm-12";

            var item_name = document.createElement("INPUT");
            item_name.setAttribute("type", "text");
            item_name.setAttribute("name", "item" + no_sales);
            item_name.className = 'form-control';
            item_name.placeholder = "{{__('Item Name')}} " + no_sales;
            item_name.required = true;

            ///////////////////////////////////////////////////////////////////////////////

            var container = document.createElement('DIV');
            container.className += "form-group";
            container.className += " form-group-last";
            container.className += " row";
            container.setId = no_sales;

            var container2 = document.createElement('DIV');
            container2.className += "col-lg-9";
            container2.className += " col-md-9";
            container2.className += " col-sm-12";

            var container3 = document.createElement('DIV');
            container3.className += "form-group";
            container3.className += " align-items-center";
            container3.className += " row";

            var container4 = document.createElement('DIV');
            container4.className += "col-md-4";

            var container5 = document.createElement('DIV');
            container5.className += "kt-form__group--inline";

            var container6 = document.createElement('DIV');
            container6.className += "kt-form__group--inline";

            var container7 = document.createElement('DIV');
            container7.className += "col-md-4";

            var sales_counter = document.getElementById('number_sales');
            sales_counter.value = no_sales;


            var div_btns = document.createElement('DIV');
            div_btns.className = "col-md-3";

            var div_quantity = document.createElement('DIV');
            div_quantity.className += "kt-form__control";

            var div_price = document.createElement('DIV');
            div_price.className += "kt-form__control";

            var sales_quantity = document.createElement("INPUT");
            sales_quantity.setAttribute("type", "number");
            sales_quantity.setAttribute("name", "quantity" + no_sales);
            sales_quantity.className = 'form-control';
            sales_quantity.placeholder = "{{__('Quantity')}} " + no_sales;
            sales_quantity.required = true;

            var sales_price = document.createElement("INPUT");
            sales_price.setAttribute("type", "number");
            sales_price.setAttribute("name", "price" + no_sales);
            sales_price.className = 'form-control';
            sales_price.placeholder = "{{__('Price')}}" ;
            sales_price.required = true;

            var plus_btn = document.createElement("BUTTON");
            plus_btn.setAttribute("type", "button");
            plus_btn.className  = "btn";
            plus_btn.className += " btn-bold";
            plus_btn.className += " btn-sm";
            plus_btn.className += " btn-label-brand";
            plus_btn.style.marginRight = '10px'
            plus_btn.addEventListener("click", add_sale);
            plus_btn.innerHTML = '<i class="la la-plus"></i> {{__('Add')}}';


            var minus_btn = document.createElement("BUTTON");
            minus_btn.setAttribute("type", "button");
            minus_btn.className  = "btn-sm";
            minus_btn.className += " btn";
            minus_btn.className += " btn-label-danger";
            minus_btn.className += " btn-bold";
            minus_btn.addEventListener("click", function(){
                remove_sale( parent_container )
            });
            minus_btn.innerHTML = '<i class="la la-trash-o"></i> {{__('Delete')}}';

            var label = document.createElement('LABEL');
            label.className += "col-form-label";
            label.className += " col-lg-3";
            label.className += " col-sm-12";

            div_btns.appendChild(plus_btn);
            div_btns.appendChild(minus_btn);


            div_quantity.appendChild(sales_quantity);
            container5.appendChild(div_quantity);
            container4.appendChild(container5);

            div_price.appendChild(sales_price);
            container6.appendChild(div_price);
            container7.appendChild(container6);

            container3.appendChild(container4);
            container3.appendChild(container7);
            container2.appendChild(container3);
            container.appendChild(label);
            container.appendChild(container2);
            container3.appendChild(div_btns);


            container_item_name.appendChild(label_item_name);
            container_item_name.appendChild(label_item_name);
            container_2_item_name.appendChild(item_name);
            container_item_name.appendChild(container_2_item_name);



            parent_container.appendChild(container_item_name);
            parent_container.appendChild(container);

            field.appendChild(parent_container);

        }

        function remove_sale( container )
        {
            container.remove();
        }

    </script>

@endpush
