@extends('layouts.dashboard')
@push('styles')
    <style>
        @media print {
            @page
            {
                size: auto;   /* auto is the initial value */

                /* this affects the margin in the printer settings */
                margin: 25mm 25mm 25mm 25mm;
            }

            body
            {
                /* this affects the margin on the content before sending to printer */
                margin: 0;
            }
        }

    </style>
@endpush
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Reports')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.reports.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet mb-0">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @if(isset($date)) {{__('Overall Report For Month : ') . Date::parse($date)->format('F Y')}} @else {{__('Overall Report')}} @endif
                    </h3>
                </div>
            </div>
        </div>
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label mx-auto">
                <h3 class="kt-portlet__head-title">
                    {{__('Companies Report')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table text-center">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Dues')}}</th>
                            <th>{{__('Created')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <th scope="row">{{$company->id}}</th>
                                <td>{{$company->name}}</td>
                                <td>{{$company->our_money}}</td>
                                <td>{{$company->created_at->toFormattedDateString()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-portlet__foot-label mx-auto">
                    <h5 class="kt-portlet__foot-title text-center total_box">
                        {{__('Total Companies Dues :') .' ' . number_format($companies_dues, 2)}}
                    </h5>
                </div>
            </div>
            <!--end::Section-->
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label mx-auto">
                    <h3 class="kt-portlet__head-title">
                        {{__('Doctors Report')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Phone')}}</th>
                                <th>{{__('Percentage')}}</th>
                                <th>{{__('Wallet')}}</th>
                                <th>{{__('All Money')}}</th>
                                <th>{{__('Patient No')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <th scope="row">{{$doctor->id}}</th>
                                    <td>{{$doctor->name}}</td>
                                    <td>{{$doctor->email}}</td>
                                    <td>{{$doctor->phone}}</td>
                                    <td dir="ltr">{{$doctor->percentage . ' %'}}</td>
                                    <td>{{$doctor->wallet}}</td>
                                    <td>{{$doctor->lifetime_wallet}}</td>
                                    <td>{{$doctor->no_patients}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-portlet__foot-label mx-auto">
                        <h5 class="kt-portlet__foot-title text-center total_box">
                            {{__('Total doctors amount :') .' ' . number_format($total_doctors_amount, 2)}}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label mx-auto">
                    <h3 class="kt-portlet__head-title">
                        {{__('Hospitals Report')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Phone')}}</th>
                                <th>{{__('Percentage')}}</th>
                                <th>{{__('Wallet')}}</th>
                                <th>{{__('All Money')}}</th>
                                <th>{{__('Patient No')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hospitals as $hospital)
                                <tr>
                                    <th scope="row">{{$hospital->id}}</th>
                                    <td>{{$hospital->name}}</td>
                                    <td>{{$hospital->email}}</td>
                                    <td>{{$hospital->phone}}</td>
                                    <td dir="ltr">{{$hospital->percentage . ' %'}}</td>
                                    <td>{{$hospital->wallet}}</td>
                                    <td>{{$hospital->lifetime_wallet}}</td>
                                    <td>{{$hospital->no_patients}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-portlet__foot-label mx-auto">
                        <h5 class="kt-portlet__foot-title text-center total_box">
                            {{__('Total hospitals amount :') .' ' . number_format($total_hospitals_amount, 2)}}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label mx-auto">
                    <h3 class="kt-portlet__head-title">
                        {{__('Analysis Report')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Abbreviation')}}</th>
                                <th>{{__('Insurance Price')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Cost')}}</th>
                                <th>{{__('Demand No')}}</th>
                                <th>{{__('Profit')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($main_analysis as $analysis)
                                <tr>
                                    <th scope="row">{{$analysis->id}}</th>
                                    <td>{{$analysis->general_name}}</td>
                                    <td>{{$analysis->abbreviated_name}}</td>
                                    <td>{{$analysis->price_insurance}}</td>
                                    <td>{{$analysis->price}}</td>
                                    <td>{{$analysis->cost}}</td>
                                    <td>{{$analysis->demand_no}}</td>
                                    <td>{{($analysis->demand_no * $analysis->price) - ($analysis->demand_no * $analysis->cost)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-portlet__foot-label mx-auto">
                        <div style="display: flex">
                            <h5 class="total_box" style="margin: auto">{{__('Total Price :')   . ' ' . number_format($total_analysis_amount, 2) }}</h5>
                            <h5 class="total_box" style="margin: auto">{{__('Total Cost :')    . ' ' . number_format($total_cost, 2)   }} </h5>
                            <h5 class="total_box" style="margin: auto">{{__('Total Profits :') . ' ' . number_format($total_profits, 2)}}</h5>
                        </div>
                        <h4 class="kt-portlet__foot-title text-center">

                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end::Portlet-->
@endsection
@push('scripts')
    <script>
        $(function (){
            setTimeout(function(){
                function f (){
                    window.print();
                };
                f();
            }, 500);
        })

    </script>
@endpush
