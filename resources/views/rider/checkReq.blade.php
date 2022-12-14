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



    .btn-gradient {
    width:40%;
    position: relative;
    display: inline-block;
    left:-15px;
    background: rgba(0, 0, 0, 0.15);
    border-top-right-radius: 60px;
    border-top-left-radius: 60px;
    border-bottom-left-radius: 60px;
    padding: 8px 24px 8px 16px;
    box-shadow: 2px 0px 0px 0px rgba(78, 72, 72, 0.4);
    }

.btn-green{
    font-size:18px;
    padding:0px 20px;
    color: #fff;
    background-color: #47a447;
    border:none;
    justify-content: center;
    align-items: center;
    display: flex;
    width:140px;
    border-radius: 50px;
}
.btn-gradientt {
    width:20%;
    position: relative;
    display: inline-block;
    left:-60px;
    background: rgba(0, 0, 0, 0.15);
    border-top-right-radius: 60px;
    border-top-left-radius: 60px;
    border-bottom-left-radius: 60px;
    padding: 8px 24px 8px 16px;
    box-shadow: 2px 0px 0px 0px rgba(78, 72, 72, 0.4);
    }
.btn-pink{
    border-radius: 50px;
    font-size:15px;
    padding:0px 20px;
    color: #fff;
    background-color: #f11350;
    border:none;
    justify-content: center;
    align-items: center;
    display: flex;
    width:400px;
    margin: auto;
}


</style>
</head>
<body>


          <h2 class="d-flex justify-content-center text-secondary">Available Ride Request</h2>

                        @if (\Session::has('failed'))
                         <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {!! \Session::get('failed') !!}
                        </div>
                        @endif

                        @if (\Session::has('success'))
                         <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {!! \Session::get('success') !!}
                        </div>
                        @endif

            <br> <br>
            @if(empty($ridez) && empty($ongo))

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
              <th scope="col">Action</th>
            </tr>
          </thead>


          <tbody>

            @foreach($rideCol as $ride)
            <form action="{{route('checkReq')}}" method="post" name="form" enctype="multipart/form-data">
            {{csrf_field()}}
            <tr scope="row">
              <th scope="row">
                <label class="control control--checkbox">
                  <div class="control__indicator"></div>
                </label>
              </th>
                <input name="id" type="text" value="{{$ride->id}}" hidden>
                <td class="text-primary">{{$ride->customerName}}</td>
                <td>{{$ride->pickupPoint}}</td>
                <td>{{$ride->destination}}</td>
                <td class="text-success">{{$ride->length}} KM</td>
                <td class="text-success">{{$ride->cost}} BDT</td>
                <td><input type="submit" hidden> <button class="btn-green">
                    <span class="btn-gradient">
                    <i class="fa fa-check"></i>
                    </span>
                    <span class="btn-text">Approve</span>
                    </a></td>
            </tr>
            <tr class="spacer"><td colspan="100"></td></tr>
            </form>
            @endforeach
          </tbody>


        </table>


  </div>
          @else
          <br><br>
          <button class="btn-pink d-flex justify-content-center" style="pointer-events: none">
             <span class="btn-gradientt">
             <i class="fa fa-exclamation-circle"></i>
             </span>
             <span class="btn-text">Complete your incomplete ride</span>
            </button>

          @endif
  </body>

  <script>
   $(document).ready(function(){
   window.setInterval(function(){
   $("#here").load(" #here > *");
   }, 30000);
   });
</script>

@endsection
