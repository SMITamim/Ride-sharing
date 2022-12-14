@extends('customer.dashboard.dashboard')
@section('content')
<script src="{{asset('js/customer/cpass.js')}}"></script>
<form action="{{route('passwordChangingRequest')}}" class="mb-5" method="post" name="form" onsubmit="return valid();">
{{csrf_field()}}
<section class="vh-100 gradient-custom ">
  <div class="container py-5 h-100 ">
    <div class="row d-flex justify-content-center align-items-center h-100 ">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5 ">
        <div class="card bg-dark text-white " style="border-radius: 1rem;">
          <div class="card-body p-5 text-center ">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Changing Password</h2>

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
                        {!! \Session::get('success') !!}
                        </div>
                        @endif


              <div class="form-outline form-white mb-4">
                <input type="password" id="cpass" name="cpass" class="form-control form-control-lg" />
                <label class="form-label" for="cpass">Current Password</label> <br>
                <span class="text-danger" id="cpassError"></span>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="npass" name="npass" class="form-control form-control-lg" />
                <label class="form-label" for="npass">New Password</label><br>
                <span class="text-danger" id="npassError"></span>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="rpass" name="rpass" class="form-control form-control-lg" />
                <label class="form-label" for="rpass">Retype new password</label><br>
                <span class="text-danger" id="rpassError"></span>
              </div>


              <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Update Password">


            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>

@endsection
