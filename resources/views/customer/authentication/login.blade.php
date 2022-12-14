<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="{{asset('js/customer/login.js')}}"></script>

<link rel="stylesheet" href="{{asset('css/customer/login.css')}}">


	</head>
	<body>
	<div class="ftco-section">
		<div class="container">

			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
					<div class="img" style="background-image: url(../image/rideShare.jpg); background-repeat: no-repeat; background-size: contain;">

			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
                        <!--
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>-->
			      	</div>
							<form action="{{route('customerLoginSubmit')}}" class="signin-form" method="post" name="form" onsubmit="return valid();">
                            {{csrf_field()}}
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">

                                     <ul>
                                         @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                </div>
                         @endif

                         @if (\Session::has('failed'))
                         <div class="alert alert-danger alert-dismissible">
                        {!! \Session::get('failed') !!}
                        </div>
                        @endif

			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" class="form-control" name="username" id="username" value="{{old('username')}}" placeholder="Username">
                            <span class="validation" name= "userNameError" id="userNameError"></span>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>

		              <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="Password">
                      <span class="validation" name="passwordError" id="passwordError"></span>

		            </div>
		            <div class="form-group">
		            	<input type="submit" class="form-control btn btn-primary rounded submit px-3" value="Sign In">

		            </div>

		          </form>
		          <p class="text-center">Not a member? <a data-toggle="tab" href="{{route('customerRegistration')}}">Sign Up</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>

</div>



	</body>
</html>