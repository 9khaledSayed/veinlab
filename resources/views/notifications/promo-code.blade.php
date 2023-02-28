@extends('layouts.dashboard')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__body">

            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                        <div class="col-12 mb-5" style="text-align:center;background-color:#f5f5f5;padding:15px">
                                <h4>!  تهانينا لـقد حصلت علي برومو كود قيمته  {{$promoCode->code}}</h4>
                        </div>

                        <div class="col-12 mb-5" style="text-align:center;padding:15px">
                            <h4>قيمة الخصم %  {{ $promoCode->percentage }}</h4>
                        </div>

                        <div class="col-12 mb-5" style="text-align:center;padding:15px">
                            <h4>هذا الخصم ساري من تاريخ {{ $promoCode->from->format("m/d/Y") }} الي {{ $promoCode->to->format("m/d/Y") }}   </h4>
                        </div>

                </div>

            </div>
            <!--end::Section-->
        </div>
    </div>

    <!--end::Portlet-->
@endsection
