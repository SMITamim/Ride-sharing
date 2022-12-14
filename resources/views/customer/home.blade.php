@extends('customer.dashboard.dashboard')
@section('content')

<div class="container">

<h1 class="text-center mt-2 text-uppercase text-dark">Welcome, {{Session::get('name')}}</h1>

<div id="carouselExampleFade" class="carousel slide carousel-fade mt-3" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="http://unb.com.bd/filemanager/photos/64/uber.jpg" class="d-block w-100" alt="1st pic" height="480">
    </div>

    <div class="carousel-item">
      <img src="https://static.lightoj.com/images/problem-1446/ride-share-1613819543101.jpg?style=smallme,haveborder,rightme" class="d-block w-100" alt="..." width="480" height="480">
    </div>
    <div class="carousel-item">
      <img src="https://startup.info/wp-content/uploads/2020/03/uber-e1586256549247.jpg" class="d-block w-100" alt="..." width="480" height="480">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<h1 class="text-center mt-2 text-uppercase text-dark">How To request a rider</h1>

<div class = "my-2">


<div class="card" >
    <div class="card-body">
      <h5 class="card-title">Step 1</h5>
      <p class="card-text">Select your pickup location from this suggestion box</p>

    </div>
    <img src="../image/1stpic.png" class="d-block w-100" alt="set pickup point" height="480">
  </div>
</div>

<div class="card" >
    <div class="card-body">
      <h5 class="card-title">Step 2</h5>
      <p class="card-text">Same as step 1, select your destination location from this suggestion box</p>
    </div>
    <img src="../image/2ndpic.png" class="d-block w-100" alt="set pickup point" height="480">
  </div>
</div>


<div class="card" >
    <div class="card-body">
      <h5 class="card-title">Step 3</h5>
      <p class="card-text">If you select location from suggestion box it will green mark and if you didn't it will red mark and you can't request for a ride.</p>
    </div>
    <img src="../image/3rdpic.png" class="d-block w-100" alt="set pickup point" height="480">
  </div>
</div>

<div class="card" >
    <div class="card-body">
      <h5 class="card-title">Step 4</h5>
      <p class="card-text">After a successful request for ride you will get this message.</p>
    </div>
    <img src="../image/4thpic.png" class="d-block w-100" alt="set pickup point" height="480">
  </div>
</div>

<div class="card" >
    <div class="card-body">
      <h5 class="card-title">Step 5</h5>
      <p class="card-text">You can track your ride from there and enjoy your ride.</p>
    </div>
    <img src="../image/5thpic.png" class="d-block w-100" alt="set pickup point" height="480">
  </div>
</div>

</div>
</div>
@endsection