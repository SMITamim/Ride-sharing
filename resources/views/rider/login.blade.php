@extends('rider.layouts.app')
@section('content')
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
    <link rel="stylesheet" href="{{asset('css/rlogin.css')}}">

</head>
<body>
<div class="container">
	<div class="screen">

		<div class="screen__content">
			<br><br>
			<h1 class="hl">Login</h1>
            <form action="{{route('riderLogin')}}" method="post" name="form">
                <div class="hq">
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
                </div>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" name="username" required="required"><span>Username</span>
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="password" required="required"><span>Password</span>
				</div>
				<input type="submit" class="button login__submit" value="Login">
					<i class="button__icon fas fa-chevron-right"></i>
				</input>
			</form>
			<div class="social-login">
				<br><br><br>
				<a href="{{route('riderRegistration')}}" ><h3>Sign-Up?</h3></a>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>
	</div>
</div>

</body>
