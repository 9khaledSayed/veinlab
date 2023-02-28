<!DOCTYPE html>

<html lang="{{App::getLocale()}}" @if(App::isLocale('ar'))dir="rtl"@endif>

<!-- begin::Head -->
<head>
    @include('layouts.parts.dashboard.head')
</head>
<style>
    /* -----
SVG Icons - svgicons.sparkk.fr
----- */

    .svg-icon {
        width: 1em;
        height: 1em;
    }

    .svg-icon path,
    .svg-icon polygon,
    .svg-icon rect {
        fill: #4691f6;
    }

    .svg-icon circle {
        stroke: #4691f6;
        stroke-width: 1;
    }
    @font-face {
        font-family: Myriad Pro Regular;
        src: url('{{ asset('fonts/MyriadPro-Regular.otf') }}');
    }
    @font-face {
        font-family: DroidKufi Regular;
        src: url('{{ asset('fonts/Droid.Arabic.Kufi_DownloadSoftware.iR_.ttf') }}');
    }

    .form-group {
        margin-bottom: 1rem;
    }
    @if(!Auth()->guard('employee')->check())
        @media (min-width: 1025px){
            .kt-aside--fixed.kt-aside--minimize .kt-wrapper {
                padding-right: 0;
            }
            .kt-aside--fixed .kt-wrapper {
                padding-right: 0;
            }
        }
    @endif

    .required{
        color: red;
        font-size: 12px;
        font-weight: 900;
        margin: 4px;
    }

    @media print {
        .print-mode {
            color: #fff;
            background-color: #343a40;
            border-color: #454d55;
        }
        .btnprn,lab{
            display: none;
        }
        #voucher{
            transform: rotate(90deg);
            margin-top: 380px;
        }
        @page {
            padding: 20cm;
        }

    }

    li
    {
        list-style-type:none;
    }

    .swal-footer {
        text-align: center;
    }

    .swal-button--confirm {
        background-color: #4962B3;
        font-size: 12px;
        border: 1px solid #3e549a;
        text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
    }

</style>

<!-- end::Head -->

<!-- begin::Body -->
<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">
<!-- begin:: Page -->
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="index.html">
            <img alt="Logo" src="{{asset(Setting::get('logo_path'))}}" height="50px" style="padding: 5px"/>
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <div class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></div>
        <div class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></div>
        <div class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></div>
    </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <!-- begin:: Aside -->
        @includeWhen( Auth::guard('employee')->check() && !Auth::user()->roles->pluck('name_english')->contains('Super Admin') , 'layouts.parts.dashboard.aside')
        @includeWhen(Auth::guard('employee')->check() && Auth::user()->roles->pluck('name_english')->contains('Super Admin'), 'layouts.parts.dashboard.admin_aside')
        <!-- end:: Aside -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" @if(!Auth::guard('employee')->check()) style="padding-left: 0" @endif>
            <!-- begin:: Header -->
            @include('layouts.parts.dashboard.header')
            <!-- end:: Header -->

            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid pt-4">
                    @yield('content')
                </div>
                <!-- end:: Content -->
            </div>

            @include('layouts.parts.dashboard.footer')
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Quick Panel -->
<div id="kt_quick_panel" class="kt-quick-panel">
    <a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>
    <div class="kt-quick-panel__nav">
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_notifications" role="tab">Notifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_logs" role="tab">Audit Logs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_settings" role="tab">Settings</a>
            </li>
        </ul>
    </div>
    <div class="kt-quick-panel__content">
        <div class="tab-content">
            <div class="tab-pane fade show kt-scroll active" id="kt_quick_panel_tab_notifications" role="tabpanel">
                <div class="kt-notification">
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-line-chart kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                New order has been received
                            </div>
                            <div class="kt-notification__item-time">
                                2 hrs ago
                            </div>
                        </div>
                    </a>


                    <a href="#" class="kt-notification-v2__item">
                        <div class="kt-notification-v2__item-icon">
                            <i class="flaticon2-hangouts-logo kt-font-warning"></i>
                        </div>
                        <div class="kt-notification-v2__itek-wrapper">
                            <div class="kt-notification-v2__item-title">
                                4.5h-avarage response time
                            </div>
                            <div class="kt-notification-v2__item-desc">
                                Fostest is Barry
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="tab-pane kt-quick-panel__content-padding-x fade kt-scroll" id="kt_quick_panel_tab_settings" role="tabpanel">
                <form class="kt-form">
                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Customer Care</div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Enable Notifications:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--success kt-switch--sm">
                                <label>
                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_1">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Enable Case Tracking:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--success kt-switch--sm">
                                <label>
                                    <input type="checkbox" name="quick_panel_notifications_2">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-group-last form-group-xs row">
                        <label class="col-8 col-form-label">Support Portal:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--success kt-switch--sm">
                                <label>
                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_2">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>
                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Reports</div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Generate Reports:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--danger">
                                <label>
                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_3">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Enable Report Export:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--danger">
                                <label>
                                    <input type="checkbox" name="quick_panel_notifications_3">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-group-last form-group-xs row">
                        <label class="col-8 col-form-label">Allow Data Collection:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--danger">
                                <label>
                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_4">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>
                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Memebers</div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Enable Member singup:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--brand">
                                <label>
                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_5">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Allow User Feedbacks:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--brand">
                                <label>
                                    <input type="checkbox" name="quick_panel_notifications_5">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-group-last form-group-xs row">
                        <label class="col-8 col-form-label">Enable Customer Portal:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--brand">
                                <label>
                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_6">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end::Quick Panel -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

