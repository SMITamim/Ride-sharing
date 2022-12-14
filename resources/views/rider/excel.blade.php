@extends('rider.layouts.dash')
@section('content')
<head>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <script type="text/javascript">
        $(function() {
            Highcharts.chart('chartjs', {
                data: {
                    table: 'datatable'
                },
                chart: {
                    type: 'line'
                },

                title: {
                    text: ''
                },

                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: 'BDT'
                    }
                },

                tooltip: {
                    formatter: function() {
                        return '<b>' + this.series.name + '</b><br/>' +
                            this.point.y + ' ' + this.point.name.toLowerCase();
                    }
                }
            });
        });
    </script>

</head>
<body>
<div class="container">
    <h2 class="text-center mt-4 mb-4">Ride Information</h2>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6">Ride History Report</div>
                <div class="col col-md-6 text-right">
                    <button type="button" id="export" class="btn btn-primary btn-sm">Download</button>
                </div>
            </div>
        </div>

    @php
       $i = 1;
    @endphp

        <div class="card-body">
           <div class="chart">
           <div id="chartjs" style="width: 100%; height: 400px;"> </div>
    <table id="datatable" hidden>
        <thead>
            <tr>
                <th></th>
                <th>Earnings</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rideHis as $ride)
            <tr>
                <th>{{"Cutomer".$i++}}</th>
                <td>{{$ride->cost}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

           </div>
        </div>
    </div>
</div>

<table id="rideData" hidden>
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Pickup Point</th>
              <th>Destination</th>
              <th>Distance</th>
              <th>Cost</th>
              <th>Pickup Time</th>
              <th>Arrival Time</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rideHis as $ride)
            <tr>
                <td>{{$ride->customerName}}</td>
                <td>{{$ride->pickupPoint}}</td>
                <td>{{$ride->destination}}</td>
                <td>{{$ride->length}} KM</td>
                <td>{{$ride->cost}} BDT</td>
                <td>{{$ride->riderStartingTie}}</td>
                <td>{{$ride->reachedTime}}</td>
            </tr>
            @endforeach

          </tbody>
</table>

</body>


<script>

    function html_table_to_excel(type)
    {
        var data = document.getElementById('rideData');

        var file = XLSX.utils.table_to_book(data, {sheet: "Report"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'Ride_Report.' + type);
    }

    const export_button = document.getElementById('export');

    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });

   $(document).ready(function(){
   window.setInterval(function(){
   $("#rideData").load(" #rideData > *");
   }, 1000);
   });

</script>

@endsection
