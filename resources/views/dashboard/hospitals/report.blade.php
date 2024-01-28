@extends('layouts.dashboard')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label mx-auto">
                <h3 class="kt-portlet__head-title">
                  @if(isset($date)) {{__('Hospitals Report For Month : ') . Date::parse($date)->format('F Y')}} @else {{__('Hospitals Report')}}  @endif

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
                    <h5 class="kt-portlet__foot-title text-center">
                        {{__('Total hospitals amount :') .' ' . number_format($total_amount, 2)}}
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
