@extends('rider.layouts.dash')
@section('content')
<head>
<style>

.numberCircle {
    width: 150px;
    height: 150px;
    text-align: center;
    font-size: 21.6px;
    background: url(/img/dollar-coins.svg);
    background-repeat: no-repeat;
    background-size: auto;
    position: absolute;
    top: -60px;
    left: 50%;
    transform: translateX(-50%);
    }
.ccd{
    background-image: linear-gradient(to right, #ff9966, #ff5e62);
    box-shadow: 0 15px 25px rgba(0,0,0,.3);
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
  background: #03e9f4;
  color: black;
  border-radius: 5px;
  box-shadow: 0 0 5px #03e9f4,
              0 0 25px #03e9f4,
              0 0 50px #03e9f4,
              0 0 100px #03e9f4;
}

.in span {
  position: absolute;
  display: block;
}

.in span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #03e9f4);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }
  50%,100% {
    left: 100%;
  }
}

.in span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #03e9f4);
  animation: btn-anim2 1s linear infinite;
  animation-delay: .25s
}

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }
  50%,100% {
    top: 100%;
  }
}

.in span:nth-child(3) {
  bottom: 0;
  right: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(270deg, transparent, #03e9f4);
  animation: btn-anim3 1s linear infinite;
  animation-delay: .5s
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }
  50%,100% {
    right: 100%;
  }
}

.in span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #03e9f4);
  animation: btn-anim4 1s linear infinite;
  animation-delay: .75s
}

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }
  50%,100% {
    bottom: 100%;
  }
}

.input-hidden {
  position: absolute;
  left: -9999px;
}

input[type=radio]:checked + label>img {

}

/* Stuff after this is only to make things more pretty */
input[type=radio] + label>img {

  width: 80px;
  height: 80px;
  transition: 500ms all;
  border-radius: 100px;
}

input[type=radio]:checked + label>img {
  transform:
    rotateZ(-390deg)
    rotateX(10deg);
}

</style>
</head>
<body>














<div class="container">

<div class="card ccd" style="max-width: 600px; margin: auto; border-radius: 30px;">
<article class="card-body mx-auto" style="max-width: 400px;">
<div class="numberCircle"></div>
	<br>

	<form action="{{route('cashout')}}" method="post" name="form" enctype="multipart/form-data">

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
                </div>

	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-money"></i> </span>
		 </div>
         <input type="text" name="amount" placeholder="Enter Amount" class="form-control">
    </div>
    <br>


         <h6 for="pmethod">Payment Method:</h5>


        <input type="radio" name="payment" id="bkash" value="bkash" class="input-hidden" />
        <label for="bkash">
        <img src="https://www.logo.wine/a/logo/BKash/BKash-bKash-Logo.wine.svg" />
        </label>
        <input type="radio" name="payment" id="nagad" value="nagad" class="input-hidden" />
        <label for="nagad">
        <img src="https://www.logo.wine/a/logo/Nagad/Nagad-Vertical-Logo.wine.svg" />
        </label>
        <input type="radio" name="payment" id="paytm" value="paytm" class="input-hidden" />
        <label for="paytm">
        <img src="https://www.logo.wine/a/logo/Paytm/Paytm-Logo.wine.svg" />
        </label>
        <br>


    <div id="phn" style="display: none;">
    <div class="form-group input-group" >
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-mobile"></i> </span>
		 </div>
         <input type="tel" name="phone" id="phone" placeholder="Enter Banking Number" class="form-control">
         <br>
    </div>
    </div>
    <br><br>

    <div class="form-group">
         <input type="submit" class="in container" value="Request">
    </div>

</form>
</article>
</div>
</div>






</body>
<script>
document.getElementById("bkash").onclick = function() {
document.getElementById("phn").style.display = "block";
}
document.getElementById("nagad").onclick = function() {
document.getElementById("phn").style.display = "block";
}
document.getElementById("paytm").onclick = function() {
document.getElementById("phn").style.display = "block";
}
</script>

@endsection

