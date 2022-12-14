
			<div class="accordion mb-2" id="accordionExample">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h2 class="mb-0">
							<a data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
								<span><i class="fa fa-user"></i> Account</span>
								<i class="fa fa-chevron-down toggle"></i>
							</a>
						</h2>
					</div>
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">
							<ul class="list-group">
								<li class="list-group-item"><a href="{{route('riderProf')}}"><i class="fa fa-pencil"></i> Edit Profile</a></li>
								<li class="list-group-item"><a href="{{route('riderPass')}}"><i class="fa fa-key"></i> Change Password</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h2 class="mb-0">
							<a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								<span><i class="fa fa-comments"></i> Messages</span>
								<i class="fa fa-chevron-down toggle"></i>
							</a>
						</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						<div class="card-body">
							<ul class="list-group">
								<li class="list-group-item"><a href="{{route('chatbox')}}"><i class="fa fa-paper-plane"></i> Sent</a></li>
								<!--<li class="list-group-item"><a href="#"><i class="fa fa-archive"></i> Archive </a></li> -->
							</ul>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingThree">
						<h2 class="mb-0">
							<a data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								<span><i class="fa fa-bar-chart"></i> Reports</span>
								<i class="fa fa-chevron-down toggle"></i>
							</a>
						</h2>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						<div class="card-body">
							<ul class="list-group">
								<li class="list-group-item"><a href="{{route('rideHis')}}"><i class="fa fa-table"></i> Ride history</a></li>
								<li class="list-group-item"><a href="{{route('riderReport')}}"><i class="fa fa-file-excel-o"></i> Excel Report</a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header" id="headingFour">
						<h2 class="mb-0">
							<a data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
								<span><i class="fa fa-motorcycle"></i> Ride</span>
								<i class="fa fa-chevron-down toggle"></i>
							</a>
						</h2>
					</div>
					<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
						<div class="card-body">
							<ul class="list-group">
								<li class="list-group-item"><a href="{{route('checkReq')}}"><i class="fa fa-list-alt"></i> Check Request</a></li>
								<li class="list-group-item"><a href="{{route('rideProgs')}}"><i class="fa fa-spinner"></i> Ride Progress </a></li>
								<!-- <li class="list-group-item"><a href="#"><i class="fa fa-male"></i> Customer History</a></li> -->
								<!--<li class="list-group-item"><a href="#"><i class="fa fa-star"></i> Customer Review</a></li>	 -->
							</ul>
						</div>
					</div>
				</div>

              	<div class="card">
					<div class="card-header" id="headingFive">
						<h2 class="mb-0">
							<a data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
								<span><i class="fa fa-money"></i> Payment</span>
								<i class="fa fa-chevron-down toggle"></i>
							</a>
						</h2>
					</div>
					<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
						<div class="card-body">
							<ul class="list-group">
								<li class="list-group-item"><a href="{{route('riderBalance')}}"><i class="fa fa-money"></i> Balance</a></li>
								<li class="list-group-item"><a href="{{route('cashout')}}"><i class="fa fa-credit-card"></i> Cash-out</a></li>
								<li class="list-group-item"><a href="{{route('riderPoint')}}"><i class="fa fa-star-half-o"></i> Rider Point</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
