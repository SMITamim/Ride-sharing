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
</style>
</head>
<body>
<div class="container rounded bg-white mt-5 mb-5">
	<form action="{{route('riderPass')}}" method="post" name="form" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="row">

        <div class="col-md-7 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Password Settings</h4>
                </div>
                <div class="row mt-3">

    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-unlock-alt"></i> </span>
		 </div>
        <input name="password" class="form-control" placeholder="Enter Old Password" type="Password">
    </div>


	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-unlock-alt"></i> </span>
		 </div>
        <input name="npassword" class="form-control" placeholder="Enter New Password" type="Password">
    </div>

	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-unlock-alt"></i> </span>
		 </div>
        <input name="cnpassword" class="form-control" placeholder="Repeat New Password" type="Password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-block" value="Change Password">
    </div>
             </div>
            </div>
        </div>

        <div class="col-md-5 border-right align-self-center">
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
