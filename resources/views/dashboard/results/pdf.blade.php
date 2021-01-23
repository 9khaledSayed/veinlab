<!doctype html>
<html @if( App::isLocale('ar') ) dir="rtl" @else dir="ltr" @endif>
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>{{__('Vien | Dashboard')}}</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--begin::Fonts -->
</head>
<style type="text/css" media="all">
    .kt-portlet {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 1;
        flex-grow: 1;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-shadow: 0px 0px 13px 0px rgba(82, 63, 105, 0.05);
        box-shadow: 0px 0px 13px 0px rgba(82, 63, 105, 0.05);
        background-color: #ffffff;
        margin-bottom: 20px;
        border-radius: 4px;
        border-top: 0;
        border-bottom: 1px solid #ebedf2;
    }
    .kt-portlet__body{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        padding: 25px;
        border-radius: 4px;
    }

    .kt-section {
        padding: 0;
        margin: 0 0 2rem 0;
        display: block;
        font-size: 1.3rem;
        font-weight: 500;
        color: #48465b;
    }

    .kt-portlet__head {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: stretch;
        -ms-flex-align: stretch;
        align-items: stretch;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        position: relative;
        padding: 0 25px;
        border-bottom: 1px solid #ebedf2;
        min-height: 60px;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
    }
    .kt-portlet__head-label {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .kt-portlet__head-title {
        margin: 0;
        padding: 0;
        font-size: 1.3rem;
        font-weight: 500;
        color: #48465b;
    }


    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        background-color: transparent; }
    .table th,
    .table td {
        text-align:center;
        width:20%;
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #ebedf2; }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #ebedf2; }
    .table tbody + tbody {
        border-top: 2px solid #ebedf2; }

    .table-sm th,
    .table-sm td {
        padding: 0.3rem; }

    .table-bordered {
        border: 1px solid #ebedf2; }
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ebedf2; }
    .table-bordered thead th,
    .table-bordered thead td {
        border-bottom-width: 2px; }

    .table-borderless th,
    .table-borderless td,
    .table-borderless thead th,
    .table-borderless tbody + tbody {
        border: 0; }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f7f8fa; }

    .table-hover tbody tr:hover {
        color: #212529;
        background-color: #fafbfc; }

    .table-primary,
    .table-primary > th,
    .table-primary > td {
        background-color: #d0d4f5; }

    .table-primary th,
    .table-primary td,
    .table-primary thead th,
    .table-primary tbody + tbody {
        border-color: #a8b0ed; }

    .kt-portlet .kt-portlet__foot {
        padding: 25px;
        border-top: 1px solid #ebedf2;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px; }
    .row {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px; }


</style>
<body style="background:#F8F8FB;padding:20px">

    <!-- begin:: Content -->


        <div class="kt-portlet">
            <div class="kt-portlet__body">

                <div class="kt-section">
                    <div class="kt-section__content">
                        <div style="display: flex;font-size: 1.2rem;font-weight: 600;margin-bottom: 20px;">
                            <div style="margin: auto;flex: 1;">{{__('Patient Name')}} : {{$patient->name}}</div>
                            <div style="margin: auto">{{__('File Number')}} : {{$patient->id}}</div>
                            <div style="margin: auto;flex: 1;@if( App::isLocale('ar') )text-align: left @else text-align:right @endif">
                                {{__('Created')}} :  {{$invoice->created_at->format('Y-m-d h:iA')}} <br>
                            </div>
                        </div>
                        <div style="display: flex;font-size: 1.2rem;font-weight: 600;margin-bottom: 10px;">
                            <div style="margin:auto;visibility:hidden;flex: 0.5">{{__('Patient Name')}} : {{$patient->name}}</div>
                            <div style="margin:auto;"><h3>Laboratory Report</h3></div>
                            <div style="margin:auto;visibility:hidden;flex: 0.5">
                                {{__('Created')}} :  {{$invoice->created_at->format('Y-m-d h:iA')}} <br>
                            </div>
                        </div>


                        @foreach($results as $result)

                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label" style="margin: auto">
                                    <h3 class="kt-portlet__head-title">
                                        {{__('Analysis')}} :   {{$main_analysis[++$index]}}
                                    </h3>
                                </div>
                            </div>
                            <table class="table table-striped-table-bordered table-hover" >
                                @if($index == 0)
                                    <thead class="thead-light" style="background-color:#EBEDF2">
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Test Name')}}</th>
                                        <th>{{__('Result')}}</th>
                                        <th>{{__('Unit')}}</th>
                                        <th>{{__('Normal Range')}}</th>
                                    </tr>
                                    </thead>
                                @endif
                                <tbody>

                                @for( $i = 0 , $k = 1; $i < sizeof($result) ; $i++ ,$k++)

                                    <tr>
                                        <th>{{$k}}</th>
                                        <td>{{$result[$i]->sub_analysis->name ?? ''}}</td>
                                        <td>{{$result[$i]->result ?? ''}}</td>
                                        <td>{{$result[$i]->sub_analysis->unit ?? ''}}</td>
                                        <td>{{$result[$i]->sub_analysis->normal_ranges->where('gender', $gender)->first()->value ?? $result[$i]->sub_analysis->normal_ranges->where('gender', 3)->first()->value ??'Not defined for ' . $genderType[$gender] ?? ''}}</td>
                                    </tr>

                                @endfor

                                </tbody>
                            </table>



                        @endforeach
                    </div>

                        <div class="kt-portlet__foot">
                                <div class="row"  @if( App::isLocale('ar') ) style="float:right" @else style="float:left" @endif >
                                        <h4> {{__('Doctor')}} : {{Auth::guard('employee')->user()->fname_arabic}} </h4>
                                </div>
                        </div>
                </div>
            </div>
        </div>

</body>
</html>
