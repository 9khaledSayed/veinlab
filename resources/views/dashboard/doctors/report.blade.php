@extends('layouts.dashboard')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label mx-auto">
                <h3 class="kt-portlet__head-title">
                    @if(isset($date)) {{__('Doctors Report For Month : ') . Date::parse($date)->format('F Y')}} @else {{__('Doctors Report')}} @endif
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
                    <h5 class="kt-portlet__foot-title text-center">
                        {{__('Total doctors amount :') .' ' . number_format($total_amount, 2)}}
                    </h5>
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
