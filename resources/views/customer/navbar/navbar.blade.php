<script src="{{asset('js/customer/navbar.js')}}"></script>
<nav class="navbar navbar-expand-md bg-light navbar-light sticky-top shadow-sm">
<div class="container">
<a class="navbar-brand" href="{{route('customerDash')}}">
   <h3 class="text-danger logo">Your</h3><h3 class="text-dark logo">Ride</h3>
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item me-4">
          <a class="nav-link" href="{{route('customerDash')}}"><i class="fa-solid fa-house-chimney me-1"></i>Home</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="{{route('rideRequest')}}"><i class="fa-solid fa-car-on me-1"></i>Request for a ride</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="{{route('rideList')}}"><i class="bi bi-clipboard2-data-fill me-1"></i>Ride History</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" data-bs-target="#demo-drop" href="#"><img  src="../customer_image/{{Session::get('image')}}" alt="profile pic"  width="40" height="40"></a>
          <ul class="dropdown-menu" id="dot-drop">
          <li>
          <a class="dropdown-item" href="{{route('customerProfile')}}"><i class="fa-solid fa-user me-2"></i>View Profile</a>
         </li>
         <li>
          <a class="dropdown-item" href="{{route('passwordChanging')}}"><i class="fa-solid fa-pen-to-square me-2"></i>Change Password</a>
         </li>
         <li>
          <a class="dropdown-item" href="{{route('discount')}}"><i class="bi bi-cash-stack me-2"></i>Discount Details</a>
         </li>
         <div class="dropdown-divider"></div>
         <li class="logout">
          <a class="dropdown-item" href="{{route('customerLogout')}}"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
         </li>
          </ul>
        </li>
    </ul>
</div>
</div>
</nav>