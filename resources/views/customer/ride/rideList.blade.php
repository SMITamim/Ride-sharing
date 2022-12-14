@extends('customer.dashboard.dashboard')
@section('content')


<div class="container mt-3">
  <h2 class="d-flex justify-content-center"><u>Your Ride History</u></h2>
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

                        @if($rideList->count()>0)
    <button type="button" id="export" class="btn btn-outline-success" id="export">Download</button>

 <div class="table-responsive custom-table-responsive">


  <table class="table my-3 bg-light" style="text-align: center" id="myTable">
    <thead>
      <tr>
        <th>Ride ID</th>
        <th>Rider Name</th>
        <th>Rider Phone Number</th>
        <th>Pickup Point</th>
        <th>Destination</th>
        <th>Total Distance</th>
        <th>Bill</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>

    @foreach($rideList as $ride)


     <tr>

        <td>{{$ride->id}}</td>

        @if(empty($ride->riderName))
        <td>---</td>
        @else
        <td>{{$ride->riderName}}</td>
        @endif
        @if(empty($ride->riderName))
        <td>---</td>
        @else
        <td>{{$ride->riderPhone}}</td>
        @endif
        <td>{{$ride->pickupPoint}}</td>
        <td>{{$ride->destination}}</td>
        <td>{{$ride->length}} kilo</td>
        <td>{{$ride->cost}} BDT</td>
        @if($ride->customerStatus === "Waiting for rider...")
        <td ><span class="badge bg-warning text-dark me-2 cancel-btn">Wait for rider</span></td>

        @endif
        @if($ride->customerStatus === "Ride complete")
        <td ><span class="badge bg-success">{{$ride->customerStatus}}</span></td>
        @endif
        @if($ride->customerStatus === "Cancel")
        <td ><span class="badge bg-danger">Ride Cancel</span></td>
        @endif
        @if($ride->customerStatus === "Approve")
        <td ><span class="badge bg-info text-dark">Rider Approve</span> </td>

        @endif
        @if($ride->customerStatus === "ongoing")
        <td ><span class="badge bg-primary">Ride Ongoing</span></td>

        @endif

        @if($ride->customerStatus === "Waiting for rider..." )
        <td><a class="btn btn-danger text-white" id="cancel-ride" href="javascript:void(0)" data-url="{{ route('rideView', $ride->id) }}"><i class="bi bi-x-circle-fill"></i> Cancel Ride</a></td>
        @endif
        @if($ride->customerStatus === "Ride complete")
        <td> <a href="javascript:void(0)" class="btn btn-primary"  id="viewRide" data-url="{{ route('rideView', $ride->id) }}"><i class="bi bi-eye me-2 text-white"></i>View Details</a></td>
        @endif
        @if($ride->customerStatus === "Cancel")
        <td> <p class="text-danger"> Ride Cancel at <strong>{{$ride->cancelTime}}</strong></p></td>
        @endif
        @if($ride->customerStatus === "Approve")
        <td><a href="/chat/{{$ride->id}}" class = "btn btn-info "><i class="bi bi-chat-dots me-1 text-dark"></i>Chat</a> <a class="btn btn-danger text-white" id="cancel-ride" href="javascript:void(0)" data-url="{{ route('rideView', $ride->id) }}"> <i class="bi bi-x-circle-fill"></i> Cancel Ride </a></td>
        @endif

    </tr>
    @endforeach
    </tbody>

  </table>
  <div class="pagination justify-content-center">
{{$rideList->links()}}
  </div>
  @else
    <h1 class="text-danger d-flex justify-content-center m-5">You have not complete any ride</h1>
    @endif
  </div>

</div>




<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger">Ride Cancel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('rideCancelSubmit')}}" class="form-group" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <input type="hidden" id="ride-id" name="rideid">
        <span class="text-dark">Are you sure to cancel your ride From </span><span class="text-dark" id="ride-pick"></span><span class="text-dark"> To </span><span class="text-dark" id="ride-destination"></span>

      </div>
      <div class="modal-footer">
      <input type="submit" class="btn btn-danger" id="yes" value="Yes">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-primary">Ride Information</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('rideReview')}}" class="form-group" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" id="rideId" name="rideid">
        <hr>
        <h4 class="d-flex justify-content-center">Rider Information</h4> <hr>
        <div class="text-center">
         <p>Rider Name: <span class="riderName"></span></p>
         <p>Rider Phone Number: <span class="riderPhone"></span></p>
        </div>
        <hr>
        <h4 class="d-flex justify-content-center">Ride Information</h4> <hr>
        <div class="row text-center">
        <div class="col">
        <p>Pick Point: <span class="pickPoint"></span></p>
        <p>Destination: <span class="destination"></span></p>
        <p>Total Distance: <span class="distance"></span> Kilo</p>
        <p>Cost: <span class="cost"></span> TK</p>
        </div>
        <div class="col">
        <p>Ride Request Time: <span class="rideReqTime"></span></p>
        <p>Rider Approval Time: <span class="riderAppTime"></span></p>
        <p>Departure Time: <span class="depTime"></span></p>
        <p>Arrival Time:  <span class="arrTime"></span></p>

        </div>
        </div>

        <hr>

        <textarea class="form-control border border-primary" id="msg" name = "msg" rows="3" placeholder="Please type your review message"></textarea>
        <input type="submit" class="btn btn-outline-primary mt-2 text-center" id="review" value="Submit your review">
        <hr>
    </form>
      </div>

  </div>
</div>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>


<script type="text/javascript">
//-----------cancel ride---------------
    $(document).ready(function () {
        $('body').on('click', '#cancel-ride', function () {
          var userURL = $(this).data('url');
          $.get(userURL, function (data) {
              $('#cancelModal').modal('show');
              $('#ride-id').val(data.id);
              $('#ride-pick').text(data.pickupPoint);
              $('#ride-destination').text(data.destination);
          })
       });
    });
    //-----------View Ride---------------
    $(document).ready(function () {
$('body').on('click', '#viewRide', function () {
  var userURL = $(this).data('url');
  $.get(userURL, function (data) {
      $('#detailsModal').modal('show');
      $('#rideId').val(data.id);
      $('.riderName').text(data.riderName);
      $('.riderPhone').text(data.riderPhone);
      $('.pickPoint').text(data.pickupPoint);
      $('.destination').text(data.destination);
      $('.distance').text(data.length);
      $('.cost').text(data.cost );
      $('.rideReqTime').text(data.rideRequestTime);
      $('.riderAppTime').text(data.riderApprovalTime);
      $('.depTime').text(data.riderStartingTime);
      $('.arrTime').text(data.reachedTime);
  })
});
});
//----------Excel Convertion--------
function html_table_to_excel(type)
    {
        var data = document.getElementById('myTable');
        var file = XLSX.utils.table_to_book(data, {sheet: "Report"});
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
        XLSX.writeFile(file, 'Ride_Report.' + type);
    }
const export_button = document.getElementById('export');
    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });
    //-----Auto Reload-----
   $(document).ready(function(){
   window.setInterval(function(){
   $("#myTable").load(" #myTable > *");
   }, 3000);
   });
</script>
@endsection