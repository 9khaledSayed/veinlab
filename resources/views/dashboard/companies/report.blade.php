@extends('layouts.dashboard')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label mx-auto">
                <h3 class="kt-portlet__head-title">
                    @if(isset($date)) {{__('Companies Report For Month : ') . Date::parse($date)->format('F Y')}} @else {{__('Companies Report')}} @endif
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
                    <h5 class="kt-portlet__foot-title text-center">
                        {{__('Total Companies Dues :') .' ' . number_format($total_amount, 2)}}
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
