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
                        @foreach($classifications as $classification => $sub_analyses)
                            <h1 class="" style="text-align: left">{{$classification}}</h1>
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
                            @foreach($sub_analyses as $sub)
                                <tr>
                                    <th scope="row">{{++$index}}</th>
                                    <td>{{$sub->name}}</td>
                                    @if($results->map->sub_analysis->contains($sub))
                                        <td>
                                            <input type="text"
                                                   dir="ltr"
                                                   class="form-control text-center @error('result_' . $sub->id)is-invalid @enderror"
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
                                                   dir="ltr"
                                                   class="form-control text-center @error('result_' . $sub->id)is-invalid @enderror"
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
                                    <td>{!! $sub->normal($gender) !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endforeach

                        @if($main_analysis->has_cultivation)
                                <label>{{__('Growth Status')}}</label>
                                <select class="form-control @error('growth_status') is-invalid @enderror selectpicker"
                                        name="growth_status" title="Select">
                                    <option value="no_growth" {{(old('growth_status') ?? $waiting_lab->growth_status) == 'no_growth' ? 'selected' : ''}}>Negative</option>
                                    <option value="growth" {{(old('growth_status') ?? $waiting_lab->growth_status) == 'growth' ? 'selected' : ''}}>Positive</option>
                                </select>

                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                <div style="display: none" id="cultivationDiv">
                                    <label>{{__('Cultivation')}}</label>
                                    <input dir="auto" class="form-control text-center @error('cultivation') is-invalid @enderror"
                                           name="cultivation" value="{{old('cultivation') ?? $waiting_lab->cultivation}}" />
                                    @error('cultivation')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror

                                    <div class="row mt-3" style="margin-bottom: 30px">
                                        <div class="col-lg-4">
                                            <div class="kt_repeater shadow p-3">
                                                <div class="kt-heading kt-heading--md m-auto pb-3"
                                                     style="width: fit-content">{{__('Highly Sensitive To')}}</div>
                                                <div class="form-group form-group-last row kt_repeater">
                                                    <div data-repeater-list="high_sensitive_to" class="col-lg-12">
                                                        @forelse(old('high_sensitive_to') ?? $waiting_lab->high_sensitive_to as $highSensitiveTo)
                                                            <div data-repeater-item
                                                                 class="form-group row align-items-center">
                                                                <div class="col-md-10">
                                                                    <div class="kt-form__group--inline">
                                                                        <div class="kt-form__control">
                                                                            <input type="text" dir="auto" name="name"
                                                                                   value="{{$highSensitiveTo['name']}}"
                                                                                   class="text-center form-control @error('name') is-invalid @enderror">
                                                                            @error('high_sensitive_to.' . $loop->index . '.name')
                                                                            <div class="text-danger">
                                                                                {{$message}}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a href="javascript:;" data-repeater-delete=""
                                                                       class="btn-sm btn btn-label-danger btn-bold">
                                                                        <i class="la la-trash-o"></i>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div data-repeater-item
                                                                 class="form-group row align-items-center">
                                                                <div class="col-md-10">
                                                                    <div class="kt-form__group--inline">
                                                                        <div class="kt-form__control">
                                                                            <input type="text" dir="auto" name="name"
                                                                                   class="text-center form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a href="javascript:;" data-repeater-delete=""
                                                                       class="btn-sm btn btn-label-danger btn-bold">
                                                                        <i class="la la-trash-o"></i>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <div class="mx-auto">
                                                        <a href="javascript:;" data-repeater-create=""
                                                           class="btn btn-bold btn-sm btn-label-brand">
                                                            <i class="la la-plus"></i> Add
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <div class="kt_repeater shadow p-3">
                                                <div class="kt-heading kt-heading--md m-auto pb-3"
                                                     style="width: fit-content">{{__('Moderate Sensitive To')}}</div>
                                                <div class="form-group form-group-last row kt_repeater">
                                                    <div data-repeater-list="moderate_sensitive_to" class="col-lg-12">
                                                        @forelse(old('moderate_sensitive_to') ?? $waiting_lab->moderate_sensitive_to as $moderateSensitiveTo)
                                                            <div data-repeater-item
                                                                 class="form-group row align-items-center">
                                                                <div class="col-md-10">
                                                                    <div class="kt-form__group--inline">
                                                                        <div class="kt-form__control">
                                                                            <input type="text" dir="auto" name="name"
                                                                                   value="{{$moderateSensitiveTo['name']}}"
                                                                                   class="text-center form-control @error('name') is-invalid @enderror">
                                                                            @error('moderate_sensitive_to.' . $loop->index . '.name')
                                                                            <div class="text-danger">
                                                                                {{$message}}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a href="javascript:;" data-repeater-delete=""
                                                                       class="btn-sm btn btn-label-danger btn-bold">
                                                                        <i class="la la-trash-o"></i>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div data-repeater-item
                                                                 class="form-group row align-items-center">
                                                                <div class="col-md-10">
                                                                    <div class="kt-form__group--inline">
                                                                        <div class="kt-form__control">
                                                                            <input type="text" dir="auto" name="name"
                                                                                   class="text-center form-control @error('name') is-invalid @enderror">
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a href="javascript:;" data-repeater-delete=""
                                                                       class="btn-sm btn btn-label-danger btn-bold">
                                                                        <i class="la la-trash-o"></i>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <div class="mx-auto">
                                                        <a href="javascript:;" data-repeater-create=""
                                                           class="btn btn-bold btn-sm btn-label-brand">
                                                            <i class="la la-plus"></i> Add
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <div class="kt_repeater shadow p-3">
                                                <div class="kt-heading kt-heading--md m-auto pb-3"
                                                     style="width: fit-content">{{__('Resistant To')}}</div>
                                                <div class="form-group form-group-last row kt_repeater">
                                                    <div data-repeater-list="resistant_to" class="col-lg-12">
                                                        @forelse(old('resistant_to') ?? $waiting_lab->resistant_to as $resistantTo)
                                                            <div data-repeater-item
                                                                 class="form-group row align-items-center">
                                                                <div class="col-md-10">
                                                                    <div class="kt-form__group--inline">
                                                                        <div class="kt-form__control">
                                                                            <input type="text" dir="auto" name="name"
                                                                                   value="{{$resistantTo['name']}}"
                                                                                   class="text-center form-control @error('name') is-invalid @enderror">
                                                                            @error('resistant_to.' . $loop->index . '.name')
                                                                            <div class="text-danger">
                                                                                {{$message}}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a href="javascript:;" data-repeater-delete=""
                                                                       class="btn-sm btn btn-label-danger btn-bold">
                                                                        <i class="la la-trash-o"></i>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div data-repeater-item
                                                                 class="form-group row align-items-center">
                                                                <div class="col-md-10">
                                                                    <div class="kt-form__group--inline">
                                                                        <div class="kt-form__control">
                                                                            <input type="text" dir="auto" name="name"
                                                                                   class="text-center form-control @error('name') is-invalid @enderror">
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a href="javascript:;" data-repeater-delete=""
                                                                       class="btn-sm btn btn-label-danger btn-bold">
                                                                        <i class="la la-trash-o"></i>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <div class="mx-auto">
                                                        <a href="javascript:;" data-repeater-create=""
                                                           class="btn btn-bold btn-sm btn-label-brand">
                                                            <i class="la la-plus"></i> Add
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

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
            }, 500);

            initFormRepeaters();
            onSelectGrowthStatus();
        });

        function initFormRepeaters() {
            $(".kt_repeater").map(function (key, value) {
                $(value).repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function () {
                        $(this).slideDown();
                    },

                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });
            });
        }

        function onSelectGrowthStatus() {

            var cultivationDiv = $("#cultivationDiv");
            var growthSelect = $("select[name='growth_status']");

            if(growthSelect.val() === 'growth'){
                cultivationDiv.fadeIn();
            }else {
                cultivationDiv.fadeOut();
            }

            growthSelect.change(function () {
                var cultivationDiv = $("#cultivationDiv")
                if($(this).val() === 'growth'){
                    cultivationDiv.fadeIn();
                }else {
                    cultivationDiv.fadeOut();
                }
            });
        }

    </script>
@endpush
