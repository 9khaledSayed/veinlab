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
                <a href="{{route('dashboard.waiting_labs.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label" style="margin: auto">
                <h3 class="kt-portlet__head-title">
                    {{__('Analysis')}} : {{$main_analysis->general_name}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @if(session('message'))
                <div class="kt-portlet__body">
                    <div class="alert alert-success" style="margin: 0" id="alert" role="alert">
                        <div class="alert-text">{{__('Saved Successfully !')}}</div>
                    </div>
                </div>
            @endif
            <!--begin::Section-->
            <form class="form-group" action="{{route('dashboard.results.update', $waiting_lab->id)}}" method="post">
                @csrf
                @method('put')
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table table-striped- table-bordered table-hover">
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
                                <tr>
                                    <th scope="row">{{++$index}}</th>
                                    <td>{{$sub->name}}</td>
                                    @if($results->map->sub_analysis->contains($sub))
                                        <td>
                                            <input type="text"
                                                   class="form-control @error('result_' . $sub->id)is-invalid @enderror"
                                                   name="{{'result_' . $sub->id}}"
                                                   autofocus
                                                   value="{{$results->where('sub_analysis_id', $sub->id)->first()->result ?? old('result_' . $sub->id)}}"
                                                   placeholder="{{__('Enter result')}}">
                                            @error('result_' . $sub->id)
                                                <span class="invalid-feedback">
                                                        {{$message}}
                                                </span>
                                            @enderror
                                        </td>
                                    @else
                                        <td>
                                            <input type="text"
                                                   class="form-control @error('result_' . $sub->id)is-invalid @enderror"
                                                   name="{{'result_' . $sub->id}}"
                                                   value="{{$results->where('sub_analysis_id', $sub->id)->first()->result ?? old('result_' . $sub->id)}}"
                                                   placeholder="{{__('Enter result')}}">
                                            @error('result_' . $sub->id)
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </td>
                                    @endif
                                    <td>{{$sub->unit}}</td>
                                    <td>{!! $sub->normal_ranges->where('gender', $gender)->first()->value ?? $sub->normal_ranges->where('gender', 3)->first()->value?? '' !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <label>{{__('Analysis Notes')}}</label>
                        <div class="form-group row mt-5">
                            <div class="col-lg-12">
                            <textarea id="kt-tinymce-2" placeholder="{{__('Type your notes')}}" name="lab_notes" class="tox-target">
                                {!! $notes->lab_notes ?? '' !!}
                            </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" style="text-align: center">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                                <a href="{{route('dashboard.waiting_labs.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Section-->
        </div>
    </div>

    <!--end::Portlet-->
@endsection
@push('scripts')
    <script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/tinymce/src/plugin.js')}}" type="text/javascript"></script>

    <script >
        $(function (){
            tinymce.init({
                selector: '#kt-tinymce-2',
                // toolbar: false,
                statusbar: false,
                menubar: false,
                toolbar: ['fontsizeselect |undo redo | cut copy | bold italic | lists | alignleft aligncenter alignright alignjustify',
                    'bullist numlist | advlist | autolink | print preview |  code |ltr rtl'],
                plugins : 'directionality advlist lists charmap',
            });
            setTimeout(function (){
                $(".alert").fadeOut("slow")
            }, 500)
        });
    </script>
@endpush
