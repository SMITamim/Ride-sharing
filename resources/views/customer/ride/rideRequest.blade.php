@extends('customer.dashboard.dashboard')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function pickup(str){
        let key = false;
    @foreach($locations as $location)
    if(str === "{{$location->location}}"){
        key = true
    }
    @endforeach
    if(key===true){
        document.getElementById("pickLocation").style.border="2px solid green"
        document.getElementById("myBtn").disabled = false;
        //console.log("yes")
        //document.getElementByClass("container-fluid").style.background-color = "red"
    }
    else{
        //console.log("no")
        document.getElementById("pickLocation").style.border="2px solid red"
        document.getElementById("myBtn").disabled = true;
    }
    return key
    }
    function destination(str){
        let key = false;
    @foreach($locations as $location)
    if(str === "{{$location->location}}"){
        key = true
    }
    @endforeach
    if(key===true){
        document.getElementById("dropLocation").style.border="2px solid green"
        document.getElementById("myBtn").disabled = false;
       // console.log("yes")
        //document.getElementByClass("container-fluid").style.background-color = "red"
    }
    else{
        //console.log("no")
        document.getElementById("dropLocation").style.border="2px solid red"
        document.getElementById("myBtn").disabled = true;
        //
    }
    }
    function valid() {
	// body...
	var pickLocation = document.forms["form"]["pickLocation"].value;
	var dropLocation = document.forms["form"]["dropLocation"].value;
	var flag = true;
    if(pickLocation===""){
    	document.getElementById('pickError').innerHTML="Pickup location required";
    	flag = false;
    }
    else{
        document.getElementById('pickError').innerHTML="";
    }
     if(dropLocation===""){
    	document.getElementById('destinationError').innerHTML="drop location required";
    	flag = false;
    }
    else{
        document.getElementById('destinationError').innerHTML="";
    }
}
</script>
<div class="container-fluid">
  <!-- map setting -->
  <div id="map-container-google-3" class="z-depth-1-half map-container-3">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d467336.5485682298!2d90.41932600000001!3d23.780636!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1655535972265!5m2!1sen!2sbd" width=100% height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


    <!-- Form -->

    <div class="rounded d-flex justify-content-center">
            <div class="col-md-5 col-sm-6 shadow-lg bg-white my-4">
                <div class="text-center col-sm-12 mt-2">
                    <h3 id="hijibi">Request for a ride</h3>
                </div>
        <form action="{{route('rideRequestSubmit')}}" class="form-group" method="post" name="form" enctype="multipart/form-data" onsubmit="return valid();">
                {{csrf_field()}}
            <div class="p-4">


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
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                            <li>{!! \Session::get('destination') !!}</li>
                            <li>{!! \Session::get('price') !!}</li>

                        </ul>
                        </div>
                        @endif

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-success"><i
                                class="bi bi-pin-map-fill text-white"></i>
                            </span>
                            <input class="form-control pickLocation" list="datalistOptions" name="pickLocation" id="pickLocation" placeholder="Choose Pickup point" onchange="pickup(this.value)">
                            <datalist id="datalistOptions">
                            @foreach($locations as $location)
                                <option value="{{$location->location}}">
                                @endforeach
                            </datalist>

                            <span class="text-danger ms-2" id="pickError"></span>

                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-success"><i
                                class="bi bi-geo-alt-fill text-white"></i>
                            </span>
                            <input class="form-control droplocation" list="datalistOptions" name="dropLocation" id="dropLocation" placeholder="Choose Pickup point" onchange="destination(this.value)">

                            <datalist id="datalistOptions">
                            @foreach($locations as $location)
                                <option value="{{$location->location}}">
                                @endforeach
                            </datalist>

                            <span class="text-danger ms-2" id="destinationError"></span>

                        </div>



                        <div class="mt-2 text-center">

                        <input class="btn btn-outline-success" id="myBtn" type="submit" value = "Confirm Request" disabled>
                        </div>

                </div>
        </form>
            </div>
    </div>


</div>

<!-- confirm modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    </script>



@endsection