@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Qr code')}}
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
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('Check in & Check out QRCode')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form class="kt-form kt-form--label-right" id="form_id" method="POST" action="{{route('dashboard.qr_code.test')}}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="kt-portlet__body">

                            <div class="form-group row">
                                <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Name')}}</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="" id="example-text-input" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Image')}}</label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <input class="form-control" type="file" value="" id="image" name="image">
                                </div>
                            </div>

                        </div>
                        <div class="kt-portlet__foot" style="text-align: center">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                                        <a href="{{route('dashboard.nationalities.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="kt-portlet__foot" style="text-align: center">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('dashboard.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $("#form_id").ajaxSubmit(function (event) {
                event.preventDefault();
                var formData = new FormData(document.getElementById('form_id'));
                // $.ajax({
                //    method:'post',
                //    url:'/dashboard/qr_code/test',
                //    data: $("#form_id").serializeArray(),
                //    success:function () {
                //        console.log('success');
                //    }
                // });

                $.post($(this).attr("action"), formData, function(data) {
                    alert(data);
                });
            })
        });
    </script>

@endpush
