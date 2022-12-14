@extends('rider.layouts.dash')
@section('content')

<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1 {font-family: "Montserrat", sans-serif}
img {margin-bottom: -7px}
.w3-row-padding img {margin-bottom: 12px}
</style>
</head>
<body>
<div class="w3-content" style="max-width:1500px">
<h2 class="w3-wide text-center">About us</h2>
<br>
    <p class="w3-justify">Movement is what we power. It’s our lifeblood. It runs through our veins. It’s what gets us out of bed each morning. It pushes us to constantly reimagine how we can move better. For you. For all the places you want to go. For all the things you want to get. For all the ways you want to earn. Across the entire world. In real time. At the incredible speed of now.. Your ride is committing to becoming a fully electric, zero-emission platform by 2040, with 100% of rides taking place in zero-emission vehicles, on public transit, or with micromobility. It is our responsibility as the largest mobility platform in the world to more aggressively tackle the challenge of climate change. We will do this by offering riders more ways to ride green, helping drivers go electric, making transparency a priority and partnering with NGOs and the private sector to help expedite a clean and just energy transition.</p>
    <br>
<!-- Header -->
<div class="w3-opacity">
<div class="w3-clear"></div>
<header class="w3-center w3-margin-bottom">
  <p class="w3-padding-16"><button class="w3-button w3-black" onclick="myFunction()">Toggle Grid Padding</button></p>
</header>
</div>

<!-- Photo Grid -->
<div class="w3-row" id="myGrid" style="margin-bottom:128px">
  <div class="w3-third">
    <img src="https://cdn.pastemagazine.com/www/articles/uber%20safeher.jpg" style="width:100%">
    <img src="https://prod-media-eng.dhakatribune.com/uploads/2020/06/ride-sharing-obhai-zakir-1592750284918.jpg" style="width:100%">
    <img src="https://www.tripsavvy.com/thmb/rIHw29ll5F95RZs09hwnXt8IcZM=/2121x1414/filters:fill(auto,1)/GettyImages-1050146084-1f58e25cdab445b996e5896ee6e4cbe0.jpg" style="width:100%">
    <img src="https://cdn.motor1.com/images/mgl/EM7GB/s3/van-driver-texting-with-phone-while-driving.jpg" style="width:100%">
    <img src="https://www.netsolutions.com/insights/wp-content/uploads/2019/07/essential-features-for-building-a-ride-sharing-app.jpg" style="width:100%">
    <img src="https://i.guim.co.uk/img/media/249e1da420260b3b87d0118cfe8ef4db2825e7d9/0_95_4918_2951/master/4918.jpg?width=465&quality=45&auto=format&fit=max&dpr=2&s=39d01aeb8d560c3c7bed5190ec679aa9" style="width:100%">
  </div>

  <div class="w3-third">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRk0bmSLMPGUstH-t1iSP76WojQ-MwdxPdn7GHiANQpjan_uv77Fi46DH6hhb0f2a2W0qs&usqp=CAU" style="width:100%">
    <img src="https://www.statefarm.com/content/dam/sf-library/en-us/secure/legacy/simple-insights/safety-tips-for-uber-and-lyft-wide.jpg" style="width:100%">
    <img src="https://www.autoguide.com/blog/wp-content/uploads/2019/05/how-to-become-a-rideshare-driver.jpg" style="width:100%">
    <img src="https://s3.amazonaws.com/mobileappdaily/mad/uploads/img_best_ride_sharing_apps.png" style="width:100%">
    <img src="https://www.bobology.com/members/images/471.jpg" style="width:100%">
    <img src="https://codeit.us/storage/LW0GiX0PV7DRuMmW8x0SE0CLFq3nIfOEhoOhcgJ6.png" style="width:100%">
  </div>

  <div class="w3-third">
  <img src="https://cdn.pastemagazine.com/www/articles/uber%20safeher.jpg" style="width:100%">
    <img src="https://prod-media-eng.dhakatribune.com/uploads/2020/06/ride-sharing-obhai-zakir-1592750284918.jpg" style="width:100%">
    <img src="https://www.tripsavvy.com/thmb/rIHw29ll5F95RZs09hwnXt8IcZM=/2121x1414/filters:fill(auto,1)/GettyImages-1050146084-1f58e25cdab445b996e5896ee6e4cbe0.jpg" style="width:100%">
    <img src="https://cdn.motor1.com/images/mgl/EM7GB/s3/van-driver-texting-with-phone-while-driving.jpg" style="width:100%">
    <img src="https://www.netsolutions.com/insights/wp-content/uploads/2019/07/essential-features-for-building-a-ride-sharing-app.jpg" style="width:100%">
    <img src="https://i.guim.co.uk/img/media/249e1da420260b3b87d0118cfe8ef4db2825e7d9/0_95_4918_2951/master/4918.jpg?width=465&quality=45&auto=format&fit=max&dpr=2&s=39d01aeb8d560c3c7bed5190ec679aa9" style="width:100%">
  </div>
</div>

</div>
</body>
<script>
function myFunction() {
  var x = document.getElementById("myGrid");
  if (x.className === "w3-row") {
    x.className = "w3-row-padding";
  } else {
    x.className = x.className.replace("w3-row-padding", "w3-row");
  }
}
</script>


@endsection
