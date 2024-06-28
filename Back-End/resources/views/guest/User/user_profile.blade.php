
<!DOCTYPE html>
<html lang="en">


<!-- molla/index-13.html  22 Nov 2019 09:59:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ForBest</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/adminPanel/images/Forbest-favicon-01.png') }}" type="image/jpg">    
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    
    <!-- Plugins CSS File -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/jquery.countdown.css') }}" rel="stylesheet">
    
    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/skins/skin-demo-13.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/demos/demo-13.css') }}" rel="stylesheet">



</head>


<body>
    <div class="page-wrapper">

        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">My Account<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> 
								<a class="navbar-brand" href="{{ url('/forbest') }}">Home</a>
						</li>
                        <li class="breadcrumb-item">
							<a class="navbar-brand" href="{{ url('/forbest/product') }}">Shop</a>
						</li>
                        {{-- <li class="breadcrumb-item active" aria-current="page">My Account</li> --}}
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="dashboard">
	                <div class="container">
	                	<div class="row">
	                		<aside class="col-md-4 col-lg-3">
	                			<ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
								    <li class="nav-item">
								        <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false">Downloads</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
								    </li>
								    {{-- <li class="nav-item">
								        <a class="nav-link" href="#">Sign Out</a>
								    </li> --}}
								</ul>
	                		</aside><!-- End .col-lg-3 -->

	                		<div class="col-md-8 col-lg-9">
	                			<div class="tab-content">
								    <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
								    	<p>Hello <span class="font-weight-normal text-dark">User</span> (not <span class="font-weight-normal text-dark">User</span>? <a href="#">Log out</a>) 
								    	<br>
								    	From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>
								    </div><!-- .End .tab-pane -->

									<div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
										<table class="table">
											<thead>
												<tr>
													<th style="color: #333;">Order ID</th>
													<th style="color: #333;">Product Name</th>
													<th style="color: #333;">Total Price</th>
													<th style="color: #333;">Order Date</th>
													{{-- <th style="color: #333;">Order Date</th>
													<th style="color: #333;">Status</th>
													<th style="color: #333;">Action</th>	 --}}
												</tr>
											</thead>
											@foreach($commandeall as $orderUser)
											<tbody>
												<!-- Example order rows (replace with actual data from your application) -->
												<tr>
													<td>{{$orderUser->id}}</td>
													<td>
														@foreach($orderUser->lignecommande as $lc)
													{{ $lc->product->name }} <br>
												@endforeach
													</td>
													<td>{{$orderUser->getTotal()}}DH</td>
													<td>{{ $orderUser->created_at }}</td>
													{{-- <td>
														<span class="badge badge-success">Delivered</span>
													</td>

													<td>
														<a href="#" class="btn btn-primary btn-sm">View</a>
													</td> --}}
												</tr>
											
												<!-- End of example rows -->
											</tbody>
											@endforeach
=										</table>
										<p>No order has been made yet.</p>
										<a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
									</div><!-- .End .tab-pane -->
									

								    <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
								    	<p>No downloads available yet.</p>
								    	<a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
								    </div><!-- .End .tab-pane -->
									
									@if($commande)
								    <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
								    	<p>The following addresses will be used on the checkout page by default.</p>

									
								    	<div class="row">
								    		<div class="col-lg-6">
								    			<div class="card card-dashboard">
								    				<div class="card-body">
								    					<h3 class="card-title">Billing Address</h3><!-- End .card-title -->
													
														<div class="table-responsive">
															<table class="table">
																<tbody>
																	<tr>
																		<th>First Name:</th>
																		<td>{{ $commande->first_name }}</td>
																	</tr>
																	<tr>
																		<th>Last Name:</th>
																		<td>{{ $commande->last_name }}</td>
																	</tr>
																	<tr>
																		<th>Company Name:</th>
																		<td>{{ $commande->company_name ?: 'N/A' }}</td>
																	</tr>
																	<tr>
																		<th>Country:</th>
																		<td>{{ $commande->country }}</td>
																	</tr>
																	<tr>
																		<th>Street Address:</th>
																		<td>{{ $commande->street_address }}</td>
																	</tr>
																
																
																	<!-- Add more fields as needed -->
																</tbody>
															</table>
														</div><!-- End .table-responsive -->
														{{-- <a href="#">Edit <i class="icon-edit"></i></a></p> --}}
													
								    				</div><!-- End .card-body -->
								    			</div><!-- End .card-dashboard -->
								    		</div><!-- End .col-lg-6 -->

								    		<div class="col-lg-6">
								    			<div class="card card-dashboard">
								    				<div class="card-body">
								    					<h3 class="card-title">Shipping Address</h3><!-- End .card-title -->
														<div class="table-responsive">
														<table class="table">
															<tbody>
																<tr>
													
																	<tr>
																		<th>Town / City:</th>
																		<td>{{ $commande->town_city }}</td>
																	</tr>

																<tr>
																	<th>State / County:</th>
																	<td>{{ $commande->state_county }}</td>
																</tr>
																<tr>
																	<th>Postcode / ZIP:</th>
																	<td>{{ $commande->postcode }}</td>
																</tr>
																<tr>
																	<th>Phone:</th>
																	<td>{{ $commande->phone }}</td>
																</tr>
																<tr>
																	<th>Email:</th>
																	<td>{{ $commande->email }}</td>
																</tr>
																<!-- Add more fields as needed -->
															</tbody>
														</table>
														</div>
														
								    				</div><!-- End .card-body -->
								    			</div><!-- End .card-dashboard -->
								    		</div><!-- End .col-lg-6 -->
								    	</div><!-- End .row -->
								    </div><!-- .End .tab-pane --> 
									@else
									<p>No ongoing order found.</p>
								@endif
								    <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                        <form action="{{ route('user.profile.update') }}" method="POST">
                                            @csrf
		            						<label>User Name *</label>
		            						<input value="{{auth()->user()->name}}" name="name" type="text" class="form-control" required>
		            						<small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>

		                					<label>Email address *</label>
		        							<input name="email" value="{{auth()->user()->email}}" type="email" class="form-control" required>

		            						<label> Current password (leave blank to leave unchanged) </label>
                                            <input type="password" name="password" class="form-control">

		            		
		                					<button type="submit" class="btn btn-outline-primary-2">
			                					<span>SAVE CHANGES</span>
												
			            						<i class="icon-long-arrow-right"></i>
			                				</button>
			                			</form>
								    </div><!-- .End .tab-pane -->
								</div>
	                		</div><!-- End .col-lg-9 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .dashboard -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->


        <!-- start .footer -->
        @include('guest/partials.footer')
        <!-- End .footer -->
    </div>

    {{--  @include('guest/partials.popup-container')--}}


    <script src= "{{asset('assets/js/jquery.min.js')}}"></script>

    <script src= "{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.hoverIntent.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.waypoints.min.js')}}"></script>

    <script src= "{{asset('assets/js/superfish.min.js')}}"></script>

    <script src= "{{asset('assets/js/owl.carousel.min.js')}}"></script>

    <script src= "{{asset('assets/js/bootstrap-input-spinner.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.plugin.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.countdown.min.js')}}"></script>

    <!-- Main JS File -->
    <script src= "{{asset('assets/js/main.js')}}"></script>

    <script src= "{{asset('assets/js/demos/demo-13.js')}}"></script>

</body>


<!-- molla/index-13.html  22 Nov 2019 09:59:31 GMT -->
</html>