<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('assets/css/style.bundle' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/pages/invoices/invoice-2' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/style.css')}}" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>
<style>

</style>
<body>
<div class="kt-portlet" dir="rtl" id="voucher">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-invoice-2">
            <div class="kt-invoice__head"style="padding: 80px 0 0 0">
                <div class="kt-invoice__container" style="padding-bottom: 150px;">
                    <div class="kt-invoice__brand text-center">
                            <h2 class="mx-auto"> ســـــند صــــــرف<br>PAYMENT VOUCHER</h2>
                    </div>
                    <div class="kt-invoice__items kt-font-lg text-center mt-3" style="border: 0">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle" dir="ltr">S.R ريال</span>
                            <span class="kt-invoice__text">0.00</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items kt-font-lg text-center mt-2" >
                        <div class="kt-invoice__item" style="flex: 0.4;">
                            <span class="kt-invoice__subtitle mb-2">التاريخ :</span>
                            <span class="kt-invoice__subtitle mb-2">اصرفوا الي السيد / السيدة :</span>
                            <span class="kt-invoice__subtitle mb-2">مبلغ وقدرة :</span>
                            <span class="kt-invoice__subtitle mb-2">وذلك عن :</span>
                            <span class="kt-invoice__subtitle mb-2">
                                <div class="kt-checkbox-inline">
                                    <label class="kt-checkbox">
                                        <input type="checkbox"> نقدا
                                        <span></span>
                                    </label>
                                    <label class="kt-checkbox">
                                        <input type="checkbox"> بشيك رقم
                                        <span></span>
                                    </label>
                                    <span>000</span>
                                </div>
                            </span>
                        </div>
                        <div class="kt-invoice__item" >
                            <span class="kt-invoice__subtitle mb-2">date</span>
                            <span class="kt-invoice__subtitle mb-2">company_name</span>
                            <span class="kt-invoice__subtitle mb-2">amount</span>
                            <span class="kt-invoice__subtitle mb-2">about</span>
                            <span class="kt-invoice__subtitle mb-2">علي بنك <span dir="ltr" style="padding: 0 20px">-</span> Bank</span>
                        </div>

                        <div class="kt-invoice__item" style="flex: 0.4;">
                            <span class="kt-invoice__subtitle mb-2" style="direction: ltr">Date :</span>
                            <span class="kt-invoice__subtitle mb-2" style="direction: ltr">Send to Mr. / Mrs. :</span>
                            <span class="kt-invoice__subtitle mb-2" style="direction: ltr">Amount of :</span>
                            <span class="kt-invoice__subtitle mb-2" style="direction: ltr">And that's about :</span>
                            <span class="kt-invoice__subtitle mb-2">تاريخ <span dir="ltr" style="padding: 0 20px">-</span> Date</span>
                        </div>
                    </div>
                    <div style="display: flex; margin: 15px">
                        <div class="persons mt-3" style="margin: auto;text-align: center" dir="ltr">Receiver المستلم<h3 class="mt-3">receiver</h3></div>
                        <div class="persons mt-3" style="margin: auto;text-align: center" dir="ltr">Accountant المحاسب<h3 class="mt-3">accountant</h3></div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</body>
</html>
