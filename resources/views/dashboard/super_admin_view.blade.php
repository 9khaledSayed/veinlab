@extends('layouts.dashboard')
@section('content')
    <div class="kt-portlet" style="margin-top: 20px;">
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-lg border-bottom">
                <div class="col-md-12 col-lg-6 col-xl-2">

                    <!--begin::Total Profit-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.home_visits.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Home Visits')}}
                                    </h4>
                                    <span class="kt-widget24__desc">
                                        {{__('View Home Visits')}}
                                    </span>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-brand">
                                {{$home_visits_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.patients.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Patients')}}
                                    </h4>
                                    <span class="kt-widget24__desc">
                                        {{__('Patients Review')}}
                                    </span>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$patients_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <!--begin::New Orders-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.hospitals.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Hospitals')}}
                                    </h4>
                                    <span class="kt-widget24__desc">
                                        {{__('Total Hospitals')}}
                                    </span>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-danger">
                                {{$hospitals_no}}
                            </span>
                        </div>
                    </div>
                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">

                    <!--begin::New Users-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.doctors.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Doctors')}}
                                    </h4>
                                    <span class="kt-widget24__desc">
                                        {{__('All Doctors')}}
                                    </span>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-success">
                                {{$doctors_no}}
                            </span>
                        </div>
                    </div>
                    <!--end::New Users-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">

                    <!--begin::New Users-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.hospitals.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Employees')}}
                                    </h4>
                                    <span class="kt-widget24__desc">
                                       {{__('All Employees')}}
                                    </span>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-success">
                                {{$employees_no}}
                            </span>
                        </div>
                    </div>
                    <!--end::New Users-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">

                    <!--begin::New Users-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.companies.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Insurance Companies')}}
                                    </h4>
                                    <span class="kt-widget24__desc">
                                        {{__('All companies')}}
                                    </span>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-success">
                                {{$companies_no}}
                            </span>
                        </div>
                    </div>
                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
    <!--Begin::Row-->
    <div class="col-xl-12">

        <!--begin:: Widgets/Order Statistics-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{__('الارباح المالية')}}
                    </h3>
                </div>
            </div>
{{--            <div class="kt-portlet__body kt-portlet__body--fluid pb-0">--}}
{{--                <div class="kt-widget12">--}}
{{--                    <div class="kt-widget12__content text-center pb-0">--}}
{{--                        <div class="kt-widget12__item">--}}
{{--                            <div class="kt-widget12__info">--}}
{{--                                <span class="kt-widget12__desc">{{__('Revenue')}}</span>--}}
{{--                                <span class="kt-widget12__value kt-font-primary">{{$sumRevenue}}</span>--}}
{{--                            </div>--}}
{{--                            <div class="kt-widget12__info">--}}
{{--                                <span class="kt-widget12__desc">{{__('Exports')}}</span>--}}
{{--                                <span class="kt-widget12__value kt-font-danger">{{$sumExports}}</span>--}}
{{--                            </div>--}}
{{--                            <div class="kt-widget12__info">--}}
{{--                                <span class="kt-widget12__desc">{{__('Profit')}}</span>--}}
{{--                                <span class="kt-widget12__value kt-font-success">{{$profit}}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="kt-portlet__body kt-portlet__body--fluid pb-0">
                <canvas id="chart4" width="330" height="80"></canvas>
            </div>
        </div>
        <!--end:: Widgets/Order Statistics-->
    </div>
    <!--End::Row-->
    <!--Begin::Row-->
    <!--Begin::Row-->
    <div class="row">
        <div class="col-lg-6">
            <!--begin:: Widgets/New Users-->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('New Patients')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="kt-widget11">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td style="width:10%">#</td>
                                        <td style="width:15%">{{__('Name')}}</td>
                                        <td style="width:15%">{{__('Phone')}}</td>
                                        <td style="width:15%">{{__('National ID')}}</td>
                                        <td style="width:15%">{{__('Gender')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latest_patients as $patient)
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__sub">{{$patient->id}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">{{$patient->name}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">{{$patient->phone}}</span>
                                            </td>
                                            <td>{{$patient->id_no}}</td>
                                            <td>
                                                @if($patient->gender == 0)
                                                    <span class="kt-badge kt-badge--inline kt-badge--brand">
                                                   {{__('Male')}}
                                                </span>
                                                @endif
                                                @if($patient->gender == 1)
                                                    <span class="kt-badge kt-badge--inline kt-badge--primary">
                                                   {{__('Female')}}
                                                </span>
                                                @endif
                                                @if($patient->gender == 2)
                                                    <span class="kt-badge kt-badge--inline kt-badge--success">
                                                   {{__('Child')}}
                                                </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/New Users-->
        </div>
        <div class="col-lg-6">
            <!--begin:: Widgets/New Users-->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('Top Selling Main Analyses')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="kt-widget11">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td style="width:10%">#</td>
                                        <td style="width:20%">{{__('General Name')}}</td>
                                        <td style="width:20%">{{__('Code')}}</td>
                                        <td style="width:15%">{{__('Price')}}</td>
                                        <td style="width:15%">{{__('Demand No')}}</td>
                                        <td style="width:15%">{{__('Created')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($topSellingMainAnalyses as $analysis)
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__sub">{{$analysis->id}}</span>
                                            </td>
                                            <td>
                                                <a href="{{route('dashboard.main_analysis.show', $analysis)}}"><span class="kt-widget11__sub">{{$analysis->general_name}}</span></a>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">{{$analysis->code}}</span>
                                            </td>
                                            <td>{{$analysis->price . __(' SAR')}}</td>
                                            <td>{{$analysis->demand_no . __(' Order')}}</td>
                                            <td>{{$analysis->created_at->format('Y-m-d')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/New Users-->
        </div>
    </div>
    <!--End::Row-->
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        var profits         = @json($profits);

        console.log(profits);
        chart4();

        function chart4() {
            var ctx = document.getElementById('chart4').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['يناير','فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو','يوليو', 'أغسطس', 'سبتمبر','أكتوبر','نوفمبر',"ديسمبر"],
                    datasets: [
                        {
                            label: 'اجمالي الربح',
                            data: profits.total_profits,
                            backgroundColor: [
                                'rgba(120, 216, 65, 0.2)',
                            ],
                            borderColor: [
                                'rgba(120, 216, 65, 1)',
                            ],
                            borderWidth: 1
                        },
                        {
                            label: 'الإيرادات',
                            data: profits.income,
                            backgroundColor: [
                                'rgba(38, 50, 56, 0.2)',
                            ],
                            borderColor: [
                                'rgba(38, 50, 56, 1)',
                            ],
                            borderWidth: 1
                        },
                        {
                            label: 'المصاريف',
                            data: profits.spending,
                            backgroundColor: [
                                'rgba(242, 7, 7, 0.2)',
                            ],
                            borderColor: [
                                'rgba(242, 7, 7, 1)',
                            ],
                            borderWidth: 1
                        },

                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endpush