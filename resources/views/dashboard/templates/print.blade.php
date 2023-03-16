<!doctype html>
<html lang="{{App::getLocale()}}" @if(App::isLocale('ar'))dir="rtl"@endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{asset('assets/css/style.bundle' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/pages/invoices/invoice-2' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/style.css')}}" rel="stylesheet" type="text/css" />
    @include('layouts.parts.dashboard.head')

    <style>

        @font-face {
            font-family: Myriad Pro Regular;
            src: url('{{ asset('fonts/MyriadPro-Regular.otf') }}');
        }
        @font-face {
            font-family: DroidKufi Regular;
            src: url('{{ asset('fonts/Droid.Arabic.Kufi_DownloadSoftware.iR_.ttf') }}');
        }
        *{
            font-family: 'DroidKufi Regular', "Myriad Pro Regular", serif !important;
            /*font-size: 12px;*/
        }
        /*.footer {*/
        /*    font-size: 9px;*/
        /*    text-align: center;*/
        /*}*/

        @if($template->type == 9 || $template->type == 10)
            .header {  width: 100% }
            .footer { position: fixed; bottom: 15px}
            body{
                margin:0;
                overflow:hidden;
            }
            .wrapper{
                transform: rotate(90deg);
                transform-origin:bottom left;
                position:absolute;
                top: -100vw;
                left: 0;
                height:100vw;
                width:100vh;
                /*background-color:#fff;*/
                /*color:#fff;*/
                overflow:auto;
            }
            table{
                border-collapse: inherit;
            }
        @else
        .header { display: table-header-group; }
        .footer { display: table-footer-group;}
        @endif

    </style>
</head>
<body @if(App::isLocale('ar'))dir="rtl"@endif>
@if($template->type == 9 || $template->type == 10 || $template->type == 11)
    <div class="wrapper">
        <div class="header" style="width: 100%;">
            <tr>
                <td>{!! $template->header() !!}</td>
            </tr>
        </div>
        <div style="width: 100%; margin: auto">
            {!! $content !!}
        </div>
        <div class="footer" style="width: 100%">
            <tr>
                <td>{!! $template->footer() !!}</td>    
            </tr>
        </div>
    </div>
@else

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
            <td></td>
        </tr>
        </tfoot>


</table>
@endif
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

