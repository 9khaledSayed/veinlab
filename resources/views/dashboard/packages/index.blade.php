@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Packages')}}
                </h3>
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
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('All Packages')}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{route('dashboard.index')}}" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        {{__('Back')}}
                    </a>
                    @can('create_packages')
                    <a href="{{route('dashboard.packages.create')}}" class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus"></i> {{__('Add New')}}
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit mt-5">

            <!--begin::Basic Pricing 4-->
            <div class="kt-pricing-4">
                <div class="kt-pricing-4__bottom">
                    <div class="kt-pricing-4__bottok-container kt-pricing-4__bottok-container--fixed" style="width: 100%">
                        <div class="kt-pricing-4__bottom-items">
                            <div class="kt-pricing-4__bottom-item">
                                {{__('Name')}}
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                {{__('Analysis')}}
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                {{__('Price')}}
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                {{__('Created')}}
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                {{__('Actions')}}
                            </div>
                        </div>
                        @forelse($packages as $package)
                            <div class="kt-pricing-4__bottom-items">
                                <div class="kt-pricing-4__bottom-item">
                                    {{$package->name}}
                                </div>
                                <div class="kt-pricing-4__bottom-item">
                                    @foreach(unserialize($package->main_analysis) as $id)
                                        {{ \App\MainAnalysis::withTrashed()->find($id)->general_name}} ,
                                    @endforeach
                                </div>
                                <div class="kt-pricing-4__bottom-item">
                                    {{$package->price}}
                                </div>
                                <div class="kt-pricing-4__bottom-item">
                                    {{$package->created_at->toFormattedDateString()}}
                                </div>
                                <div class="kt-pricing-4__bottom-item">
                                    <div class="dropdown dropdown-inline">
                                        <button type="button" class="btn btn-hover-brand btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="flaticon-more-1"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href=""
                                                   class="dropdown-item"
                                                   onclick="event.preventDefault();
                                                       document.getElementById('edit-form{{$package->id}}').submit();"><i class="flaticon2-contract"></i>
                                                    {{ __('Edit') }}
                                                </a>
                                                <form id="edit-form{{$package->id}}" action="{{route('dashboard.packages.edit', $package)}}" method="GET" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                           <li>
                                                <a href=""
                                                   class="dropdown-item"
                                                onclick="event.preventDefault();
                                                            document.getElementById('delete-form{{$package->id}}').submit();"><i class="la la-trash"></i>
                                                {{ __('Delete') }}
                                                </a>
                                                <form id="delete-form{{$package->id}}" action="{{route('dashboard.packages.destroy', $package->id)}}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                                </form>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="kt-pricing-4__bottom-items">
                                <div class="kt-pricing-4__bottom-item">
                                    {{('There Is No Records')}}
                                </div>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

            <!--end::Basic Pricing 4-->
        </div>
    </div>

    <!--end::Portlet-->

    <!--begin::Portlet-->
{{--    <div class="kt-portlet">--}}
{{--        <div class="kt-portlet__head">--}}
{{--            <div class="kt-portlet__head-label">--}}
{{--                <span class="kt-portlet__head-icon">--}}
{{--                    <i class="la la-leaf"></i>--}}
{{--                </span>--}}
{{--                <h3 class="kt-portlet__head-title">--}}
{{--                    {{__('Packages')}}--}}
{{--                </h3>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="kt-portlet__body">--}}
{{--            <div class="kt-pricing-1">--}}
{{--                <div class="kt-pricing-1__items row col-lg-12 col-sm-12 col-md-12 mt-3 mb-3">--}}
{{--                    @forelse($packages as $package)--}}
{{--                        <div class="kt-pricing-1__item col-lg-3">--}}
{{--                            <div class="kt-pricing-1__visual">--}}
{{--                                <div class="kt-pricing-1__hexagon1"></div>--}}
{{--                                <div class="kt-pricing-1__hexagon2"></div>--}}
{{--                                <span class="kt-pricing-1__icon kt-font-warning"><i class="fa flaticon-gift"></i></span>--}}
{{--                            </div>--}}
{{--                            <span class="kt-pricing-1__price">{{$package->price}}<span class="kt-pricing-1__label">SAR</span></span>--}}
{{--                            <span class="kt-pricing-1__price" style="margin-top: 1rem;">{{$package->name}}</span>--}}
{{--                            @foreach(unserialize($package->main_analysis) as $ms)--}}
{{--                                <h2 class="kt-pricing-1__subtitle">{{ \App\MainAnalysis::find($ms)->general_name }}</h2>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @empty--}}
{{--                            <div class="form-group row">--}}
{{--                            <h1  style="text-align:center;">{{__('There is no Packages')}}</h1>--}}
{{--                           </div>--}}
{{--                    @endforelse--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!--end::Portlet-->
@endsection

@push('scripts')


@endpush
