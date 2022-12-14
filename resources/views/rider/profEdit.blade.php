@extends('rider.layouts.dash')
@section('content')
<head>
<style>
body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8;

}
.upload-btns-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
  cursor: pointer;
}

.btns {
  border: 2px solid gray;
  color: gray;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 10px;
  font-weight: bold;
  cursor: pointer;
}

.upload-btns-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  cursor: pointer;
}
</style>
</head>
<body>
<div class="container rounded bg-white mt-5 mb-5">
	<form action="{{route('riderProf')}}" method="post" name="form" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="row">

        <div class="col-md-3 border-right align-self-center">

            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5 shadow p-2 mb-5 bg-white rounded" width="150px" src="img/{{Session::get('image')}}">
            <div class="upload-btns-wrapper"> <br>
            <button class="btns">Update Picture</button>
            <input type="file" id="formFile" name="image" id="image" value="{{Session::get('image')}}">
            </div>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-3">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input type="text" name="fname" class="form-control" placeholder="Full name" value="{{Session::get('name')}}">
    </div>


    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-venus-mars"></i> </span>
		 </div>
            <select class="custom-select" name="gender" value="{{Session::get('gender')}}">
		    <option selected="{{Session::get('gender')}}">{{Session::get('gender')}}</option>
		    <option value="Male">Male</option>
		    <option value="Female">Female</option>
		    <option value="Others">Others</option>
		</select>
    </div>


    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
		 </div>
        <input type="date" name="dob" class="form-control" placeholder="Full name" value="{{Session::get('dob')}}">
    </div>


    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-map-marker"></i> </span>
		 </div>
        <textarea name="peraddress" class="form-control" placeholder="Permanent address">{{Session::get('peraddress')}}</textarea>
    </div>

    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-map-marker"></i> </span>
		 </div>
        <textarea name="preaddress" class="form-control" placeholder="Present address">{{Session::get('preaddress')}}</textarea>
    </div>


    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
    	<input name="phone" class="form-control" placeholder="Phone number" type="text" value="{{Session::get('phone')}}">
    </div>


    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" type="email" value="{{Session::get('email')}}">
    </div>


	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-id-card"></i> </span>
		 </div>
        <input name="nid" class="form-control" placeholder="NID no." type="text" value="{{Session::get('nid')}}">
    </div>

	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-id-card"></i> </span>
		 </div>
        <input name="dlic" class="form-control" placeholder="Driving license no." type="text" value="{{Session::get('dlic')}}">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-block" value="Update Account">
    </div>
             </div>
            </div>
        </div>

        <div class="col-md-4 border-right align-self-center">
                      <div class="p-3 py-5">
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
                    </div>
        </div>

    </div>
</form>
</div>
</body>
@endsection
