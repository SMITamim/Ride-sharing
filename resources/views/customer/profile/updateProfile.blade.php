@extends('customer.dashboard.dashboard')
@section('content')
<link rel="stylesheet" href="{{asset('css/customer/updateProfile.css')}}">
<div class="container rounded bg-light shadow mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
     <div class="d-flex flex-column align-items-center text-center p-3 py-5">
        <img class="rounded-circle mt-5" width="150px" src="../customer_image/{{Session::get('image')}}">
        <span class="font-weight-bold"> ID: {{Session::get('id')}}</span>
        <span class="text-black-50"> Point: {{$user->rating}} point</span>


        <span> </span>
    </div>
        </div>
        <div class="col-md-5 border-right">
            <form action="{{route('customerEdit')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
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
                <div class="row">
                    <div class="col-md-12">
                        <label class="labels">Name</label>
                        <input type="text" class="form-control" placeholder="Full Name" name="name" id="name" value="{{Session::get('name')}}">

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="labels">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" id="dob" value="{{Session::get('dob')}}">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Phone number</label>
                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="enter 11 digit number" value="{{Session::get('phone')}}">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Address</label>
                        <input type="tel" class="form-control" name="address" id="address" placeholder="Address" value="{{Session::get('address')}}">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="someone@gmail.com" value="{{Session::get('email')}}">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Change Picture(if needed)</label>
                        <input type="file" class="form-control" name="image" id="image" value="{{Session::get('email')}}">
                    </div>

                </div>
                <div class="mt-5 text-center">
                    <input class="btn btn-outline-success" type="submit" value = "Update Profile"></input>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>
</div>
</div>
@endsection