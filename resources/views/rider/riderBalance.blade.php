@extends('rider.layouts.dash')
@section('content')




<style>

body {
  font-family: "Roboto", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  background-color: #efefef;
  font-weight: 300; }

p {
  color: #b3b3b3;
  font-weight: 300; }

h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  font-family: "Roboto", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; }

a {
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease; }
  a, a:hover {
    text-decoration: none !important; }

.content {
  padding: 7rem 0; }

.custom-table {
  min-width: 900px; }
  .custom-table thead tr, .custom-table thead th {
    border-top: none;
    border-bottom: none !important; }
  .custom-table tbody th, .custom-table tbody td {
    color: #777;
    font-weight: 400;
    padding-bottom: 20px;
    padding-top: 20px;
    font-weight: 300; }
    .custom-table tbody th small, .custom-table tbody td small {
      color: #b3b3b3;
      font-weight: 300; }
  .custom-table tbody tr:not(.spacer) {
    border-radius: 7px;
    overflow: hidden;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease; }
    .custom-table tbody tr:not(.spacer):hover {
      -webkit-box-shadow: 0 2px 10px -5px rgba(0, 0, 0, 0.1);
      box-shadow: 0 2px 10px -5px rgba(0, 0, 0, 0.1); }
  .custom-table tbody tr th, .custom-table tbody tr td {
    background: #fff;
    border: none; }
    .custom-table tbody tr th:first-child, .custom-table tbody tr td:first-child {
      border-top-left-radius: 7px;
      border-bottom-left-radius: 7px; }
    .custom-table tbody tr th:last-child, .custom-table tbody tr td:last-child {
      border-top-right-radius: 7px;
      border-bottom-right-radius: 7px; }
  .custom-table tbody tr.spacer td {
    padding: 0 !important;
    height: 10px;
    border-radius: 0 !important;
    background: transparent !important; }

    .heading {
    text-transform: uppercase;
    position: relative;
}

.heading h1 {
  text-align: center;
  overflow: hidden;
  color: black;
  white-space: nowrap;
  text-overflow: ellipsis;
  font: 30px/32px 'Roboto', sans-serif;

  background: url(../images/border.png) no-repeat center;
}
.heading h1:before,
.heading h1:after {
  content: '';
  width: 100%;
  display: inline-block;
  border-bottom: 1px solid;
  height: 0;
  vertical-align: middle;
}
.heading h1:before {
  margin-left: -100%;
  margin-right: 80px;
}
.heading h1:after {
  margin-left: 80px;
  margin-right: -100%;
}



.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.cd {
    margin-bottom: 30px;
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
.im{
    width: 100px;
    height: auto;
}
.fnt{
    padding-top: 10px;
    font-size: 55px;
}
.ic{
    padding-top: 10px;
}
</style>
</head>
<body>


    @php
       $i = 1;
        $total = 0;
        $count = $rideCount;

    @endphp
        @foreach($rideHis as $ride)
            @php
                $total += $ride->cost;
            @endphp
        @endforeach

<div class="row">
        <div class="col-md-4 col-xl-12">
            <div class="card bg-c-yellow order-card cd">
                <div class="card-block">
                    <h6 class="m-b-20">Balance</h6>
                    <h2 class="text-right"><span class="f-left h1 fnt">{{$rider->balance}} BDT</span><img src="https://isometric.online/wp-content/uploads/2019/08/Money_SVG.svg" alt=""  class="f-right im"></h2>
                </div>
            </div>
        </div>

	</div>

<div class="row">
        <div class="col-md-4 col-xl-6">
            <div class="card bg-c-green order-card cd">
                <div class="card-block">
                    <h6 class="m-b-20">Total Earning</h6>
                    <h2 class="text-right"><i class="fa fa-money f-left ic"></i><span>{{$total}} BDT</span></h2>
                    <h6 class="m-b-0 text-info">Completed Rides<span class="f-right">{{$count}}</span></h6>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-6">
            <div class="card bg-c-pink order-card cd">
                <div class="card-block">
                    <h6 class="m-b-20">Company's Revenue</h6>
                    <h2 class="text-right"><i class="fa fa-money f-left ic"></i><span>{{$total*0.10}} BDT</span></h2>
                    <br>
                </div>
            </div>
        </div>

	</div>

    <br><br><br>
            <div class="heading">
                <h1>Income Information</h1>
            </div>

            <br> <br>

      <div class="table-responsive custom-table-responsive">

        <table class="table custom-table">
          <thead>
            <tr>

              <th scope="col">
                <label class="control control--checkbox">
                  <div class="control__indicator"></div>
                </label>
              </th>
              <th scope="col">Rides</th>
              <th scope="col">Distance</th>
              <th scope="col">Cost</th>
            </tr>
          </thead>
          <tbody>

            @foreach($rideHis as $ride)
            <tr scope="row">
              <th scope="row">
                <label class="control control--checkbox">
                  <div class="control__indicator"></div>
                </label>
              </th>
                <td>{{$i++}}</td>
                <td>{{$ride->length}} KM</td>
                <td>{{$ride->cost}} BDT</td>
            </tr>
            <tr class="spacer"><td colspan="100"></td></tr>
            @endforeach

          </tbody>
        </table>
  </div>
  </body>


@endsection
