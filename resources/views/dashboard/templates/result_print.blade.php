{{--
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    @page {
        size: A4;
        /*margin: 11mm 17mm 17mm 17mm;*/
    }

    @media print {

        html,
        body {
            width: 280mm;
        }
    }

    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: unset;
        border-width: 0;
    }

    thead tr th {
        border: 1px solid;
        padding: 0
    }

    table {
        border-collapse: separate;
        border-spacing: 5px 3px;
        font-size: 1rem;
        font-weight: 500;
    }

    .bg-grey {
        background-color: #82827d63 !important;
    }

    .table>:not(caption)>*>* {
        padding: .3rem .5rem;
    }

    .header {
        display: table-header-group;
    }

    .footer {
        display: table-footer-group;
    }
</style>

<body>

    <table style="width: 100%;">

        {!! $content !!}

    </table>
</body>
<script>
    setTimeout(function(){
            function f (){
                window.print();
            };
            f();
        }, 500);
</script>

</html> --}}

<!DOCTYPE html>
<html>

<head>
    <title>Medical Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />
</head>

<style>
    /* Styles go here */

    .page-header,
    .page-header-space {
        height: 80px;
    }

    .page-footer,
    .page-footer-space {
        height: 160px;

    }

    .page-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-image: url('{{ asset('assets/media/medical-report/footer.png') }}');
        background-size: cover;
    }

    .page-header {
        position: fixed;
        top: 0mm;
        width: 100%;
    }

    .page {
        page-break-after: always;
    }

    @page {
        margin: 0mm 10mm
    }

    @media print {
        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        button {
            display: none;
        }

        body {
            margin: 0;
        }
    }
</style>

<body>

    <div class="page-header" style="text-align: center">
        <img class="logo" src="{{asset('logo/logo1.png')}}" width="400" height="80" alt="">
    </div>

    <div class="page-footer">
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
    </div>

    <table class="w-100">

        <thead>
            <tr>
                <td>
                    <!--place holder for the fixed-position header-->
                    <div class="page-header-space"></div>
                </td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    @foreach ($invoice->waiting_labs as $waitingLab)
                        @foreach ($waitingLab->results->groupBy('classification') as $classification => $results)
                        <!--*** CONTENT GOES HERE ***-->
                        <div class="page" style="margin-top: 40px">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center justify-content-center gender-avatar" style="border-right: 2px solid #535353">
                                    <img class="avatar"
                                        src="{{ asset('assets/media/medical-report/' . ($invoice->patient->gender == 0? 'male.png': 'female.png')) }}"
                                        width="100">
                                    <h3>{{ $invoice->patient->name }}</h3>
                                </div> 
                                <div class="col-6 d-flex flex-column justify-content-center px-5">
                                    <div class="row d-flex">
                                        <span class="user-info">Gender: {{ $invoice->patient->gender }}</span>
                                        <span class="user-info">Age: {{ $invoice->patient->age }}</span>
                                        <span class="user-info">Patient ID: {{ $invoice->patient->id }}</span>
                                    </div>
                                    <div class="row d-flex">
                                        <span class="user-info">Collecion Time: {{ $invoice->approved_date? $invoice->approved_date->format('Y-m-d h:i A') : '00-00-0000' }}</span>
                                        <span class="user-info">Order ID: 5200</span>
                                    </div>
                                    <div class="row d-flex">
                                        <span class="user-info">Result Time: {{ $invoice->created_at->format('Y-m-d h:i A') }}</span>
                                    </div>
                                    <div class="row d-flex">
                                        <span class="user-info">Medical Center: Beta Plus Laboratories</span>
                                    </div>
                                </div>
                            </div>
                            <div class="content" style="margin-top: 80px">
                                <h2 class="text-danger text-center mb-3">{{ $waitingLab->main_analysis->name }}</h2>
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
                                    @foreach ($results as $result)
                                        <tr>
                                            <th scope="row">{{ $result->sub_analysis->name }}</th>
                                            <td class="text-danger">{{ $result->result }}</td>
                                            {!! $result->sub_analysis->normal($invoice->patient->gender) ? '<td>' . $result->sub_analysis->normal($invoice->patient->gender)  . '</td>' : '<td> - </td>' !!}
                                            <td>{{ htmlspecialchars_decode($result->sub_analysis->unit ?? '-') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @endforeach
                    @endforeach

                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td>
                    <!--place holder for the fixed-position footer-->
                    <div class="page-footer-space"></div>
                </td>
            </tr>
        </tfoot>

    </table>

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