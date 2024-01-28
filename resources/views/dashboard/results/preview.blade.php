<html dir="rtl">
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Vin | Dashboard</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Fonts -->
    <link href="{{asset('assets/css/style.bundle' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />

</head>
<body >
<!--begin::Portlet-->
<div class="kt-portlet" style="padding: 100px; direction: rtl">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label" style="margin: auto">
            <h1>
                Analysis : {{$main_analysis->general_name}}
            </h1>
        </div>
    </div>
    <div class="kt-portlet__body">
        <!--begin::Section-->
        <div class="kt-section">
            <div class="kt-section__content">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Test Name</th>
                        <th>Result</th>
                        <th>Unit</th>
                        <th>Normal Ranges</th>
                    </tr>
                    </thead>
                    <tbody>
                    @csrf
                    @foreach($results as $result)
                        <tr>
                            <th scope="row">{{$result->id}}</th>
                            <td>{{$result->sub_analysis->name}}</td>
                            <td style="text-align:center">{{$result->result}}</td>
                            <td>{{$result->sub_analysis->unit}}</td>
                            <td>{{$result->sub_analysis->normal_ranges->where('gender', $gender)->first()->value ?? $result->sub_analysis->normal_ranges->where('gender', 3)->first()->value ??'Not defined for ' . $genderType[$gender]}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <label>Analysis Notes</label>
                <textarea class="form-control"
                          name="lab_notes"
                          readonly
                          placeholder="Type Your Notes"
                          rows="3">{{$notes->lab_notes ?? 'There Is No Notes'}}</textarea>
            </div>
        </div>

        <!--end::Section-->
    </div>
</div>

</body>
</html>

