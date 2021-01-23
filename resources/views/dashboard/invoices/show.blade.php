@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Invoices')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.invoices.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet" style="direction:rtl">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label mx-auto">
                <h3 class="kt-portlet__head-title">
                    Invoice ::  الفاتورة
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content" style="max-width: 1264px;
        margin: auto;">
                    <div class="table-responsive">
                        <table class="table table-bordered " style="font-weight: 500">
                            <thead>
                            <tr>
                                <th colspan="4">مختبرات فين الطبية</th>
                                <th colspan="1">الرقم الضريبي</th>
                                <th colspan="5">{{Setting::get('tax_no')}}</th>
                            </tr>
                            <tr>
                                <th>اسم المراجع / الهوية</th>
                                <th colspan="3">{{$patient->name}}</th>
                                <th colspan="2">{{$patient->id_no}}</th>
                                <th colspan="2">{{$patient->name_in_english ?? '-'}}</th>
                                <th colspan="2">Patient Name</th>
                            </tr>
                            <tr>
                                <th>التاريخ</th>
                                <th>{{$invoice->created_at->format('Y / m / d')}}</th>
                                <th>Date</th>
                                <th>رقم الملف</th>
                                <th>{{$patient->id}}</th>
                                <th>File no</th>
                                <th>رقم الفاتورة</th>
                                    <th>{{$invoice->serial_no}}</th>
                                <th colspan="2">Invoice no</th>
                            </tr>
                            <tr>
                                <th>المستشفى</th>
                                <th>{{$invoice->hospital->name ?? '-'}}</th>
                                <th>Hospital</th>
                                <th>رقم الحالة</th>
                                <th>{{$invoice->id}}</th>
                                <th>Ref no</th>
                                <th>الشركة</th>
                                <th>{{$invoice->company->name ?? '-'}}</th>
                                <th colspan="2">Company</th>
                            </tr>
                            <tr>
                                <th>الطبيب</th>
                                <th>{{$invoice->doctor->name ?? '-'}}</th>
                                <th>Doctor</th>
                                <th>الوقت</th>
                                <th>{{$invoice->created_at->format('h:iA')}}</th>
                                <th>Time</th>
                                <th>رقم البوليصة</th>
                                <th>{{$invoice->policy_no ?? '-'}}</th>
                                <th colspan="2">Policy no</th>
                            </tr>
                            <tr>
                                <td colspan="12" style="background: #AAAA"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>م</td>
                                <td>الخدمة :: service</td>
                                <td>كود :: code</td>
                                <td>العدد :: Qty</td>
                                <td>سعر :: Price</td>
                                <td>خصم :: Disc</td>
                                <td>الصافي :: Net</td>
                                <td>ض ق %</td>
                                <td>ض ق</td>
                                <td>اﻹجمالي</td>
                            </tr>
                            @php
                                $i = 0
                            @endphp
                            @foreach($purchases as $key => $value)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$key}}</td>
                                    <td>{{$value['code'] ?? '-'}}</td>
                                    <td>1</td>
                                    <td>{{$value['price']}}</td>
                                    <td>{{$value['discount']}}</td>
                                    <td>{{$value['price'] - $value['discount']}}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$value['price'] - $value['discount']}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>الاجمالي بدون الضريبة بعد الخصم</td>
                                <td>{{$invoice->total_price - $invoice->tax}}</td>
                                <td>Tuial</td>
                                <td>خصم</td>
                                <td>{{$invoice->discount}}</td>
                                <td>Discount</td>
                                <td colspan="4">ضريبة القمبة المضافة</td>
                            </tr>
                            <tr>
                                <td>الاجمالي شامل الضريبة بعد الخصم</td>
                                <td>{{$invoice->total_price}}</td>
                                <td>Li net</td>
                                <td>المدفوع</td>
                                <td>{{$invoice->amount_paid}}</td>
                                <td>Paid</td>
                                <td>التامين</td>
                                <td colspan="4">00</td>
                            </tr>
                            <tr>
                                <td>المتبقي</td>
                                <td>{{$invoice->amount_paid - $invoice->total_price}}</td>
                                <td>Due</td>
                            </tr>
                            <tr>
                                <td>طريقة الدفع</td>
                                @if($invoice->pay_method == config('enums.payMethod.cash'))
                                    <td colspan="2">نقدي :: cash</td>
                                @elseif($invoice->pay_method == config('enums.payMethod.credit'))
                                    <td colspan="2">credit :: شبكة</td>
                                @else
                                    <td colspan="2">overdue :: مؤجل</td>
                                @endif
                                <td>Payment Method</td>
                            </tr>
                            <tr>
                                <td>ملاحظة</td>
                                <td colspan="8"></td>
                                <td>note</td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="display: flex">
                            <div style="margin: auto">مستلم المبلغ : {{$invoice->employee->fullname()}}</div>
                            <div style="margin: auto">توقيع المراجع : </div>
                            <div style="margin: auto">
                                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($invoice->barcode, 'C39',2,44,array(1,1,1), true)}}" alt="barcode"   />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" style="text-align: center">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('dashboard.invoices.print', $invoice->id)}}" class="btn btn-brand btn-bold mx-auto">{{__('Print')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
    </div>
@endsection

{{--@push('scripts')--}}
{{--    <script type="text/javascript" src="{{asset('js/jquery.printPage.js')}}"></script>--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function(){--}}
{{--            $('.btnprn').printPage();--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
