<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css" >

        .header { display: table-header-group; }
        @if($template->type==3 || $template->type==12)
        .footer { display: table-footer-group;}
        @else
        .footer {
            font-size: 9px;
            text-align: center;
        }

        @page {
            size: A4;
            margin: 11mm 17mm 17mm 17mm;
        }

        @media print {
            .footer {
                position: fixed;
                bottom: 0;
            }

            .content-block, p {
                page-break-inside: avoid;
            }

            html, body {
                width: 210mm;
            }
        }
        @endif
        @font-face {
            font-family: Myriad Pro Regular;
            src: url('{{ asset('fonts/MyriadPro-Regular.otf') }}');
        }
        @font-face {
            font-family: DroidKufi Regular;
            src: url('{{ asset('fonts/Droid.Arabic.Kufi_DownloadSoftware.iR_.ttf') }}');
        }
        *{
            font-family: 'DroidKufi Regular',"Myriad Pro Regular" !important;
            font-size: 12px;
        }



    </style>
</head>
<body>
    <table style="width: 100%;">
        <thead class="header">
            <tr>
                <td>{!! $template->header() !!}</td>
            </tr>
        </thead>

            <tbody style="width: 100%">
                <tr>
                    <td>
                        {!! $content !!}
                    </td>
                </tr>
            </tbody>
        <tfoot class="footer">
        <tr>
            <td>{!! $template->footer() !!}</td>
        </tr>
        </tfoot>
    </table>
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
    <script>
        $(function (){
            setTimeout(function(){
                function f (){
                    window.print();
                };
                f();
            }, 500);
        })
    </script>
</body>

</html>

