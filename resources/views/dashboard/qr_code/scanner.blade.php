@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Qrcode scanner')}}
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
                            {{__('Check in & Check out QRCode Scanner')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <div class="m-auto p-5">
                            <video id="preview"></video>
                        </div>
                    </div>
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

    <audio controls id="success" style="display: none">
        <source src="{{asset('assets/tunes/Success.mp3')}}" type="audio/ogg">
        <source src="{{asset('assets/tunes/Success.mp3')}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <audio controls id="error" style="display: none">
        <source src="{{asset('assets/tunes/Error.mp3')}}" type="audio/ogg">
        <source src="{{asset('assets/tunes/Error.mp3')}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
@endsection
@push('scripts')
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            $.ajax({
                method:'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{route('dashboard.hr.attendance.store')}}',
                data : {
                    'employee_id' : content
                },
                success: function(response) {

                    //KTApp.unblock(formEl);
                    if(response.status == false){
                        swal.fire({
                            text: response.message,
                            icon: "error",
                            type: "error",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#error").trigger('play');
                    }else {
                        swal.fire({
                            text: response.message,
                            icon: "success",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $("#success").trigger('play');
                    }

                },
            })
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
    </script>

@endpush
