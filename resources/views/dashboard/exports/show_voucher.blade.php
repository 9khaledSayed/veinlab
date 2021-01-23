@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Exports')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.exports.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <div class="kt-portlet" dir="rtl" id="voucher">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-invoice-2">
                <div class="kt-invoice__head"style="padding: 80px 0 0 0">
                    <div class="kt-invoice__container" style="border-right: 5px solid #000;padding-bottom: 150px;border-bottom: 5px solid #000;">
                        <div class="kt-invoice__brand">
                            <h3 class="font-weight-bold">مختبرات فين للتحاليل الطبية</h3>
                            <div href="#" class="kt-invoice__logo">
                                <span href="#"><img src="{{asset('logo/logo1.png')}}" style="text-align: center;text-decoration: none">
                                    <h2 class="text-center">سند صرف</h2>
                                </span>
                            </div>
                            <h3 class="font-weight-bold">Vein Medical Labs</h3>
                        </div>
{{--                        <div class="kt-invoice__brand">--}}
{{--                        </div>--}}
                        <div class="kt-invoice__items kt-font-lg text-center mt-3" style="border: 0">
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__subtitle">S.R ريال</span>
                                <span class="kt-invoice__text">{{$export->amount}}</span>
                            </div>
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__subtitle">التاريخ : {{$export->created_at->toFormattedDateString()}}</span>
                                <span class="kt-invoice__subtitle">الموافق : {{$export->created_at->toFormattedDateString()}}</span>
                            </div>
                        </div>
                        <div class="kt-invoice__items kt-font-lg text-center mt-2" style="border: 3px solid #ebedf2;border-radius: 17px;">
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__subtitle">تم الاستلام من شركة :</span>
                                <span class="kt-invoice__subtitle">مبلغ وقدره :</span>
                                <span class="kt-invoice__subtitle"> نقدا /بشيك رقم :</span>

                                <span class="kt-invoice__subtitle">وذلك عن :</span>
                            </div>
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__subtitle">{{$export->employee->fullname()}}</span>
                                <span class="kt-invoice__subtitle">{{$export->amount}}.00</span>
                                <span class="kt-invoice__subtitle">{{$export->CheckNo ?? '-'}}</span>
                                <span class="kt-invoice__subtitle"> {{$export->thisAbout ?? '-'}}</span>
                            </div>

                            <div class="kt-invoice__item" style="flex: 0.5">
                                <span class="kt-invoice__subtitle" style="color: white; width:fit-content">-</span>
                                <span class="kt-invoice__subtitle" style="color: white; width:fit-content">-</span>
                                <span class="kt-invoice__subtitle" style="width:fit-content">علي بنك :</span>
                            </div>
                            <div class="kt-invoice__item" style="flex: 0.5">
                                <span class="kt-invoice__subtitle" style="color: white; width:fit-content">-</span>
                                <span class="kt-invoice__subtitle" style="color: white; width:fit-content">-</span>
                                <span class="kt-invoice__subtitle" style="width:fit-content">{{$export->bank ?? '-'}}</span>
                            </div>
                            <div class="kt-invoice__item" style="flex: 0.5">
                                <span class="kt-invoice__subtitle" style="color: white; width:fit-content">-</span>
                                <span class="kt-invoice__subtitle" style="color: white; width:fit-content">-</span>
                                <span class="kt-invoice__subtitle" style="width:fit-content">بتاريخ :</span>
                            </div>
                            <div class="kt-invoice__item" style="flex: 0.5">
                                <span class="kt-invoice__subtitle" style="color: white; width:fit-content">-</span>
                                <span class="kt-invoice__subtitle" style="color: white; width:fit-content">-</span>
                                <span class="kt-invoice__subtitle" style="width:fit-content">{{$export->checkDate ?? '-'}}</span>
                            </div>
                        </div>
                        <div style="display: flex; margin: 15px">
                            <div style="margin: auto">المستلم : {{$export->employee->fullname()}}</div>
                            <div style="margin: auto">المحاسب : </div>
                            <div style="margin: auto">المدير : </div>
                        </div>
                    </div>

                </div>

                <div class="kt-invoice__actions">
                    <div class="kt-invoice__container">
                        <button type="button" class="btn btn-brand btn-bold mx-auto" onclick="window.print();">{{__('Print Invoice')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


