@extends('layouts.hr')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item mt-5" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        {{__('Employees')}}
                    </h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                    <div class="kt-subheader__group" id="kt_subheader_search">
                        <span class="kt-subheader__desc" id="kt_subheader_total">
                            {{$employees->count() . __(' Total')}}
                        </span>
                        <form class="kt-margin-l-20" id="kt_subheader_search_form">
                            <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                                <input type="text" class="form-control" placeholder="{{__('Search...')}}" id="generalSearch">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        <!--<i class="flaticon2-search-1"></i>-->
                                    </span>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <a href="#" class="">
                    </a>
                    <a href="{{route('dashboard.hr.employees.create')}}" class="btn btn-label-brand btn-bold">
                        {{__('Add New')}} </a>
                </div>
            </div>
        </div>

        <!-- end:: Content Head -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <!--Begin::Section-->
            <div class="row" id="container_1">
                @foreach($employees as $employee)
                <div class="col-xl-3 container_2 droid_font">

                    <!--Begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid container_3">
                        <div class="kt-portlet__head kt-portlet__head--noborder">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <a href="#" class="btn btn-icon" data-toggle="dropdown">
                                    <i class="flaticon-more-1 kt-font-brand"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__item">
                                            <a href="{{route('dashboard.hr.employees.edit', $employee)}}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-edit"></i>
                                                <span class="kt-nav__link-text">{{__('Edit')}}</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="{{route('dashboard.hr.employees.operations', $employee->id)}}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-edit"></i>
                                                <span class="kt-nav__link-text">{{__('Additions / Deductions')}}</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="{{route('dashboard.hr.employees.contract_draft', $employee->id)}}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-edit"></i>
                                                <span class="kt-nav__link-text">{{__('Print Contract')}}</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="javascript:" data-href="{{route('dashboard.hr.employees.destroy', $employee->id)}}" class="kt-nav__link delete-item">
                                                <i class="kt-nav__link-icon flaticon2-trash"></i>
                                                <span class="kt-nav__link-text">{{__('Delete')}}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body container_4">

                            <!--begin::Widget -->
                            <div class="kt-widget kt-widget--user-profile-2">
                                <div class="kt-widget__head">
                                    <div class="kt-widget__media">
                                        <img class="kt-hidden" src="" alt="image">
                                        <div class="kt-widget__pic kt-widget__pic--info kt-font-info kt-font-boldest  kt-hidden-">
                                            {{ mb_substr( $employee->fullname() ,0,2,'utf-8')}}
                                        </div>
                                    </div>
                                    <div class="kt-widget__info">
                                        <a href="#" class="kt-widget__username search_item">{{$employee->fullname()}}</a>
                                        <span class="kt-widget__desc search_item">{{$employee->roles->first()->name()}}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__body ">
                                    <div class="kt-widget__item mt-15">
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label">{{__('Email')}} :</span>
                                            <a href="#" class="kt-widget__data search_item">{{$employee->email}}</a>
                                        </div>
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label">{{__('Phone')}} :</span>
                                            <a href="#" class="kt-widget__data search_item">{{$employee->phone}}</a>
                                        </div>
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label">{{__('Joined Date')}} :</span>
                                            <span class="kt-widget__data search_item">{{$employee->joined_date->format('Y-m-d')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget__footer">
                                    <a href="{{route('dashboard.hr.employees.show', $employee)}}" class="btn btn-label-brand btn-lg btn-upper">{{__('Show Details')}}</a>
                                </div>
                            </div>

                            <!--end::Widget -->
                        </div>
                    </div>

                    <!--End::Portlet-->
                </div>
                @endforeach
            </div>

            <!--End::Section-->


            <!--Begin::Pagination-->
            <div class="row">
                <div class="col-xl-12">

                    <!--begin:: Components/Pagination/Default-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">

                            <!--begin: Pagination-->
                            <div class="kt-pagination kt-pagination--brand">
                                <ul class="kt-pagination__links">
                                    <li class="kt-pagination__link--first">
                                        <a href="#"><i class="fa fa-angle-double-right kt-font-brand"></i></a>
                                    </li>

                                    <li class="kt-pagination__link--next">
                                        <a href="#"><i class="fa fa-angle-right kt-font-brand"></i></a>
                                    </li>

                                    @for( $i = 0 ,$k = 1  ; $i <= $no_employees ; $i += 8 , $k++)
                                        <li>
                                            <a href="{{$employees->url($k)}}">{{$k}}</a>
                                        </li>
                                    @endfor

                                    <li class="kt-pagination__link--prev">
                                        <a href="#"><i class="fa fa-angle-left kt-font-brand"></i></a>
                                    </li>
                                    <li class="kt-pagination__link--last">
                                        <a href="#"><i class="fa fa-angle-double-left kt-font-brand"></i></a>
                                    </li>
                                </ul>
                            </div>

                            <!--end: Pagination-->
                        </div>
                    </div>

                    <!--end:: Components/Pagination/Default-->
                </div>
            </div>

            <!--End::Pagination-->
        </div>

        <!-- end:: Content -->
    </div>


@endsection

@push('scripts')


<script type="text/javascript">

        $(document).ready(function(){

            var messages = {
                'ar': {
                    'Are you sure to delete this item?': "هل انت متأكد أنك تريد مسح هذا العنصر؟",
                    'Item Deleted Successfully': "تم مسح العنصر بنجاح",
                    'Yes, Delete!': "نعم امسح!",
                    'No, cancel': "لا الغِ",
                    'OK': "تم",
                    'Loading...': "تحميل...",
                    'Error!': "خطأ!",
                    'Deleted!': "تم المسح!",
                    'delete': "مسح",
                }
            };

            var locator = new KTLocator(messages);

            $("#generalSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".col-xl-3").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $(".delete-item").click(function (e) {
                e.preventDefault();
                var href = $(this).attr('data-href');
                swal.fire({
                    buttonsStyling: false,

                    html: locator.__("Are you sure to delete this item?"),
                    type: "info",

                    confirmButtonText: locator.__("Yes, Delete!"),
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",

                    showCancelButton: true,
                    cancelButtonText: locator.__("No, cancel"),
                    cancelButtonClass: "btn btn-sm btn-bold btn-default"
                }).then(function (result) {
                    if (result.value) {
                        swal.fire({
                            title: locator.__('Loading...'),
                            onOpen: function () {
                                swal.showLoading();
                            }
                        });
                        $.ajax({
                            method: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: href,
                            error: function (err) {
                                if (err.hasOwnProperty('responseJSON')) {
                                    if (err.responseJSON.hasOwnProperty('message')) {
                                        swal.fire({
                                            title: locator.__('Error!'),
                                            text: locator.__(err.responseJSON.message),
                                            type: 'error'
                                        });
                                    }
                                }
                                console.log(err);
                            }
                        }).done(function (res) {
                            swal.fire({
                                title: locator.__('Deleted!'),
                                text: locator.__(res.message),
                                type: 'success',
                                buttonsStyling: false,
                                confirmButtonText: locator.__("OK"),
                                confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                            });
                        });

                        location.reload();
                    }
                });
            });

        });

</script>


@endpush
