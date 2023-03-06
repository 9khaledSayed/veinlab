<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    @page {
        size: A4;
        /*margin: 11mm 17mm 17mm 17mm;*/
    }
    @media print {
        html, body {
            width: 280mm;
        }
    }
    tbody, td, tfoot, th, thead, tr {
        border-color: inherit;
        border-style: unset;
        border-width: 0;
    }
    thead tr th{
        border: 1px solid;
        padding: 0
    }

    table{
        border-collapse: separate;
        border-spacing: 5px 3px;
        font-size: 1rem;
        font-weight: 500;
    }
    .bg-grey{
        background-color: #82827d63 !important;
    }

    .table>:not(caption)>*>* {
        padding: .3rem .5rem;
    }

    .header { display: table-header-group; }
    .footer { display: table-footer-group;}
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
</html>