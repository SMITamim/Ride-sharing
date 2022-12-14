<nav class="navbar navbar-expand-md bg-light navbar-light sticky-top shadow-sm">
    <div class="container">
    <a class="navbar-brand" href="{{route('riderDash')}}">
       <span class="text-danger  h4">Your</span><span class="text-dark logo h4" >Ride</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" data-bs-target="#demo-drop" href="#"><img  src="img/{{Session::get('image')}}" alt="profile pic"  width="40" height="40" class="rounded-circle"></a>
              <ul class="dropdown-menu" id="dot-drop">
              <li>
              <a class="dropdown-item" href="{{route('riderProf')}}"><i class="fa fa-user"></i>&nbsp; View Profile</a>
             </li>
             <li>
              <a class="dropdown-item" href="{{route('riderPass')}}"><i class="fa fa-key"></i>&nbsp; Change Password</a>
             </li>
             <div class="dropdown-divider"></div>
             <li class="logout">
              <a class="dropdown-item" href="{{route('riderLogout')}}"><i class="fa fa-power-off"></i> &nbsp;Logout</a>
             </li>
              </ul>
            </li>
        </ul>
    </div>
    </div>
    </nav>
