@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Results')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.results.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label" >
                <h3 class="kt-portlet__head-title">
                    {{__('Analysis Results')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <div style="display: flex;font-size: 1.2rem;font-weight: 600;margin-bottom: 20px;">
                            <div style="margin: auto;flex: 1;">{{__('Patient Name')}} : {{$patient->name}}</div>
                            <div style="margin: auto">{{__('File Number')}} : {{$patient->id}}</div>
                            <div style="margin: auto;flex: 1;@if( App::isLocale('ar') )text-align: left @else text-align:right @endif">
                                {{__('Created')}} :  {{$invoice->created_at->format('Y-m-d h:iA')}} <br>
                            </div>
                        </div>
                        <div style="display: flex;font-size: 1.2rem;font-weight: 600;margin-bottom: 10px;">
                            <div style="margin:auto;visibility:hidden;flex: 0.5">{{__('Patient Name')}} : {{$patient->name}}</div>
                            <div style="margin:auto;"><h3>Laboratory Report</h3></div>
                            <div style="margin:auto;visibility:hidden;flex: 0.5">
                                {{__('Created')}} :  {{$invoice->created_at->format('Y-m-d h:iA')}} <br>
                            </div>
                        </div>
                        @foreach($waiting_labs as $waiting_lab)
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label" style="margin: auto">
                                    <h3 class="kt-portlet__head-title">
                                        {{__('Analysis')}} :   {{$waiting_lab->main_analysis->general_name}}
                                    </h3>
                                </div>
                            </div>
                            <table class="table table-striped- table-bordered table-hover" id="kt_table_1">
                                @if($waiting_labs->first() == $waiting_lab)
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 10%">#</th>
                                    <th style="width: 22.5%">{{__('Test Name')}}</th>
                                    <th style="width: 22.5%">{{__('Result')}}</th>
                                    <th style="width: 22.5%">{{__('Unit')}}</th>
                                    <th style="width: 22.5%">{{__('Normal Range')}}</th>
                                </tr>
                                </thead>
                                @endif
                                <tbody>
                                @php
                                $k = 1;
                                @endphp
                                @foreach($waiting_lab->results as $result)
                                    <tr>
                                        <td style="width: 10%">{{$k++}}</td>
                                        <td style="width: 22.5%">{{$result->sub_analysis->name ?? ''}}</td>
                                        <td style="width: 22.5%">{{$result->result ?? ''}}</td>
                                        <td style="width: 22.5%">{{$result->sub_analysis->unit ?? ''}}</td>
                                        @if(isset($result->sub_analysis) && isset($result->sub_analysis->normal_ranges))
                                        <td style="width: 22.5%">{!! $result->sub_analysis->normal_ranges->whereIn('gender', [$gender, 3])->first()->value ??' '!!}</td>
                                        @else
                                        <td style="width: 22.5%"> </td>
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        @if(isset($waiting_lab->notes->lab_notes))
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row ">
                                        <div class="col-lg-12 text-center" >
                                            <h4 class="mt-3 mb-3 lab"> {{ __('Lab Notes')}} </h4>
                                            <p>{!! $waiting_lab->notes->lab_notes !!} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @can('reject_results')
                            <form  data-id = "{{$waiting_lab->id}}"  data-analysis = "{{$waiting_lab->main_analysis->general_name}}" style="text-align:center"  class="mb-5 mt-5">
                                <button type="submit"  class="btn btn-danger font-weight-bold btnprn" >{{__('Disapprove')}}</button>
                            </form>
                        @endcan

                        @endforeach
                    </div>
                    @if(Auth::guard('patient')->check() || Auth::guard('hospital')->check())
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row mt-5" >
                                <div class="col-lg-12" >
                                    <h4 style="float:right"> {{__('Doctor')}} : {{$doctor}} </h4>
                                    <button onclick="window.print()"  class="btn btn-brand btn-bold mx-auto btnprn" style="float:left" >{{__('print')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="kt-portlet__foot" style="text-align:center">
                            <div class="kt-form__actions">
                                <div class="row mb-4 mt-2" >
                                    <div class="col-lg-12" >
                                        <h4 @if( App::isLocale('ar') ) style="float:right" @else style="float:left" @endif> {{__('Doctor')}} :  {{$invoice->doctor}}</h4>
                                    </div>
                                </div>
                                <div class="row mb-4 mt-2" >
                                    <div class="col-lg-12" >
                                        <h4 @if( App::isLocale('ar') ) style="float:right" @else style="float:left" @endif> {{__('Signature')}} :  </h4>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-6">
                                        <a href="{{route('dashboard.results.print', $invoice->id)}}"  class="btn btn-brand btn-bold mx-auto btnprn "  >{{__('print')}}</a>
                                        </div>


                                        <div class="col-6">
                                            <button id="approve" class="btn btn-success font-weight-bold btnprn" >{{__('Approve')}}</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                     @endif
                </div>
            <!--end::Section-->
        </div>
    </div>

    <!--end::Portlet-->
@endsection

@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">


        $("#approve").on('click', function () {
            swal({
                title: "هل تريد إرسال النتيجه إلي المريض ؟",
                text: "",
                icon: "info",
                closeOnClickOutside: false,
                dangerMode: true,
                buttons: ["لا", "نــعــم"],
            })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            type:'POST',
                            url: '/dashboard/sendWsms',
                            data:{
                                "_token": "{{ csrf_token() }}",
                                patient_id: {{$patient->id}},
                                invoice_id: {{$invoice->id}}
                            },success: function () {
                                swal("تم إرسال النتائج إلي المريض بنجاح", {
                                    icon: "success",
                                });
                            }
                        });

                    } else {
                        $.ajax({
                            type:'POST',
                            url: '/dashboard/approve_result',
                            data:{
                                "_token": "{{ csrf_token() }}",
                                patient_id: {{$patient->id}},
                                invoice_id: {{$invoice->id}}
                            },success: function () {
                                swal("تم إرسال النتائج إلي المريض بنجاح", {
                                    icon: "success",
                                });
                            }
                        });
                        swal("تم إعتماد النتيجه بنجاح", {
                            icon: "success",
                        });
                    }
                });
        });



        $(document).on('submit', 'form[data-id]', function (e) {

         e.preventDefault();

         var waitingLab_id = $(this).attr('data-id');
         var analysis      = $(this).attr('data-analysis');

         $.ajax({
             type:'PUT',
             url: '/dashboard/disapprove/'+ waitingLab_id,
             data:{
                 "_token": "{{ csrf_token() }}",
             },
             success: function () {
                 swal("تــم  رفض نتائج تحليل " + analysis
                     , "سـوف يـتم رصد النتائج مره أخري في أقرب وقـت"
                     , "success"
                 )
             },
             error:function () {

             }

         });

        });
    </script>
@endpush
