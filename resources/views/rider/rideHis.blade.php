@extends('rider.layouts.dash')
@section('content')

<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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


</style>
</head>
<body>


          <h2 class="d-flex justify-content-center text-secondary">Your Ride History</h2>

            <br> <br>

      <div class="table-responsive custom-table-responsive">

        <table class="table custom-table" id="here">
          <thead>
            <tr>

              <th scope="col">
                <label class="control control--checkbox">
                  <div class="control__indicator"></div>
                </label>
              </th>
              <th scope="col">Customer Name</th>
              <th scope="col">Pickup Point</th>
              <th scope="col">Destination</th>
              <th scope="col">Distance</th>
              <th scope="col">Cost</th>
              <th scope="col">Pickup Time</th>
              <th scope="col">Arrival Time</th>
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
                <td class="text-primary">{{$ride->customerName}}</td>
                <td>{{$ride->pickupPoint}}</td>
                <td>{{$ride->destination}}</td>
                <td>{{$ride->length}} KM</td>
                <td>{{$ride->cost}} BDT</td>
                <td>{{$ride->riderStartingTie}}</td>
                <td>{{$ride->reachedTime}}</td>
            </tr>
            <tr class="spacer"><td colspan="100"></td></tr>
            @endforeach

          </tbody>
        </table>

  </div>

  </body>

  <script>
   $(document).ready(function(){
   window.setInterval(function(){
   $("#here").load(" #here > *");
   }, 1000);
   });
</script>

@endsection
