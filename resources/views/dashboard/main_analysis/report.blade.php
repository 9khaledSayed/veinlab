@extends('layouts.dashboard')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label mx-auto">
                <h3 class="kt-portlet__head-title">
                    @if(isset($date)) {{__('Main Analysis Report For Month : ') . Date::parse($date)->format('F Y')}} @else {{__('Main Analysis Report')}} @endif
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
                        <h5 style="margin: auto">{{__('Total Price :')   . ' ' . number_format($total_amount, 2) }}</h5>
                        <h5 style="margin: auto">{{__('Total Cost :')    . ' ' . number_format($total_cost, 2)   }} </h5>
                        <h5 style="margin: auto">{{__('Total Profits :') . ' ' . number_format($total_profits, 2)}}</h5>
                    </div>
                    <h4 class="kt-portlet__foot-title text-center">

                    </h4>
                </div>
            </div>

            <!--end::Section-->
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
