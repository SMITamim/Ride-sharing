@extends('rider.layouts.dash')
@section('content')




<style>

.gradient-brand-color {
    background-image: -webkit-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
    background-image: -ms-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
    color: #fff;
}
.contact-info__wrapper {
    overflow: hidden;
    border-radius: .625rem .625rem 0 0
}

@media (min-width: 1024px) {
    .contact-info__wrapper {
        border-radius: 0 .625rem .625rem 0;
        padding: 5rem !important
    }
}
.contact-info__list span.position-absolute {
    left: 0
}
.z-index-101 {
    z-index: 101;
}
.list-style--none {
    list-style: none;
}
.contact__wrapper {
    background-color: #fff;
    border-radius: 0 0 .625rem .625rem
}

@media (min-width: 1024px) {
    .contact__wrapper {
        border-radius: .625rem 0 .625rem .625rem
    }
}
@media (min-width: 1024px) {
    .contact-form__wrapper {
        padding: 5rem !important
    }
}
.shadow-lg, .shadow-lg--on-hover:hover {
    box-shadow: 0 1rem 3rem rgba(132,138,163,0.1) !important;
}
.btn-gradientt {
    width:20%;
    position: relative;
    display: inline-block;
    left:-40px;
    background: rgba(0, 0, 0, 0.15);
    border-top-right-radius: 60px;
    border-top-left-radius: 60px;
    border-bottom-left-radius: 60px;
    padding: 8px 24px 8px 16px;
    box-shadow: 2px 0px 0px 0px rgba(78, 72, 72, 0.4);
    }
.btn-pink{
    border-radius: 50px;
    font-size:15px;
    padding:0px 20px;
    color: #fff;
    background-color: #f11350;
    border:none;
    justify-content: center;
    align-items: center;
    display: flex;
    width:400px;
    margin: auto;
}

</style>
</head>
<body>
@if(empty($ridez) && empty($ongoing))

<br><br>
          <button class="btn-pink d-flex justify-content-center" style="pointer-events: none">
             <span class="btn-gradientt">
             <i class="fa fa-exclamation-circle"></i>
             </span>
             <span class="btn-text">Currently No Ride Progress Available </span>
            </button>

@elseif(!empty($ridez) && empty($ongoing))

