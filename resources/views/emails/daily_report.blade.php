<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{background-color: #ffffff}
        div{margin-top:3%}
        p{font-size:24px;margin:30px}
        h1{float:right;display:inline;margin:25px}
        img{margin-top:2%}
        @media only screen and (max-width : 720px) {
            h1{text-align:center;display:block;}
            img{margin-top:10%}
            div{margin-top:20%}

        }



    </style>
</head>
<body>
<center>
    <img src="{{asset('logo/logo1.png')}}">
</center>
<center>
    <div style="border:1px solid #d7d0c0;border-radius:8px;width:325px;">
        <p style="font-weight:bold">تقريـر مــعـمل فـيـن اليــومـي</p>
        <table dir="rtl" style="font-family:verdana,arial,sans-serif;font-size:11px;color:#333333;border-width:1px;border-color:#666666;border-collapse:collapse">
            <tbody>
            <tr>
                <th style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#dedede;text-align:center">النوع</th>
                <th style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#dedede;text-align:center">المبلغ</th>
            </tr>
            <tr>
            <td style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#FFFFFF;text-align:center">إجمــالي الأيرادات</td>
            <td style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#FFFFFF;text-align:center"><b>{{$data['sumRevenue']}}</b> ريـال سـعودي</td>
            </tr>
            <tr>
                <td style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#FFFFFF;text-align:center">إجمــالي الصـادرات</td>
                <td style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#FFFFFF;text-align:center"><b>{{$data['sumExports']}}</b> ريـال سـعودي</td>
            </tr>
            <tr>
                <td style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#FFFFFF;text-align:center"> عــدد المرضـي</td>
                <td style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#FFFFFF;text-align:center"><b>{{$data['no_patients']}}</b>  مـريــض</td>
            </tr>
            <tr>
                <td style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#FFFFFF;text-align:center"> عــدد المرضـي الجـدد</td>
                <td style="border-width:1px;padding:8px;border-style:solid;border-color:#666666;background-color:#FFFFFF;text-align:center"><b>{{$data['no_new_patients']}}</b>  مـريــض</td>
            </tr>
            </tbody>
        </table>
        <br>
        <p style="font-weight:bold">صــافي الأربــاح : <b> {{$data['profit']}} </b>  ريـال سـعودي</p>
    </div>
</center>
</body>
</html>
