@extends('layouts.dashboard')
@section('content')

    <div class="kt-subheader   kt-grid__item p-0" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h2 class="kt-subheader__title">
                    {{__('Statistics')}}
                </h2>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">


        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <div class="row">

                <div class="col-lg-6">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label ">
								<span class="kt-portlet__head-icon ">
                                    <i class="fas fa-flask btn-font-danger fa-2x"></i>
                                </span>
                                <h1 class="kt-portlet__head-title">
                                        {{__('Laboratory Patients : ') . $patients_no}}
                                </h1>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="kt_flotcharts_1" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon">
                                    <i class="fa fa-home kt-shape-font-color-4 fa-2x"></i>
                                </span>
                                <h2 class="kt-portlet__head-title">
                                    {{__('Home Visits Patients : ') . $home_visits_no}}
                                </h2>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="kt_flotcharts_2" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div class="kt-portlet kt-portlet--tab">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon">
                                    <i class="fa fa-building kt-font-success fa-2x"></i>
                                </span>
                                <h2 class="kt-portlet__head-title">
                                    {{ __('Companies : ') . $companies_no }}
                                </h2>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="kt_morris_3" style="height:500px;"></div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">

                    <div class="kt-portlet kt-portlet--tab">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon">
                                    <i class="fa fa-hospital kt-font-danger fa-2x"></i>
                                </span>
                                <h2 class="kt-portlet__head-title">
                                    {{ __('Hospitals : ') . $hospitals_no }}
                                </h2>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="kt_morris_4" style="height:500px;"></div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">

                    <div class="kt-portlet kt-portlet--tab">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon">
                                    <i class="fa fa-user-md kt-font-dark fa-2x"></i>
                                </span>
                                <h2 class="kt-portlet__head-title">
                                    {{ __('Doctors : ') . $doctors_no }}
                                </h2>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="kt_morris_5" style="height:500px;"></div>
                        </div>
                    </div>

                </div>
            </div>



            <div class="row">
                <div class="col-lg-12">

                    <div class="kt-portlet kt-portlet--tab">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon">
                                    <i class="fa fa-align-justify kt-font-danger fa-2x"></i>
                                </span>
                                <h2 class="kt-portlet__head-title">
                                    {{ __('Sectors : ') . $sectors_no }}
                                </h2>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="kt_morris_6" style="height:500px;"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>
@endsection

@push('scripts')
    <script>

        var male_patients_no       = {{ $male_patients_no }};
        var female_patients_no     = {{ $female_patients_no }};
        var child_patients_no      = {{ $child_patients_no }};
        var male_home_visits_no    = {{ $male_home_visits_no }};
        var female_home_visits_no  = {{ $female_home_visits_no }};
        var child_home_visits_no   = {{ $child_home_visits_no }};

        var companies              = @json($companies);
        var doctors                = @json($doctors);
        var hospitals              = @json($hospitals);
        var sectors                = @json($sectors);

    </script>
      <script src="{{asset('assets/plugins/custom/flot/flot.bundle.js')}}" type="text/javascript"></script>
      <script src="{{asset('assets/js/pages/components/charts/flotcharts.js')}}" type="text/javascript"></script>
      <script src="{{asset('assets/js/pages/components/charts/morris-charts.js')}}" type="text/javascript"></script>

@endpush
