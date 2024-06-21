@extends('adminPanel.layout.layout')
<style>
    i.bx.bx-dots-horizontal-rounded.font-22.text-option {
        display: none;
    }

    li.list-group-item.d-flex.bg-transparent.justify-content-between.align-items-center {
        height: 49px;
    }
</style>

@section('main_content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

			{{-- total Order --}}
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Orders</p>
                                <h4 class="my-1 text-info">{{ $Commande}}</h4>
                                {{-- <p class="mb-0 font-13"></p> --}}
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			{{-- total Category --}}
            <div class="col">
				<div class="card radius-10 border-start border-0 border-3 border-danger">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<p class="mb-0 text-secondary">Total Category</p>
								<h4 class="my-1 text-danger">{{$ProductCategory}}</h4>
							</div>
							<div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
								<i class='bx bxs-box'></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			

			{{-- total Product --}}

            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Product Item</p>
                                <h4 class="my-1 text-success">{{$productItem}}</h4>
                                {{-- <p class="mb-0 font-13">Active Product</p> --}}
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			{{-- total Customers --}}
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Customers</p>
                                <h4 class="my-1 text-warning">{{$customer}}</h4>
                                {{-- <p class="mb-0 font-13">Active Customer</p> --}}
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

		{{-- total Admin --}}
			<div class="col">
				<div class="card radius-10 border-start border-0 border-3 border-warning">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<p class="mb-0 text-secondary">Total Admin</p>
								<h4 class="my-1 text-warning">{{$Admin}}</h4>
								{{-- <p class="mb-0 font-13">Active Customer</p> --}}
							</div>
							<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
								<i class="lni lni-dashboard"></i> <!-- New icon added here -->
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- Total Ads --}}
<div class="col">
    <div class="card radius-10 border-start border-0 border-3 border-warning">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <p class="mb-0 text-secondary">Total Ads</p>
                    <h4 class="my-1 text-warning">{{$Ads}}</h4>
                </div>
                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                    {{-- <i class="lni lni-stats-up"></i> --}}
					<i class="fas fa-bullhorn"></i> <!-- Bullhorn icon -->



					
					 <!-- Real icon: Stats Up from LineIcons -->
                </div>
            </div>
        </div>
    </div>
</div>


				{{-- total Blogs --}}
				<div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-warning">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<p class="mb-0 text-secondary">Total Blogs</p>
									<h4 class="my-1 text-warning">{{$Blogs}}</h4>
									{{-- <p class="mb-0 font-13">Active Customer</p> --}}
								</div>
								<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
									{{-- <i class='bx bxs-group'></i> --}}
									<i class="lni lni-pencil"></i>


								</div>
							</div>
						</div>
					</div>
				</div>

				{{-- total Brand --}}
				<div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-warning">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<p class="mb-0 text-secondary">Total Brand</p>
									<h4 class="my-1 text-warning">{{$Brand}}</h4>
									{{-- <p class="mb-0 font-13">Active Customer</p> --}}
								</div>
								<div class="widgets-icons-2 rounded-circle bg-gradient-custom text-custom ms-auto">
									<i class="fas fa-globe"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

					{{-- total Faq --}}
					<div class="col">
						<div class="card radius-10 border-start border-0 border-3 border-warning">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Total Faq</p>
										<h4 class="my-1 text-warning">{{$Faq}}</h4>
										{{-- <p class="mb-0 font-13">Active Customer</p> --}}
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
										<i class="fas fa-question-circle"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					
					{{-- total FeaturedLink --}}
					<div class="col">
						<div class="card radius-10 border-start border-0 border-3 border-warning">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Total FeaturedLink</p>
										<h4 class="my-1 text-warning">{{$FeaturedLink}}</h4>
										{{-- <p class="mb-0 font-13">Active Customer</p> --}}
									</div>
									<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
										<i class="fas fa-star"></i> <!-- Star icon -->
									</div>
								</div>
							</div>
						</div>
					</div>


						{{-- total Offer --}}
						<div class="col">
							<div class="card radius-10 border-start border-0 border-3 border-warning">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-secondary">Total Offer</p>
											<h4 class="my-1 text-warning">{{$Offer}}</h4>
										</div>
										<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
											<i class="fas fa-tag"></i> 
										</div>
									</div>
								</div>
							</div>
						</div>

							{{-- total Bank  --}}
							<div class="col">
								<div class="card radius-10 border-start border-0 border-3 border-warning">
									<div class="card-body">
										<div class="d-flex align-items-center">
											<div>
												<p class="mb-0 text-secondary">Total Bank </p>
												<h4 class="my-1 text-warning">{{$Bank  }}</h4>
											</div>
											<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
												<i class="fas fa-building"></i> 
											</div>
										</div>
									</div>
								</div>
							</div>


									{{-- total Supplier  --}}
									<div class="col">
										<div class="card radius-10 border-start border-0 border-3 border-warning">
											<div class="card-body">
												<div class="d-flex align-items-center">
													<div>
														<p class="mb-0 text-secondary">Total Supplier </p>
														<h4 class="my-1 text-warning">{{$Supplier  }}</h4>
													</div>
													<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
														<i class="fas fa-industry"></i> <!-- Industry icon often used for factories -->

													</div>
												</div>
											</div>
										</div>
									</div>
			

										{{-- total Review  --}}
										<div class="col">
											<div class="card radius-10 border-start border-0 border-3 border-warning">
												<div class="card-body">
													<div class="d-flex align-items-center">
														<div>
															<p class="mb-0 text-secondary">Total Review </p>
															<h4 class="my-1 text-warning">{{$review  }}</h4>
														</div>
														<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
															<i class="fas fa-comment"></i>
														</div>
													</div>
												</div>
											</div>
										</div>
				
		
	

					
		
	
	

				


				

	





			



			
        </div><!--end row-->


    </div>
