@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Normal Range')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.sub_analysis.index')}}" class="btn btn-secondary">
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
                    {{__('New Normal Range')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="post" action="{{route('dashboard.normal_ranges.store')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12">{{__('Sub Analysis')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control kt-selectpicker"  name="sub_analysis_id" data-live-search="true">
                                <option value="{{$subAnalysis->id}}">{{$subAnalysis->name}}</option>
                        </select>
                    </div>
                </div>
                <div id="repeater_div">
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12">{{__('Gender')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control kt-selectpicker" id="select_gender" >
                               <option value="0"  style="font-size:large" >Male</option>
                               <option value="1"  style="font-size:large" >Female</option>
                               <option value="2"  style="font-size:large" >Child</option>
                               <option value="3"  style="font-size:large" >All</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Age')}}</label>
                    <div class="col-lg-3 col-md-9 col-sm-12">
                        <input class="form-control" type="number" value="{{old('from')}}" placeholder="{{__('From')}}" id="from">
                    </div>
                    <div class="col-lg-3 col-md-9 col-sm-12">
                        <input class="form-control" type="number" value="{{old('to')}}" placeholder="{{__('To')}}" id="to">

                    </div>
                </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Normal')}}</label>
                        <div class="col-lg-6 col-md-9 col-sm-12">
    {{--                        <textarea class="form-control" type="text"   ></textarea>--}}
                            <textarea placeholder="{{__('Normal Range')}}" value="{{old('value')}}" id="normal_value" class="tox-target">

                            </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button onclick="add_normal_range()" type="button" class="btn btn-bold btn-sm btn-label-brand mx-auto">
                            <i class="la la-plus"></i> {{__('Add')}}
                        </button>
                    </div>

                </div>
            </div>
            <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" >
                <thead>
                <tr>
                    <th>{{__('Gender')}}</th>
                    <th>{{__('From')}}</th>
                    <th>{{__('To')}}</th>
                    <th>{{__('Normal')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody id="table_body" >
                @foreach( $subAnalysis->normal_ranges as $normal_range)
                    <tr id="row_{{++$index}}">
                        <td>@if ( $normal_range->gender  == 0) <input value="0" name="gender{{$index}}" style="display:none"> Male @elseif($normal_range->gender  == 1) <input value="1" name="gender{{$index}}" style="display:none"> Female @elseif($normal_range->gender  == 2) <input value="2" name="gender{{$index}}" style="display:none"> Child @else <input value="3" name="gender{{$index}}" style="display:none"> All @endif</td>
                        <td><input value="{{$normal_range->from}}" name="from{{$index}}" style="display:none">{{$normal_range->from}}</td>
                        <td><input value="{{$normal_range->to}}" name="to{{$index}}" style="display:none">{{$normal_range->to}}</td>
{{--                        <td><input value="{{$normal_range->value}}"  style="display:none">{{$normal_range->value}}</td>--}}
                        <td><textarea style="display: none" name="normal{{$index}}">{!! $normal_range->value !!}</textarea> <div>{!! $normal_range->value !!}</div></td>

                        <td><button type="button" class="btn-sm btn btn-bold" onclick="remove_row( document.getElementById('row_{{$index}}'))" style="background-color:transparent;border:0px;text-align:center"><i class="la la-trash-o"></i> {{__('Delete')}}</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            <!--end: Datatable -->

            <input type="number" id="number_ranges" value="{{$subAnalysis->normal_ranges->count()}}" style="display:none" name="number_ranges" >


            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-12" style="text-align:center">
                            <button type="submit" class="btn btn-success">{{__('confirm')}}</button>
                        </div>
                    </div>
                </div>
            </div>


        </form>

    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')
    <script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/tinymce/src/plugin.js')}}" type="text/javascript"></script>
    <script >
        $(function (){
            tinymce.init({
                selector: '#normal_value',
                // toolbar: false,
                statusbar: false,
                menubar: false,
                toolbar: ['fontsizeselect |undo redo | cut copy | bold italic | lists | alignleft aligncenter alignright alignjustify',
                    'bullist numlist | advlist | autolink | print preview |  code |ltr rtl'],
                plugins : 'directionality advlist lists charmap',
            });
        });
    </script>
    <script type="text/javascript">

        var table = document.getElementById('table_body');

        var ranges_counter = document.getElementById('number_ranges');

        var counter_no = ranges_counter.value;

        function add_normal_range() {

            counter_no++;
            ranges_counter.value = counter_no;

            var genderSelect = document.getElementById('select_gender');
            var genderVal    = genderSelect.options[genderSelect.selectedIndex].value;
            var genderText    = genderSelect.options[genderSelect.selectedIndex].text;

            var fromVal  = document.getElementById('from').value;

            var toVal    = document.getElementById('to').value;

            var normalVal = tinymce.get("normal_value").getContent();

            var TableRow  = document.createElement('tr');

            var genderTd  = document.createElement("td");
            var genderTxt = document.createElement("input");
            var genderInp = document.createElement("input");
            genderInp.setAttribute("name", "gender" + counter_no);
            genderInp.value = genderVal;
            genderInp.style.border = '0px';
            genderInp.style.display = 'none';

            genderTxt.value = genderText;
            genderTxt.style.border = '0px';
            genderTxt.style.textAlign = 'center';
            genderTd.appendChild(genderInp);
            genderTd.appendChild(genderTxt);

            var fromTd  = document.createElement("td");
            var fromInp = document.createElement("input");
            fromInp.setAttribute("name", "from" + counter_no);
            fromInp.value = fromVal;
            fromInp.style.textAlign = 'center';
            fromInp.style.border = '0px';
            fromTd.appendChild(fromInp);

            var toTd  = document.createElement("td");
            var toInp = document.createElement("input");
            toInp.setAttribute("name", "to" + counter_no);
            toInp.value = toVal;
            toInp.style.textAlign = 'center';
            toInp.style.border = '0px';
            toTd.appendChild(toInp);

            var normalTd  = document.createElement("td");
            var normaldiv = document.createElement("div");
            var normalInp = document.createElement("textarea");
            normaldiv.innerText = tinymce.get("normal_value").getContent({format:'text'});
            normalInp.setAttribute("name", "normal" + counter_no);
            normalInp.style.textAlign = 'center';
            normalInp.style.display = 'none';
            normalInp.value = normalVal;
            normalInp.style.border = '0px';
            normalTd.appendChild(normalInp);
            normalTd.appendChild(normaldiv);

            var actionTd  = document.createElement("td");

            var minus_btn = document.createElement("BUTTON");
            minus_btn.setAttribute("type", "button");
            minus_btn.className  = "btn-sm";
            minus_btn.className += " btn";
            minus_btn.className += " btn-bold";
            minus_btn.addEventListener("click", function(){
                remove_row( TableRow )
            });
            minus_btn.innerHTML = '<i class="la la-trash-o"></i> {{__('Delete')}}';

            actionTd.appendChild(minus_btn);

            TableRow.appendChild(genderTd)
            TableRow.appendChild(fromTd)
            TableRow.appendChild(toTd)
            TableRow.appendChild(normalTd)
            TableRow.appendChild(actionTd)

            table.appendChild(TableRow)
        }

        function remove_row(TableRow) {
            TableRow.remove();
        }
    </script>
@endpush
