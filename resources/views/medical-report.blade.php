<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .logo {
        margin: auto;
        display: block;
        margin-bottom: 20px;
    }

    .gender-avatar {
        border-right: 2px solid #535353
    }

    .header,
    .header-space,
    .footer,
    .footer-space {
        height: 100px;
        width: 100%
    }

    .footer,
    .footer-space {
        height: 160px;
    }

    .header,
    .header-space {
        height: 400px;
    }

    .header { 
        position: fixed;
        top: 0;
    }

    .footer {
        position: fixed;
        bottom: 0;
        background-image: url('{{ asset('assets/media/medical-report/footer.png') }}');
        background-size: cover;
    }

    .footer-bar{
        background-color: red;
        height: 20px;
    }

    .user-info{
        margin-left: 20px;
    }
</style>

<body>
    <table class="w-100"> 
        <thead>
            <tr>
                <td>
                    <div class="header-space">&nbsp;</div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="content" style="">
                        <h2 class="text-danger text-center mb-3">Lipid Profile</h2>
                        <table class="table-borderless w-75 mx-auto">
                            <thead>
                                <tr>
                                    <th scope="col">Test Name</th>
                                    <th scope="col">Result</th>
                                    <th scope="col">Normal Range</th>
                                    <th scope="col">Unit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Thyroid Stimulating Hormone (TSH)</th>
                                    <td class="text-danger">16.84</td>
                                    <td>0.25 - 5.8</td>
                                    <td>ulU/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                            </tbody>
                        </table>
                        <h2 class="text-danger text-center mb-3">Lipid Profile</h2>
                        <table class="table-borderless w-75 mx-auto">
                            <thead>
                                <tr>
                                    <th scope="col">Test Name</th>
                                    <th scope="col">Result</th>
                                    <th scope="col">Normal Range</th>
                                    <th scope="col">Unit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Thyroid Stimulating Hormone (TSH)</th>
                                    <td class="text-danger">16.84</td>
                                    <td>0.25 - 5.8</td>
                                    <td>ulU/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triiodothyronine - Free (FT3)</th>
                                    <td class="text-danger">1.3</td>
                                    <td>1.92 - 4.44</td>
                                    <td>pg/ml</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <div class="footer-space">&nbsp;</div>
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="header">
        <div class="container-fluid">
            <img class="logo" src="{{asset('logo/logo1.png')}}" width="400" height="150" alt="">
            <div class="row">
                <div class="col-6 d-flex align-items-center justify-content-center gender-avatar">
                    <img class="avatar" src="{{ asset('assets/media/medical-report/male.png') }}" width="100">
                    <h3>خالد سيد محمد</h3>
                </div>
                <div class="col-6 d-flex flex-column justify-content-center px-5">
                    <div class="row d-flex">
                        <span class="user-info">Gender: Male</span>
                        <span class="user-info">Age: 25</span>
                        <span class="user-info">Patient ID: 24564844</span>
                    </div>
                    <div class="row d-flex">
                        <span class="user-info">Collecion Time: 2022-10-20 10:53 AM</span>
                        <span class="user-info">Order ID: 5200</span>
                    </div>
                    <div class="row d-flex">
                        <span class="user-info">Result Time: 2022-10-20 10:53 AM</span>
                    </div>
                    <div class="row d-flex">
                        <span class="user-info">Medical Center: Beta Plus Laboratories</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="footer">
        <div class="row">
            <div class="col-3">
                <img class="logo" src="{{asset('logo/logo1.png')}}" width="200" height="120" alt="">
            </div>
            <div class="col-3 d-flex flex-column justify-content-center">
                <div class="h6 text-black-50"> 
                    <i class="fa-solid fa-phone mr-1 text-primary"></i>
                    +966112400601
                </div>
                <div class="h6 text-black-50"> 
                    <i class="fa-solid fa-envelope mr-1 text-primary"></i>
                    info@betapluslab.com
                </div>
            </div>
            <div class="col-3 d-flex flex-column align-items-center">
                <img class="avatar" src="{{ asset('assets/media/medical-report/lab-signature.png') }}" width="150">
                <h6 class="text-bold">Dr. Ahmed Saleh Alyami</h6>
                <h6 class="text-center text-black-50">Consultant Clinical Scientist<br> Immunologist</h6>
            </div>
            <div class="col-3 d-flex flex-column align-items-center">

                {{QrCode::gradient(28, 181, 224, 0, 8, 81, 'horizontal')
                ->style('dot', 0.9)
                ->size(150)
                ->eyeColor(0, 28, 181, 224, 0, 8, 81)
                ->eyeColor(1, 28, 181, 224, 0, 8, 81)
                ->eyeColor(2, 28, 181, 224, 0, 8, 81)
                ->generate('46564')}}
            </div>
        </div>
        {{-- <div class="footer-bar"></div> --}}
    </div>
</body>
<script>
    setTimeout(function(){
        function f (){
            window.print();
        };
        f();
    }, 500);
</script>
</html>