<div class="container">
    <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters">
            <div class="col-lg-5 contact-info__wrapper gradient-brand-color p-5 order-lg-2">
            <img src="https://www.uber-assets.com/image/upload/f_auto,q_auto:eco,c_fill,w_896,h_504/f_auto,q_auto/products/carousel/UberX.png"  width="400px" height="400px" alt="Responsive image">
                <figure class="figure position-absolute m-0 opacity-06 z-index-100" style="bottom:0; right: 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="444px" height="626px">
                        <defs>
                            <linearGradient id="PSgrad_1" x1="0%" x2="81.915%" y1="57.358%" y2="0%">
                                <stop offset="0%" stop-color="rgb(255,255,255)" stop-opacity="1"></stop>
                                <stop offset="100%" stop-color="rgb(0,54,207)" stop-opacity="0"></stop>
                            </linearGradient>

                        </defs>
                        <path fill-rule="evenodd" opacity="0.302" fill="rgb(72, 155, 248)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                        <path fill="url(#PSgrad_1)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                    </svg>
                </figure>
            </div>

            <div class="col-lg-7 contact-form__wrapper p-5 order-lg-1">

                    <div class="row">
                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="cname">Customer Name</label>
                                <input type="text" class="form-control" id="cname" name="cname" value="{{$ridez->customerName}}" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="phone">Customer Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"  value="{{$ridez->customerPhone}}" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="pickpoint">Pick-Up Point</label>
                                <input type="text" class="form-control" id="pickpoint" name="pickpoint"  value="{{$ridez->pickupPoint}}" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="destination">Final Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination" value="{{$ridez->destination}}" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="distance">Distance</label>
                                <input type="text" class="form-control" id="distance" name="distance" value="{{$ridez->length}} KM" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="rate">Rate</label>
                                <input type="text" class="form-control" id="rate" name="rate" value="{{$ridez->cost}} BDT" disabled>
                            </div>
                        </div>

                        <br><br><br><br><br>


                        @if(empty($start))

                        <form action="{{route('ridecmplt')}}" method="post" name="form" class="contact-form form-validate col-sm-6 mb-6">
                        {{csrf_field()}}
                        <input type="text" id="bal" name="bal" value="{{$ridez->cost-($ridez->cost*0.10)}}" hidden>
                        <input type="submit" hidden>  <button class="btn btn-success"> <i class="fa fa-check" aria-hidden="true"></i> Ride Complete</button>
                        </form>

                        @else

                        <form action="{{route('ridess')}}" method="post" name="form" class="contact-form form-validate col-sm-4 mb-6">
                        {{csrf_field()}}
                        <input type="submit" hidden> <button class="btn btn-success"> <i class="fa fa-check" aria-hidden="true"></i> Ride Start</button>
                        </form>

                        <form action="{{route('ridecnl')}}" method="post" name="form" class="contact-form form-validate col-sm-4 mb-6">
                        {{csrf_field()}}
                        <input type="submit" hidden>  <button class="btn btn-danger"> <i class="fa fa-times" aria-hidden="true"></i> Ride Cancel</button>
                        </form>

                        @endif

                    </div>

            </div>


        </div>
    </div>
</div>

@elseif(!empty($ongoing) && empty($ridez))

<div class="container">
    <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters">
            <div class="col-lg-5 contact-info__wrapper gradient-brand-color p-5 order-lg-2">
            <img src="https://www.uber-assets.com/image/upload/f_auto,q_auto:eco,c_fill,w_896,h_504/f_auto,q_auto/products/carousel/UberX.png"  width="400px" height="400px" alt="Responsive image">
                <figure class="figure position-absolute m-0 opacity-06 z-index-100" style="bottom:0; right: 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="444px" height="626px">
                        <defs>
                            <linearGradient id="PSgrad_1" x1="0%" x2="81.915%" y1="57.358%" y2="0%">
                                <stop offset="0%" stop-color="rgb(255,255,255)" stop-opacity="1"></stop>
                                <stop offset="100%" stop-color="rgb(0,54,207)" stop-opacity="0"></stop>
                            </linearGradient>

                        </defs>
                        <path fill-rule="evenodd" opacity="0.302" fill="rgb(72, 155, 248)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                        <path fill="url(#PSgrad_1)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                    </svg>
                </figure>
            </div>

            <div class="col-lg-7 contact-form__wrapper p-5 order-lg-1">

                    <div class="row">
                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="cname">Customer Name</label>
                                <input type="text" class="form-control" id="cname" name="cname" value="{{$ongoing->customerName}}" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="phone">Customer Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"  value="{{$ongoing->customerPhone}}" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="pickpoint">Pick-Up Point</label>
                                <input type="text" class="form-control" id="pickpoint" name="pickpoint"  value="{{$ongoing->pickupPoint}}" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="destination">Final Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination" value="{{$ongoing->destination}}" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="distance">Distance</label>
                                <input type="text" class="form-control" id="distance" name="distance" value="{{$ongoing->length}} KM" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="rate">Rate</label>
                                <input type="text" class="form-control" id="rate" name="rate" value="{{$ongoing->cost}} BDT" disabled>
                            </div>
                        </div>

                        <br><br><br><br><br>


                        @if(empty($start))

                        <form action="{{route('ridecmplt')}}" method="post" name="form" class="contact-form form-validate col-sm-6 mb-6">
                        {{csrf_field()}}
                        <input type="text" id="bal" name="bal" value="{{$ongoing->cost-($ongoing->cost*0.10)}}" hidden>
                        <input type="submit" hidden>  <button class="btn btn-success"> <i class="fa fa-check" aria-hidden="true"></i> Ride Complete</button>
                        </form>

                        @else

                        <form action="{{route('ridess')}}" method="post" name="form" class="contact-form form-validate col-sm-4 mb-6">
                        {{csrf_field()}}
                        <input type="submit" hidden> <button class="btn btn-success"> <i class="fa fa-check" aria-hidden="true"></i> Ride Start</button>
                        </form>

                        <form action="{{route('ridecnl')}}" method="post" name="form" class="contact-form form-validate col-sm-4 mb-6">
                        {{csrf_field()}}
                        <input type="submit" hidden>  <button class="btn btn-danger"> <i class="fa fa-times" aria-hidden="true"></i> Ride Cancel</button>
                        </form>

                        @endif

                    </div>

            </div>


        </div>
    </div>
</div

@endif



</body>


@endsection