@endsection

@section('css_plugins')
@endsection
@section('js_plugins')
@endsection
@section('js')
    <script>
        $(function () {
        	"use strict";
        	// chart 1
        	var ctx = document.getElementById('chart1').getContext('2d');
        	var myChart = new Chart(ctx, {
        		type: 'line',
        		data: {
        			labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        			datasets: [{
        				label: 'Google',
        				data: [6, 20, 14, 12, 17, 8, 10],
        				backgroundColor: "transparent",
        				borderColor: "#0d6efd",
        				pointRadius: "0",
        				borderWidth: 4
        			}, {
        				label: 'Facebook',
        				data: [5, 30, 16, 23, 8, 14, 11],
        				backgroundColor: "transparent",
        				borderColor: "#f41127",
        				pointRadius: "0",
        				borderWidth: 4
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			legend: {
        				display: true,
        				labels: {
        					fontColor: '#585757',
        					boxWidth: 40
        				}
        			},
        			tooltips: {
        				enabled: false
        			},
        			scales: {
        				xAxes: [{
        					ticks: {
        						beginAtZero: true,
        						fontColor: '#585757'
        					},
        					gridLines: {
        						display: true,
        						color: "rgba(0, 0, 0, 0.07)"
        					},
        				}],
        				yAxes: [{
        					ticks: {
        						beginAtZero: true,
        						fontColor: '#585757'
        					},
        					gridLines: {
        						display: true,
        						color: "rgba(0, 0, 0, 0.07)"
        					},
        				}]
        			}
        		}
        	});
        	// chart 2
        	var ctx = document.getElementById("chart2").getContext('2d');
        	var myChart = new Chart(ctx, {
        		type: 'bar',
        		data: {
        			labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        			datasets: [{
        				label: 'Google',
        				data: [13, 8, 20, 4, 18, 29, 25],
        				barPercentage: .5,
        				backgroundColor: "#0d6efd"
        			}, {
        				label: 'Facebook',
        				data: [31, 20, 6, 16, 21, 4, 11],
        				barPercentage: .5,
        				backgroundColor: "#f41127"
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			legend: {
        				display: true,
        				labels: {
        					fontColor: '#585757',
        					boxWidth: 40
        				}
        			},
        			tooltips: {
        				enabled: true
        			},
        			scales: {
        				xAxes: [{
        					ticks: {
        						beginAtZero: true,
        						fontColor: '#585757'
        					},
        					gridLines: {
        						display: true,
        						color: "rgba(0, 0, 0, 0.07)"
        					},
        				}],
        				yAxes: [{
        					ticks: {
        						beginAtZero: true,
        						fontColor: '#585757'
        					},
        					gridLines: {
        						display: true,
        						color: "rgba(0, 0, 0, 0.07)"
        					},
        				}]
        			}
        		}
        	});
        	// chart 3
        	new Chart(document.getElementById("chart3"), {
        		type: 'pie',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "Population (millions)",
        				backgroundColor: ["#0d6efd", "#212529", "#17a00e", "#f41127", "#ffc107"],
        				data: [2478, 5267, 734, 784, 433]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			}
        		}
        	});
        	// chart 4
        	new Chart(document.getElementById("chart4"), {
        		type: 'radar',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "1950",
        				fill: true,
        				backgroundColor: "rgb(13 110 253 / 23%)",
        				borderColor: "#0d6efd",
        				pointBorderColor: "#fff",
        				pointBackgroundColor: "rgba(179,181,198,1)",
        				data: [8.77, 55.61, 21.69, 6.62, 6.82]
        			}, {
        				label: "2050",
        				fill: true,
        				backgroundColor: "rgba(255,99,132,0.2)",
        				borderColor: "rgba(255,99,132,1)",
        				pointBorderColor: "#fff",
        				pointBackgroundColor: "rgba(255,99,132,1)",
        				pointBorderColor: "#fff",
        				data: [25.48, 54.16, 7.61, 8.06, 4.45]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Distribution in % of world population'
        			}
        		}
        	});
        	// chart 5
        	new Chart(document.getElementById("chart5"), {
        		type: 'polarArea',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "Population (millions)",
        				backgroundColor: ["#0d6efd", "#212529", "#17a00e", "#f41127", "#ffc107"],
        				data: [2478, 5267, 734, 784, 433]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			}
        		}
        	});
        	// chart 6
        	new Chart(document.getElementById("chart6"), {
        		type: 'doughnut',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "Population (millions)",
        				backgroundColor: ["#0d6efd", "#212529", "#17a00e", "#f41127", "#ffc107"],
        				data: [2478, 5267, 734, 784, 433]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			}
        		}
        	});
        	// chart 7
        	new Chart(document.getElementById("chart7"), {
        		type: 'horizontalBar',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "Population (millions)",
        				backgroundColor: ["#0d6efd", "#212529", "#17a00e", "#f41127", "#ffc107"],
        				data: [2478, 5267, 734, 784, 433]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			legend: {
        				display: false
        			},
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			}
        		}
        	});
        	// chart 8
        	new Chart(document.getElementById("chart8"), {
        		type: 'bar',
        		data: {
        			labels: ["1900", "1950", "1999", "2050"],
        			datasets: [{
        				label: "Africa",
        				backgroundColor: "#0d6efd",
        				data: [133, 221, 783, 2478]
        			}, {
        				label: "Europe",
        				backgroundColor: "#f41127",
        				data: [408, 547, 675, 734]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Population growth (millions)'
        			}
        		}
        	});
        	// chart 9
        	new Chart(document.getElementById("chart9"), {
        		type: 'bar',
        		data: {
        			labels: ["1900", "1950", "1999", "2050"],
        			datasets: [{
        				label: "Europe",
        				type: "line",
        				borderColor: "#673ab7",
        				data: [408, 547, 675, 734],
        				fill: false
        			}, {
        				label: "Africa",
        				type: "line",
        				borderColor: "#f02769",
        				data: [133, 221, 783, 2478],
        				fill: false
        			}, {
        				label: "Europe",
        				type: "bar",
        				backgroundColor: "rgba(0,0,0,0.2)",
        				data: [408, 547, 675, 734],
        			}, {
        				label: "Africa",
        				type: "bar",
        				backgroundColor: "rgba(0,0,0,0.2)",
        				backgroundColorHover: "#3e95cd",
        				data: [133, 221, 783, 2478]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Population growth (millions): Europe & Africa'
        			},
        			legend: {
        				display: false
        			}
        		}
        	});
        	// chart 10
        	new Chart(document.getElementById("chart10"), {
        		type: 'bubble',
        		data: {
        			labels: "Africa",
        			datasets: [{
        				label: ["China"],
        				backgroundColor: "#17a00e",
        				borderColor: "#17a00e",
        				data: [{
        					x: 21269017,
        					y: 5.245,
        					r: 15
        				}]
        			}, {
        				label: ["Denmark"],
        				backgroundColor: "#ffc107",
        				borderColor: "#ffc107",
        				data: [{
        					x: 258702,
        					y: 7.526,
        					r: 10
        				}]
        			}, {
        				label: ["Germany"],
        				backgroundColor: "#17a00e",
        				borderColor: "#17a00e",
        				data: [{
        					x: 3979083,
        					y: 6.994,
        					r: 15
        				}]
        			}, {
        				label: ["Japan"],
        				backgroundColor: "#f41127",
        				borderColor: "#f41127",
        				data: [{
        					x: 4931877,
        					y: 5.921,
        					r: 15
        				}]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			},
        			scales: {
        				yAxes: [{
        					scaleLabel: {
        						display: true,
        						labelString: "Happiness"
        					}
        				}],
        				xAxes: [{
        					scaleLabel: {
        						display: true,
        						labelString: "GDP (PPP)"
        					}
        				}]
        			}
        		}
        	});
        });

    </script>
@endsection




















