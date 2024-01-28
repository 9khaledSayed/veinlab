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
</style>
<body>
<div class="container">
    <div class="row d-flex justify-content-between p-2 mb-5" style="border-width: 4px 0; border-style: solid;">
        <div class="col" style="width: fit-content">
            <h6 class="text-left text-small">Request Date : 2020-10-10 10:05:19 AM</h6>
            <h6 class="text-left text-small">Reporting Date : 2020-10-10 10:05:19 AM</h6>
            <h6 class="text-left text-small">
                <div style="margin: auto">
                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG(2020202, 'C39',2,44,array(1,1,1), true)}}" alt="barcode"   />
                </div>
            </h6>
        </div>
        <div class="col">
            <img src="http://127.0.0.1:8000/storage/company_info/main_logo.png" class="d-block m-auto" width="100" height="100">
        </div>
        <div class="col" style="width: fit-content">
            <div class="row">
                <div class="col-6 text-center">Patient Name</div>
                <div class="col-6 text-center">خالد سيد محمد حمادة</div>
            </div>
            <div class="row">
                <div class="col-6 text-center">Gender / Age</div>
                <div class="col-6 text-center">Female / 4 years</div>
            </div>
            <div class="row">
                <div class="col-6 text-center">Referred By</div>
                <div class="col-6 text-center">اسم الطبيب</div>
            </div>
            <div class="row">
                <div class="col-6 text-center">ID Number</div>
                <div class="col-6 text-center">4565464646</div>
            </div>
        </div>
    </div>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>

    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>
    <hr>

    <div class="row">
        <h4 class="text-center" style="text-decoration: underline">dsfdsafsdaf</h4>

        <table class="table text-center">
            <thead class="text-center">
            <tr>
                <th scope="col">Test</th>
                <th scope="col">Result</th>
                <th scope="col">Unit</th>
                <th scope="col">Reference Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td class="bg-grey">Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>
            <tr>
                <td>Mark</td>
                <td class="text-center">Mark</td>
                <td>Otto</td>
                <td class="text-center">20 - 30</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td class="bg-grey">Comment</td>
                <td colspan="3">sdf  adsf sad sdaf sadf sdaf sad f sadf  sadf sdaf sadf s fdMark</td>
            </tr>
            </tfoot>
        </table>
    </div>

</div>


</body>
</html>