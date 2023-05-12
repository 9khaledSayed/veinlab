@extends('layouts.hr')

@section('content')
    <div class="kt-subheader   kt-grid__item mt-3" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Settings')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hr.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-brand">
                    {{__('Company Information')}}
                </h3>
            </div>

        </div>
        @if(session('message') == 'done')
            <div class="kt-portlet__body" >
                <div class="alert alert-success" style="margin: 0" role="alert">
                    <div class="alert-text">{{__('The Company Information Has been Updated !')}}</div>
                </div>
            </div>
        @endif

        <form id="add-form" method="post" action="{{route('dashboard.hr.settings.company_info')}}" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="NameArabic">{{__('Arabic Name')}} <span class="required">*</span></label>
                            <input autocomplete="off" class="form-control" id="NameArabic" name="NameArabic" type="text" value="{{old('NameArabic') ?? $setting['NameArabic']}}">
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="NameEnglish">{{__('English Name')}} <span class="required">*</span></label>
                            <input autocomplete="off" class="form-control" id="NameEnglish" name="NameEnglish" placeholder="" type="text" value="{{old('NameEnglish') ?? $setting['NameEnglish']}}">
                            <span class="text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="CrNumber">{{__('CR Number')}}</label>
                            <input autocomplete="off" class="form-control" id="CrNumber" name="CrNumber" placeholder="" type="text" value="{{old('CrNumber') ?? $setting['CrNumber']}}">
                            <span class="field-validation-valid text-danger" data-valmsg-for="CrNumber" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="CeoId">{{__('Chief Executive Officer')}}</label>
                            <select autocomplete="off" class="form-control kt-select2" name="ChiefExecutive">
                                <option></option>
                                @foreach($employees as $employee)
                                    <option
                                        value="{{$employee->id}}"
                                        @if(old('ChiefExecutive')??($setting['ChiefExecutive']??'') == $employee->id) selected @endif>
                                        {{$employee->fullname()}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="HrManagerId">{{__('HR Manager')}}</label>
                            <select autocomplete="off" class="form-control kt-select2" name="HrManager">
                                @foreach($employees as $employee)
                                    <option
                                        value="{{$employee->id}}"
                                        @if(old('HrManager')??($setting['HrManager']??'') == $employee->id) selected @endif>
                                        {{$employee->fullname()}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>




                <div class="kt-section">
                    <div class="kt-section__title">
                        {{__('Address')}}
                    </div>

                    <div class="kt-section__body">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="CountryId">{{__('Country (Arabic)')}} <span class="required">*</span></label>
                                    <input autocomplete="off" class="form-control" id="CountryId" name="CountryArabic" placeholder="" type="text" value="{{old('CountryArabic') ?? $setting['CountryArabic']}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="CountryId">{{__('Country (English)')}} <span class="required">*</span></label>
                                    <input autocomplete="off" class="form-control" id="CountryId" name="CountryEnglish" placeholder="" type="text" value="{{old('CountryEnglish') ?? $setting['CountryEnglish']??''}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="CityArabic">{{__('City (Arabic)')}}</label>
                                    <input autocomplete="off" class="form-control" id="CityArabic" name="CityArabic" placeholder="" type="text" value="{{old('CityArabic') ?? $setting['CityArabic']}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="CityEnglish">{{__('City (English)')}}</label>
                                    <input autocomplete="off" class="form-control" id="CityEnglish" name="CityEnglish" placeholder="" type="text" value="{{old('CityEnglish') ?? $setting['CityEnglish']}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="CityEnglish" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="AddressArabic">{{__('Address (Arabic)')}}</label>
                                    <input autocomplete="off" class="form-control" id="AddressArabic" name="AddressArabic" placeholder="" type="text" value="{{old('AddressArabic') ?? $setting['AddressArabic']}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="AddressArabic" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="AddressEnglish">{{__('Address (English)')}}</label>
                                    <input autocomplete="off" class="form-control" id="AddressEnglish" name="AddressEnglish" placeholder="" type="text" value="{{old('AddressEnglish') ?? $setting['AddressEnglish']}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="AddressEnglish" data-valmsg-replace="true"></span>
                                </div>

                            </div>
                        </div>


                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="PostalCode">{{__('Postal Code')}}</label>
                                    <input autocomplete="off" class="form-control" id="PostalCode" name="PostalCode" placeholder="" type="text" value="{{old('PostalCode') ?? $setting['PostalCode']}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="PostalCode" data-valmsg-replace="true"></span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="kt-section">
                    <div class="kt-section__title">
                        {{__('Contact')}}
                    </div>
                    <div class="kt-section__body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Telephone">{{__('Telephone')}}</label>
                                    <input autocomplete="off" class="form-control" id="Telephone" name="Telephone" placeholder="" type="text" value="{{old('Telephone') ?? $setting['Telephone']}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="Telephone" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Email">{{__('Email')}}</label>
                                    <input autocomplete="off" class="form-control" id="Email" name="Email" placeholder="" type="text" value="{{old('Email') ?? $setting['Email']}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="lat" value="25.9155444">
                <input type="hidden" name="lng" value="45.3884898">

{{--                <div class="kt-section">--}}
{{--                    <div class="kt-section__title">--}}
{{--                        {{__('Location')}}--}}
{{--                    </div>--}}
{{--                    <div class="kt-section__body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-12">--}}
{{--                                <input type="hidden" name="lat" id="lat">--}}
{{--                                <input type="hidden" name="lng" id="lng">--}}
{{--                                <div class="form-group row">--}}
{{--                                    <div id="map" style="height: 500px; width: 100%"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="kt-section">
                    <div class="kt-section__title">
                        Logo
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('Logo')}}</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_1">
                                            <div class="kt-avatar__holder" style="background-image: url({{asset($setting['logo_path'])}})"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="logo_url" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                                @error('logo_url')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('Company Stamp')}}</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_2">
                                        <div class="kt-avatar__holder" style="background-image: url({{asset($setting['company_stamp_path'] ?? '')}})"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="company_stamp" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                                @error('company_stamp')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('CEO Signature')}}</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_3">
                                        <div class="kt-avatar__holder" style="background-image: url({{asset($setting['ceo_signature_path'] ?? '')}})"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="ceo_signature" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                                @error('ceo_signature')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('Header')}}</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_4">
                                        <div class="kt-avatar__holder" style="background-image: url({{asset($setting['header_path'] ?? '')}})"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="header" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                                @error('header')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 mx-auto">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('Footer')}}</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_5">
                                        <div class="kt-avatar__holder" style="background-image: url({{asset($setting['footer_path'] ?? '')}})"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="footer" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                                @error('footer')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="kt-portlet__foot">

                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>
                    {{__('Submit')}}
                </button>
                <a class="btn btn-outline-danger btn-sm" href="{{route('dashboard.hr.index')}}">
                    <i class="fa fa-ban"></i>
                    {{__('Back')}}
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(function (){
           $('.kt-select2').select2({
               placeholder:'{{__('Choose')}}'
           });

            initKTAvatars();
        });

        var initKTAvatars = function () {
            new KTAvatar('kt_user_avatar_1');
            new KTAvatar('kt_user_avatar_2');
            new KTAvatar('kt_user_avatar_3');
            new KTAvatar('kt_user_avatar_4');
            new KTAvatar('kt_user_avatar_5');
        }

    </script>

   {{-- <script>--}}
       let branchMap, infoWindow;--}}
{{--        var pos = { lat: {{setting('lat') ?? 0}}, lng: {{setting('lng') ?? 0}} }--}}

