<!DOCTYPE html>
<html>

<head>
    <title>{{app()->isLocale('ar')? setting('NameArabic'): setting('NameEnglish')}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<style>
    /* Styles go here */
    *{
        font-family: 'Playfair Display', serif;
        font-weight: 900
    }

    .user-info {
        margin-left: 35px;
    }

    .page-header,
    .page-header-space {
        height: 80px;
    }

    .page-footer,
    .page-footer-space {
        height: 150px;

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
        page-break-after:always;
    }

    .row{
        display: flex;
        align-items: center;
        height: 100%;
    }
    
    .footer-icon{
        color: #2AB1D7;
        margin-right: 5px;
    }

    .contact-info{
        color: darkgray;
        font-size: 12px
    }


    .col-3{
        width: 25%;
        align-items: center;
        display: flex;
        flex-direction: column;
    }


    @page {
        margin: 10mm 10mm 0mm 10mm
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

        svg{
            display: none;
        }

    }
</style>

<body >

    <div class="page-header" style="text-align: center">
        <img class="logo" src="{{asset('beta-logos/translated-logo.png')}}" width="400" height="100%" alt="">
    </div>

    <div class="page-footer">
        <div class="row">
            <div class="col-3">
                <img class="logo" src="{{asset('beta-logos/vertical-logo.png')}}" width="140" height="100" alt="">
            </div>
            <div class="col-3">
                <div class="h6 contact-info">
                    <i class="fa-solid fa-phone footer-icon"></i>
                    +966112400601
                </div>
                <div class="h6 contact-info">
                    <i class="fa-solid fa-envelope footer-icon"></i>
                    info@betapluslab.com
                </div>
            </div>
            <div class="col-3">
                <img src="{{ asset('assets/media/medical-report/lab-signature.png') }}" width="150">
                <h5 class="text-center" style="margin:0;">Dr. Ahmed Saleh Alyami</h4>
                <h6 style="margin:0;color:darkgray;font-size:12px;text-align:center;">Consultant Clinical Scientist<br> Immunologist</h6>
            </div>
            <div class="col-3 justify-content-center visible-print text-center" >
                <div id="qr-code">
                    {{$qrCode}}
                </div>
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
                        <!--*** CONTENT GOES HERE ***-->
                        <div class="page" style="margin-top: 15px; @if($loop->last) page-break-after:auto @endif">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center justify-content-center gender-avatar"
                                    style="border-right: 2px solid #535353">
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
                                        <span class="user-info">Collecion Time: {{ $invoice->approved_date?
                                            $invoice->approved_date->format('Y-m-d h:i A') : '00-00-0000' }}</span>
                                        <span class="user-info">Order ID: 5200</span>
                                    </div>
                                    <div class="row d-flex">
                                        <span class="user-info">Result Time: {{ $invoice->created_at->format('Y-m-d h:i A')
                                            }}</span>
                                    </div>
                                    <div class="row d-flex">
                                        <span class="user-info">Medical Center: Beta Plus Laboratories</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="content" style="margin-top: 10px">
                                <h2 class="text-danger text-center mb-3">{{ $waitingLab->main_analysis->general_name }}</h2>
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
                                        @if($waitingLab->results->count() > 0)
                                            @foreach($waitingLab->results->groupBy('classification') as $classification => $results)
                                                @if($classification != "-")
                                                <tr>
                                                    <td colspan="4" class="text-left ml-3 text-bold h2">{{$classification}}</td>
                                                </tr> 
                                                @endif
                                                @foreach($results as $result)
                                                    <tr style="{{ $loop->index }}">
                                                        <th scope="row">{{ $result->sub_analysis->name }}</th>
                                                        <td class="text-info">{{ $result->result }}</td>
                                                        <td>
                                                            {!! $result->sub_analysis->normal($invoice->patient->gender) ? $result->sub_analysis->normal($invoice->patient->gender) : '-' !!}
                                                        </td>
                                                        <td>{!! htmlspecialchars_decode($result->sub_analysis->unit ?? '-') !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                @if($waitingLab->main_analysis->has_cultivation)

                                    <div class="d-flex flex-column align-items-start" style="direction: ltr">
                                        <h3 style="text-decoration: underline">Cultivation</h3>
                                        <p style="font-size: 18px">On cultivation of the received specimen on the relevant media and after 24 hours of aerobic incubation, and sub-culturing suspicious colonies on selective media, the following was revealed.</p>
                                    </div>

                                    @if($waitingLab->growth_status == 'growth')
                                        <div class="text-center " style="padding:10px; border: 1px solid; margin: auto;font-weight: 900; font-size: 18px">
                                            {{$waitingLab->cultivation}}
                                        </div>

                                        <div style="direction: ltr ; text-align: left; margin-top: 20px">
                                            <h2>The growth is highly Sensitive to: </h2>
                                            <table class="table-bordered text-left" style="font-size: 25px">
                                                <tbody>
                                                    <tr>
                                                        @foreach($waitingLab->high_sensitive_to as $highSensitiveTo)
                                                            <td class="p-3">{{$loop->index + 1}}</td>
                                                            <td class="p-3">{{$highSensitiveTo['name']}}</td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div style="direction: ltr ; text-align: left; margin-top: 20px">
                                            <h2>The growth is Moderate Sensitive to: </h2>
                                            <table class="table-bordered text-left" style="font-size: 25px">
                                                <tbody>
                                                    <tr>
                                                        @foreach($waitingLab->moderate_sensitive_to as $moderateSensitiveTo)
                                                            <td class="p-3">{{$loop->index + 1}}</td>
                                                            <td class="p-3">{{$moderateSensitiveTo['name']}}</td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div style="direction: ltr ; text-align: left; margin-top: 20px">
                                            <h2>The growth is Resistant to: </h2>
                                            <table class="table-bordered text-left" style="font-size: 25px">
                                                <tbody>
                                                    <tr>
                                                        @foreach($waitingLab->resistant_to as $resistantTo)
                                                            <td class="p-3">{{$loop->index + 1}}</td>
                                                            <td class="p-3">{{$resistantTo['name']}}</td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                @endif

                                @if(isset($waitingLab->notes->lab_notes))
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row ">
                                                <div class="col-lg-12 text-center" >
                                                    <h4 class="mt-3 mb-3 lab"> {{ 'Comments'}} </h4>
                                                    <p>{!! $waitingLab->notes->lab_notes !!} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Get the HTML element that you want to capture
    const element = document.getElementById('qr-code');

    // Use html2canvas to take a screenshot of the element
    html2canvas(element).then(canvas => {
        // Convert the canvas to a data URL
        const dataUrl = canvas.toDataURL();

        // Create an image element and set its src to the data URL
        const image = new Image();
        image.src = dataUrl;

        // Add the image to the document
        $('svg').remove();

        $('#qr-code').append(image);
    });   
    
    $.each($('.page'), function (indexInArray, page) { 
        $(page).find("tr:eq(19)").css('page-break-after', 'always')
    });

    setTimeout(function(){
        function f (){
            window.print();
        };
        f();
    }, 500);
</script>

</html>