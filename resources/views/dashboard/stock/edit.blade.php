@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Stock')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.stock.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Edit Item')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.stock.update',$stock)}}">
            @method('PUT')
            @csrf
            <div class="kt-portlet__body">





                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Company Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('company_name') is-invalid @enderror"
                               type="text"
                               value="{{ old('company_name') ?? $stock->company_name }}"
                               id="example-text-input"
                               name="company_name">
                        @error('company_name')
                        <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Item Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('item') is-invalid @enderror"
                               type="text"
                               value="{{ old('item') ?? $stock->item }}"
                               id="example-text-input"
                               name="item">
                        @error('item')
                        <div class="invalid-feedback">{{ $errors->first('item') }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Quantity')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('quantity') is-invalid @enderror"
                               type="number"
                               value="{{ old('quantity') ?? $stock->quantity }}"
                               id="example-text-input"
                               name="quantity">
                        @error('quantity')
                        <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Total Price')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('total_price') is-invalid @enderror"
                               type="number"
                               value="{{ old('total_price') ?? $stock->total_price }}"
                               id="example-text-input"
                               name="total_price">
                        @error('total_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.stock.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')

@endpush