{{--        function initMap() {--}}
{{--            var location = getCurrentLocation();--}}
{{--            branchMap = new google.maps.Map(document.getElementById("map"), {--}}
{{--                center: location,--}}
{{--                zoom: 15,--}}
{{--            });--}}

{{--            // The marker, positioned at Uluru--}}
{{--            const marker = new google.maps.Marker({--}}
{{--                position: location,--}}
{{--                map: branchMap,--}}
{{--                title: "Click to zoom",--}}
{{--            });--}}

{{--            infoWindow = new google.maps.InfoWindow();--}}

{{--            // <button type="button" class="btn btn-secondary btn-icon"><i class="fa fa-undo"></i></button>--}}
{{--            const locationButton = document.createElement("button");--}}
{{--            locationButton.textContent = "Get my current location";--}}
{{--            locationButton.style.padding = '10px';--}}
{{--            locationButton.style.fontSize = '14px';--}}
{{--            // locationButton.innerHTML = '<i class="fa fa-undo"></i>';--}}
{{--            locationButton.classList.add("custom-branchMap-control-button");--}}

{{--            branchMap.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);--}}

{{--            locationButton.addEventListener("click", (e) => {--}}
{{--                e.preventDefault();--}}
{{--                // Try HTML5 geolocation.--}}
{{--                if (navigator.geolocation) {--}}
{{--                    navigator.geolocation.getCurrentPosition(--}}
{{--                        (position) => {--}}
{{--                            const pos = {--}}
{{--                                lat: position.coords.latitude,--}}
{{--                                lng: position.coords.longitude,--}}
{{--                            };--}}
{{--                            branchMap.setCenter(pos);--}}
{{--                            marker.setPosition(pos);--}}
{{--                            setLatLngInputs(pos);--}}
{{--                        },--}}
{{--                        () => {--}}
{{--                            handleLocationError(true, infoWindow, branchMap.getCenter());--}}
{{--                        }--}}
{{--                    );
{{--                } else {--}}
{{--                    // Browser doesn't support Geolocation--}}
{{--                    handleLocationError(false, infoWindow, map.getCenter());--}}
{{--                }--}}
{{--            });--}}


{{--            branchMap.addListener("click", (mapsMouseEvent) => {--}}
{{--                var pos = mapsMouseEvent.latLng.toJSON();--}}
{{--                marker.setPosition(pos);--}}
{{--                setLatLngInputs(pos);--}}
{{--            });--}}

{{--            function getCurrentLocation() {--}}


{{--                if (navigator.geolocation) {--}}
{{--                    navigator.geolocation.getCurrentPosition(--}}
{{--                        (position) => {--}}
{{--                            pos = {--}}
{{--                                lat: position.coords.latitude,--}}
{{--                                lng: position.coords.longitude,--}}
{{--                            };--}}
{{--                            branchMap.setCenter(pos);--}}
{{--                            marker.setPosition(pos);--}}
{{--                        },--}}
{{--                        () => {--}}
{{--                            handleLocationError(true, infoWindow, branchMap.getCenter());--}}
{{--                        }--}}
{{--                    );--}}
{{--                } else {--}}
{{--                    // Browser doesn't support Geolocation--}}
{{--                    handleLocationError(false, infoWindow, map.getCenter());--}}
{{--                }--}}

{{--                setLatLngInputs(pos);--}}

{{--                return pos;--}}
{{--            }--}}

{{--            function handleLocationError(browserHasGeolocation, infoWindow, pos) {--}}
{{--                infoWindow.setPosition(pos);--}}
{{--                infoWindow.setContent(--}}
{{--                    browserHasGeolocation--}}
{{--                        ? "Error: The Geolocation service failed."--}}
{{--                        : "Error: Your browser doesn't support geolocation."--}}
{{--                );--}}
{{--                infoWindow.open(branchMap);--}}
{{--            }--}}

{{--            function setLatLngInputs(pos){--}}
{{--                $("#lat").val(pos.lat);--}}
{{--                $("#lng").val(pos.lng);--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
{{--    <!-- Async script executes immediately and must be after any DOM elements used in callback. --> --}}
   {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4Km6L1iAALvbX18stqmhywN80NN_gGNQ&callback=initMap&libraries=&v=weekly" async></script> --}}


@endpush