@include('layouts.parts.dashboard.foot')

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-analytics.js"></script>


<script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyCsj-EzdkthcRC5s7srGP4F23LW8pAF9SQ",
        authDomain: "veinlab-c579c.firebaseapp.com",
        projectId: "veinlab-c579c",
        storageBucket: "veinlab-c579c.appspot.com",
        messagingSenderId: "969110427917",
        appId: "1:969110427917:web:daf89d9d3d2a0c532ff844",
        measurementId: "G-LYVPG2BGL0"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    // firebase.analytics();

    const messaging = firebase.messaging();


    initFirebaseMessagingRegistration();
    onPushing();


    function onPushing() {
        messaging.onMessage(function(payload) {
            const data = payload.data;
            const noteTitle = payload.notification.title;

            const noteOptions = {
                icon: payload.notification.icon,
            };

            // alert('push messaging done');

            console.log(data);

            /** append notification **/
            $("#notification_body").prepend(`
                <a href="/dashboard/notifications/${data['gcm.notification.id']}/mark_as_read" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="${data['gcm.notification.alert_icon']} kt-font-${data['gcm.notification.class']}"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                <h6>  ${data['gcm.notification.alert_title']} </h6>
                            </div>
                            <div class="kt-notification__item-time">
                                ${data['gcm.notification.date']}
                        </div>
                    </div>
                </a>
            `);

            /** increment counter **/
            var notificationCounter = $("#notification-counter");
            if (!notificationCounter.length){
                $("#notification-bell").append(`
                    <span style="background:red;color:white;font-weight:bold;padding-right:8px;padding-left:8px;margin-bottom:20px;border-radius:25px" id="notification-counter">1</span>
                `);
            }else{
                notificationCounter.text(parseInt(notificationCounter.text()) + 1);
            }

            /** play notification sound **/
            $("#sound").trigger('play');

            new Notification(noteTitle, noteOptions);

        });



    }

    function initFirebaseMessagingRegistration() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("dashboard.save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        console.log('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });

            }).catch(function (err) {
            console.log('User Chat Token Error'+ err);
        });
    }

    /** Load more btn **/
    $("#load-more").click(function (e) {
        e.preventDefault();

        $("#loadmore-icon").html(
            `<div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        `);

        var next = $(this).attr('data-next');
        $.ajax({
            type: 'get',
            url: '/dashboard/load_more/' + next,
            success: function (res) {
                if(res.data.length == 0){
                    $("#load-more").remove();

                }else{
                    $.each(res.data, function (key, value) {
                        $("#load-more").before('\
                        <a href="/dashboard/notifications/' + value.data.id + '/mark_as_read" class="navi-item">\
                            <div class="navi-link rounded">\
                                <div class="symbol symbol-50 mr-3">\
                                    <div class="symbol-label">\
                                        <i class="' + value.data.icon + ' text-' + value.data.class + ' icon-lg"></i>\
                                    </div>\
                                </div>\
                                <div class="navi-text">\
                                    <div class="font-weight-bold font-size-lg">' + value.data.title + '</div>\
                                    <div class="text-muted">' + value.data.date + '</div>\
                                </div>\
                            </div>\
                        </a>\
                        ');
                    });

                    $("#loadmore-icon").html(
                        `<span class="svg-icon svg-icon-primary svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) "/>
                            <path d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) "/>
                            </g>
                        </svg>
                    </span>
                    `);



                    $("#load-more").attr('data-next', res.next);
                }

            }
        });

    });

</script>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
