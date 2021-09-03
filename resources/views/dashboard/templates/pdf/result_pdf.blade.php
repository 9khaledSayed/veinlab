<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result</title>
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
</head>
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

   .bg-grey{
       background-color: #f2f2f2;
   }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: rgba(4, 156, 170, 0.62);
        color: white;
    }

    .grid-container {
        display: grid;
        height: 400px;
        align-content: center;
        grid-template-columns: auto auto auto;
        grid-gap: 10px;
        background-color: #2196F3;
        padding: 10px;
    }

    .grid-container > div {
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
        padding: 20px 0;
        font-size: 30px;
    }
</style>
<body>
<div class="container">

{{--    <div class="grid-container">--}}
{{--        <div>--}}
{{--            <h6 class="text-left text-small">Request Date : {{$invoice->created_at->format('Y-m-d h:i A')}}</h6>--}}
{{--            <h6 class="text-left text-small">Reporting Date : {{\Carbon\Carbon::parse($invoice->approved_date)->format('Y-m-d h:i A')}}</h6>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <div>--}}
{{--                <h6 class="text-left text-small">Patient Name : {{$patient->name}}</h6>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <h6 class="text-left text-small">Gender / Age : {{$patient->gender_name}} / {{$patient->age}} years</h6>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <h6 class="text-left text-small">Referred By : {{$invoice->doctor}}</h6>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <h6 class="text-left text-small">ID Number : {{$patient->id_no}}</h6>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}



    @foreach($invoice->waiting_labs as $waitingLab)
        <div class="row">
            <h4 class="text-center" style="text-decoration: underline;text-align: center">{{$waitingLab->main_analysis->general_name}}</h4>

            <table  id="customers">
                <thead class="text-center">
                <tr>
                    <th scope="col">Test</th>
                    <th scope="col">Result</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Reference Range</th>
                </tr>
                </thead>
                <tbody>
                @foreach($waitingLab->results->groupBy('classification') as $classification => $results)
                    @foreach($results as $result)
                        <tr>
                            <td class="{{$classification == $result->sub_analysis->name ? 'bg-grey' : ''}}">{{$result->sub_analysis->name . '  ' . htmlspecialchars_decode($result->sub_analysis->unit)}}</td>
                            <td class="text-center">{{$result->result}}</td>
                            <td>{{htmlspecialchars_decode($result->sub_analysis->unit ?? '-')}}</td>
                            <td class="text-center">{{$result->sub_analysis->normal($patient->gender) ?? '-'}}</td>
                        </tr>
                    @endforeach
                @endforeach

                @if($waitingLab->main_analysis->has_cultivation)
                <div class='d-flex flex-column align-items-start' style='direction: ltr'>
                    <h3 style='text-decoration: underline'>Cultivation</h3>
                    <p style='font-size: 18px'>On cultivation of the received specimen on the relevant media and after 24 hours of aerobic incubation, and sub-culturing suspicious colonies on selective media, the following was revealed.</p>
                </div>
                <div class='text-center ' style='padding:10px; border: 1px solid; margin: auto;font-weight: 900; font-size: 18px'>
                    {{$waitingLab->cultivation}}
                </div>

{{--                /** High Sensitive to **/--}}
                @if ($waitingLab->growth_status == 'growth')
                <div style="direction: ltr ; text-align: left; margin-top: 20px">
                    <h2>The growth is highly Sensitive to: </h2>
                    <table class="table-bordered text-left" style="font-size: 25px">
                        <tbody>
                        <tr>

                            @foreach ($waitingLab->high_sensitive_to as $key => $highSensitiveTo) {
                            <td class="p-3">{{$loop->index  + 1}}</td> <td class="p-3">{{$highSensitiveTo['name']}}</td>
                            @endforeach
                        </tr>
                         </tbody>
                    </table>
                </div>

{{--                /** Moderate Sensitive to **/--}}
              <div style="direction: ltr ; text-align: left; margin-top: 20px">
                    <h2>The growth is Moderate Sensitive to: </h2>
                    <table class="table-bordered text-left" style="font-size: 25px">
                        <tbody>
                        <tr>
                        @foreach ($waitingLab->moderate_sensitive_to as $key => $moderateSensitiveTo) {
                            <td class="p-3">{{$loop->index  + 1}}</td> <td class="p-3">{{$moderateSensitiveTo['name']}}</td>
                        @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>

{{--                /** Resistant to **/--}}
              <div style="direction: ltr ; text-align: left; margin-top: 20px">
                        <h2>The growth is Resistant to: </h2>
                        <table class="table-bordered text-left" style="font-size: 25px">
                            <tbody>
                            <tr>

                                @foreach ($waitingLab->resistant_to as $key => $resistantTo)
                                    <td class="p-3">{{$loop->index  + 1}}</td> <td class="p-3">{{$resistantTo['name']}}</td>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
            </div>
                @endif
                @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td class="bg-grey">Comment</td>
                        <td colspan="3">{{$waitingLab->labNotes()}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <hr>
    @endforeach



</div>


</body>
</html>