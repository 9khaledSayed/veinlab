@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Waiting Labs')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.waiting_labs.archives')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <div style="display: flex;font-size: 1.2rem;font-weight: 600;margin-bottom: 20px;">
                            <div style="margin: auto;flex: 1;">{{__('Patient Name')}} : {{$waiting_lab->patient->name}}</div>
                            <div style="margin: auto">{{__('File Number')}} : {{$waiting_lab->patient->id}}</div>
                            <div style="margin: auto;flex: 1;@if( App::isLocale('ar') )text-align: left @else text-align:right @endif">
                                {{__('Created')}} :  {{$waiting_lab->invoice->created_at->format('Y-m-d h:iA')}} <br>
                            </div>
                        </div>
                        <div style="display: flex;font-size: 1.2rem;font-weight: 600;margin-bottom: 10px;">
                            <div style="margin:auto;visibility:hidden;flex: 0.5">{{__('Patient Name')}} : {{$waiting_lab->patient->name}}</div>
                            <div style="margin:auto;"><h3>Laboratory Report</h3></div>
                            <div style="margin:auto;visibility:hidden;flex: 0.5">
                                {{__('Created')}} :  {{$waiting_lab->invoice->created_at->format('Y-m-d h:iA')}} <br>
                            </div>
                        </div>
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label" style="margin: auto">
                                <h3 class="kt-portlet__head-title">
                                    {{__('Analysis')}} : {{$main_analysis->general_name}}
                                </h3>
                            </div>
                        </div>
                        @if($results->count() != 0)
                            <table class="table table-striped- table-bordered table-hover" id="kt_table_1">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{__('Test Name')}}</th>
                                <th>{{__('Result')}}</th>
                                <th>{{__('Unit')}}</th>
                                <th>{{__('Normal Range')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @csrf
                            @foreach($sub_analysis as $sub)
                                @if($results->map->sub_analysis->contains($sub))
                                    <tr>
                                        <th scope="row">{{++$index}}</th>
                                        <td>{{$sub->name}}</td>
                                        <td>{{$results->where('sub_analysis_id', $sub->id)->first()->result}} </td>
                                        <td>{{$sub->unit}}</td>
                                        <td>{!! $sub->normal_ranges->where('gender', $gender)->first()->value ?? $sub->normal_ranges->where('gender', 3)->first()->value ??'Not defined for ' . $genderType[$gender] !!}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                        <div class="kt-portlet__foot {{$notes->lab_notes  ?? "btnprn" }}">
                            <div class="kt-form__actions">
                                <div class="row " style="text-align: center" >
                                    <div class="col-lg-12" >
                                        <h4 class="mt-3 mb-3 lab"> {{ __('Lab Notes')}} :</h4>
                                        <p>{!! $notes->lab_notes ?? __('There Is No Notes') !!} </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        </div>
                </div>
                <div class="kt-portlet__foot" style="text-align:center">
                    <div class="kt-form__actions">
                        <div class="row mb-4 mt-2" >
                            <div class="col-lg-12" >
                                <h5 @if( App::isLocale('ar') ) style="float:right" @else style="float:left" @endif> {{__('Doctor')}} :  </h5>
                            </div>
                        </div>
                        <div class="row mb-4 mt-2" >
                            <div class="col-lg-12" >
                                <h5 @if( App::isLocale('ar') ) style="float:right" @else style="float:left" @endif> {{__('Signature')}} :  </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button onclick="window.print()"  class="btn btn-brand btn-bold mx-auto btnprn " >{{__('print')}}</button>
                            </div>
                            <div class="col-4 btnprn">
                                <a href="{{route('dashboard.waiting_labs.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                            </div>
                            <div class="col-4">
                                <a href="/dashboard/results/{{$invoice_id}}" class="btn btn-success font-weight-bold btnprn"  >{{__('All Analysis')}}</a>
                            </div>
                        </div>
                    </div>


                </div>
            <!--end::Section-->
        </div>
    </div>

    <!--end::Portlet-->
@endsection
