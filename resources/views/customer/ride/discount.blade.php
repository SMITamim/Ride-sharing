@extends('customer.dashboard.dashboard')
@section('content')

<style>
    p {
  color: #b3b3b3;
  font-weight: 300; }
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
.list-timeline {
  margin: 0;
  padding: 5px 0;
  position: relative
}
.list-timeline:before {
  width: 1px;
  background: #ccc;
  position: absolute;
  left: 6px;
  top: 0;
  bottom: 0;
  height: 100%;
  content: ''
}
.list-timeline .list-timeline-item {
  margin: 0;
  padding: 0;
  padding-left: 24px !important;
  position: relative
}
.list-timeline .list-timeline-item:before {
  width: 12px;
  height: 12px;
  background: #fff;
  border: 2px solid #ccc;
  position: absolute;
  left: 0;
  top: 4px;
  content: '';
  border-radius: 100%;
  -webkit-transition: all .3 ease-in-out;
  transition: all .3 ease-in-out
}
.list-timeline .list-timeline-item.active:before,
.list-timeline .list-timeline-item.show:before {
  background: #ccc
}
.list-timeline.list-timeline-light .list-timeline-item.active:before,
.list-timeline.list-timeline-light .list-timeline-item.show:before,
.list-timeline.list-timeline-light:before {
  background: #f8f9fa
}
.list-timeline .list-timeline-item.list-timeline-item-marker-middle:before {
  top: 50%;
  margin-top: -6px
}
.list-timeline.list-timeline-light .list-timeline-item:before {
  border-color: #f8f9fa
}
.list-timeline.list-timeline-grey .list-timeline-item.active:before,
.list-timeline.list-timeline-grey .list-timeline-item.show:before,
.list-timeline.list-timeline-grey:before {
  background: #e9ecef
}
.list-timeline.list-timeline-grey .list-timeline-item:before {
  border-color: #e9ecef
}
.list-timeline.list-timeline-grey-dark .list-timeline-item.active:before,
.list-timeline.list-timeline-grey-dark .list-timeline-item.show:before,
.list-timeline.list-timeline-grey-dark:before {
  background: #495057
}
.list-timeline.list-timeline-grey-dark .list-timeline-item:before {
  border-color: #495057
}
.in {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color: black;
  font-size: 16px;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  transition: .5s;
  letter-spacing: 4px
}
.in:hover {
  background: #ffeb2b;
  color: black;
  border-radius: 5px;
  box-shadow: 0 0 5px #ffeb2b,
              0 0 25px #ffeb2b,
              0 0 50px #ffeb2b,
              0 0 100px #ffeb2b;
}
</style>

<div class="container mt-3">
  <h2 class="d-flex justify-content-center"><u>Discount Claim</u></h2>
  @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                    </ul>
        </div>
     @endif
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



        <div class="col-md-4 col-xl-12">
           <div class="card bg-c-pink order-card cd">
                <div class="card-block">
                    <h6 class="m-b-20">User Point</h6>
                    <h2 class="text-right"><span class="f-left h1 fnt">{{$user->rating}} point</span><img src="https://www.svgrepo.com/show/89912/coin.svg" alt=""  class="f-right im"></h2>
                </div>

            </div>
        </div>

 <div class="table-responsive custom-table-responsive">


  <table class="table my-3 bg-light" style="text-align: center" id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Point</th>
        <th>Amount</th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>
    @foreach($discount as $discounts)


     <tr>

        <td>{{$discounts->id}}</td>


        <td>{{$discounts->point}}</td>


        <td>{{$discounts->amount}}</td>

        @if($user->rating >= $discounts->point)
        <td><a href="/customerDashboard/discountclaim/{{$discounts->id}}" class="btn btn-outline-primary"> <i class="bi bi-coin"></i> Claim</a></td>
        @else
        <td><button class="btn btn-outline-primary" disabled> <i class="bi bi-coin"></i> Claim</a></td>
        @endif

    </tr>
    @endforeach
    </tbody>
  </table>
  </div>


</div>








@endsection