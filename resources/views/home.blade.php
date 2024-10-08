@extends('layouts.layout')

@section('content')
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>

	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div style="margin-left:5px;" class="toolbar">
        <h1>Dashboard</h1>
    </div>
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<div id="kt_content_container" class="container-xxl">
								<div class="card mb-8 mb-xxl-8">
									<div class="card-body pt-9 pb-0">
										<div class="d-flex flex-wrap flex-sm-nowrap mb-3">
											<div class="me-7 mb-4">
												<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
													<img src="{{ asset($user->profile_picture) }}" alt="image" />
													<div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
												</div>

											</div>
											<div class="flex-grow-1">
												<div class="d-flex justify-content-between align-items-start flex-wrap mb-1">
													<!--begin::User-->
													<div class="d-flex flex-column">
														<!--begin::Name-->
														<div class="d-flex align-items-center mb-0">
															<a class="text-gray-900 text-hover-primary fs-3 fw-bolder me-1"><h3>{{$user->name}}</h3></a>

															<a href="#">
																<span class="svg-icon svg-icon-1 svg-icon-primary">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
																		<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
																		<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</a>


															<a style="margin-left: 750px; background-color:Blue; color:White" href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
															<span class="svg-icon svg-icon-3 d-none">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="black" />
																	<path d="M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="black" />
																</svg>
															</span>

															<span class="indicator-label">Present</span>
															<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-5"></span>
														</span>
														</a>
														</div>


														<div class="d-flex flex-wrap fw-bold fs-6 mb-2 pe-2">
															<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
															<span class="svg-icon svg-icon-4 me-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
																	<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
																</svg>
															</span>
															{{$branch}}</a>
														</div>




														<div class="d-flex flex-wrap fw-bold fs-2 mb-6 pe-2">
													<div class="d-flex my-0">
												<div class="d-flex flex-wrap flex-stack">
													<div class="d-flex flex-column flex-grow-2 pe-5">
														<div class="d-flex flex-wrap">
															<div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

																<div class="d-flex align-items-center">
																	<span class="svg-icon svg-icon-3 svg-icon-success me-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
																			<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																	<div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$currentYearSum}}" data-kt-countup-prefix="₹">0</div>
																</div>
																<div class="fw-bold fs-6 text-gray-400">Earnings</div>
															</div>
															<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																<!--begin::Number-->
																<div class="d-flex align-items-center">
																	<span class="svg-icon svg-icon-3 svg-icon-danger me-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.10" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
																			<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="black" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																	<div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$plan}}">0</div>
																</div>
																<div class="fw-bold fs-6 text-gray-400">Courses</div>
																<!--end::Label-->
															</div>

															<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																<div class="d-flex align-items-center">
																	<span class="svg-icon svg-icon-3 svg-icon-success me-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
																			<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
																		</svg>
																	</span>
																	<div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$growthrate}}" data-kt-countup-prefix="%">0</div>
																</div>
																<div class="fw-bold fs-6 text-gray-400">Growth Rate</div>
															</div>




														</div>
													</div>

												</div>

											</div>

										</div>
								</div>
						   </div>
					</div>
		    </div>
	</div>

</div>




<div class="container mt-4">
    <div class="row">
        <!-- First Column -->
		<div class="col-xl-6">
            <div class="card mb-5 mb-xxl-8">
                <div class="card-header border-0 pt-5">
                   <h4>Courses Analysis</h4>
                </div>
                <div class="container">
				<div id="mypiChart" style="width: 100%; height: 440px;"></div>
                </div>
            </div>
        </div>

		<div class="col-xl-6">
            <div class="card mb-5 mb-xxl-8">
			<div class="card-header border-0 pt-5">
                   <h4>Yearly Analysis</h4>
                </div>
                <div class="container">
				<div id="myChart" style="width: 100%; height: 440px;"></div>
                </div>
            </div>
        </div>

		<div class="col-xl-6">
            <div class="card mb-5 mb-xxl-8">
                <div class="card-header border-0 pt-5">
                   <h4>Monthly Analysis</h4>
                </div>
                <div class="container">
                    <div id="myBarChart" style="width: 100%; height: 440px;"></div>
                </div>

            </div>
        </div>





        <!-- Summary Section -->


		<div class="col-xl-6 mt-3 mt-xl-0">
										<div class="card">
											<div class="card-header align-items-center border-0 mt-4">
												<h3 class="card-title align-items-start flex-column">
													<span class="fw-bolder mb-2 text-dark"><h3>Road Signs </h3></span>
												</h3>
												<div class="card-toolbar">
													<!--begin::Menu-->
													<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
														<span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
																	<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																	<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																	<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																</g>
															</svg>
														</span>
														<!--end::Svg Icon-->
													</button>

												</div>
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body pt-5">
												<!--begin::Timeline-->
												<div class="timeline-label">
													<!--begin::Item-->
													<div class="timeline-item">
													<div class="timeline-label fw-bolder text-gray-800 fs-6">Speed Limit Sign</div>
														<div class="timeline-badge">
															<i class="fa fa-genderless text-warning fs-1"></i>
														</div>

														<div  class="fw-bolder text-gray-800 ps-3">Outlines keep you honest. And keep structure</div>
														<!--end::Text-->
													</div>
													<div class="timeline-item">
														<div class="timeline-label fw-bolder text-gray-800 fs-6">Yield Sign</div>
														<div class="timeline-badge">
															<i class="fa fa-genderless text-success fs-1"></i>
														</div>
														<div class="timeline-content d-flex">
															<span class="fw-bolder text-gray-800 ps-3"> Red and white, triangular sign. Indicates that drivers should slow down </span>
														</div>
													</div>
													<div class="timeline-item">
														<!--begin::Label-->
														<div class="timeline-label fw-bolder text-gray-800 fs-6">Stop Sign</div>
														<!--end::Label-->
														<!--begin::Badge-->
														<div class="timeline-badge">
															<i class="fa fa-genderless text-danger fs-1"></i>
														</div>
														<!--end::Badge-->
														<!--begin::Desc-->
														<div  class="fw-bolder text-gray-800 ps-3">Red, octagonal sign. Requires drivers to come to a complete stop</div>
														<!--end::Desc-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="timeline-item">
														<!--begin::Label-->
														<div class="timeline-label fw-bolder text-gray-800 fs-6">No U-Turn Sign</div>
														<!--end::Label-->
														<!--begin::Badge-->
														<div class="timeline-badge">
															<i class="fa fa-genderless text-primary fs-1"></i>
														</div>
														<!--end::Badge-->
														<!--begin::Text-->
														<div  class="fw-bolder text-gray-800 ps-3">Indulging in poorly driving and keep structure keep great</div>
														<!--end::Text-->
													</div>

													<div class="timeline-item">
														<!--begin::Label-->
														<div class="timeline-label fw-bolder text-gray-800 fs-6">One-Way Sign</div>
														<!--end::Label-->
														<!--begin::Badge-->
														<div class="timeline-badge">
															<i class="fa fa-genderless text-primary fs-1"></i>
														</div>
														<!--end::Badge-->
														<!--begin::Text-->
														<div  class="fw-bolder text-gray-800 ps-3">White with a black arrow pointing in one direction. Indicates that traffic must only flow in the direction of the arrow.
														</div>
														<!--end::Text-->
													</div>

												</div>
												<!--end::Timeline-->
											</div>
											<!--end: Card Body-->
										</div>
										<!--end: List Widget 5-->
									</div>
									<!--end::Col-->
								</div>































	</body>
    <script>
        var years = {!! json_encode($years) !!}.map(String);
        var percentages = {!! json_encode($percentages) !!};
		Highcharts.chart('myChart', {
        chart: {
            type: 'line'
        },
        title: {
            text: null // No title within the chart area
        },
        xAxis: {
            categories: years,
            labels: {
                enabled: true,
                style: {
                    fontSize: '12px'
                }
            },
            lineColor: '#ccc',
            tickWidth: 1
        },
        yAxis: {
            title: {
                text: 'Percentage (%)',
                style: {
                    fontSize: '12px'
                }
            },
            labels: {
                enabled: true,
                format: '{value}%',
                style: {
                    fontSize: '12px'
                }
            },
            gridLineWidth: 1,
            gridLineColor: '#e0e0e0'
        },
        series: [{
            name: 'Percentage Change',
            data: percentages,
            color: '#007bff',
            lineWidth: 4,
            marker: {
                radius: 6,
                symbol: 'circle'
            }
        }],
        credits: {
            enabled: false
        }
    });




        var degrees = @json($degrees);
        console.log(degrees);
        // Extract names, IDs, and degrees for Highcharts data
        var chartData = degrees.map(item => ({
            name: `${'plan'} (ID: ${item.id})`,
            y: item.degree
        }));

        Highcharts.chart('mypiChart', {
        chart: {
            type: 'pie'
        },
		title: {
            text: null // No title within the chart area
        },
        tooltip: {
            pointFormat: '<b>{point.name}</b>: {point.percentage:.1f}%'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Degree',
            colorByPoint: true,
            data: chartData
        }],
        credits: {
            enabled: false
        }
    });


// Assuming $monthlyData is passed as a JavaScript variable
var months = [
            @foreach ($monthlyData as $data)
                '{{ $data['month'] }}',
            @endforeach
        ];

        var percentages = [
            @foreach ($monthlyData as $data)
                {{ $data['percentage'] }},
            @endforeach
        ];

        var chart = Highcharts.chart('myBarChart', {
            chart: {
                type: 'bar',
                backgroundColor: '#ffffff',
                borderRadius: 8,
                style: {
                    fontFamily: 'Arial, sans-serif'
                },
                events: {
                    load: function () {
                        var chart = this;
                        if (percentages.length === 0) {
                            chart.showNoData('Data not found');
                        }
                    }
                }
            },
            title: {
                text: null // No title within the chart area
            },
            xAxis: {
                categories: months,
                title: {
                    text: 'Months',
                    style: {
                        color: '#333333',
                        fontSize: '14px'
                    }
                },
                labels: {
                    style: {
                        color: '#333333',
                        fontSize: '12px'
                    }
                },
                tickLength: 0, // Optionally hide tick marks
                gridLineWidth: 1, // Ensure grid lines are visible
                gridLineColor: '#e0e0e0', // Grid line color
                lineWidth: 1, // Ensure the axis line is visible
                lineColor: '#333333' // Axis line color
            },
            yAxis: {
                title: {
                    text: 'Percentage',
                    style: {
                        color: '#333333',
                        fontSize: '14px'
                    }
                },
                labels: {
                    style: {
                        color: '#333333',
                        fontSize: '12px'
                    }
                },
                gridLineWidth: 1, // Ensure grid lines are visible
                gridLineColor: '#e0e0e0', // Grid line color
                lineWidth: 1, // Ensure the axis line is visible
                lineColor: '#333333' // Axis line color
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    dataLabels: {
                        enabled: true,
                        style: {
                            color: '#333333',
                            textOutline: 'none',
                            fontWeight: 'bold'
                        },
                        format: '{y} %'
                    }
                }
            },
            series: [{
                name: 'Percentage Change',
                data: percentages,
                color: '#007bff'
            }],
            credits: {
                enabled: false
            },
            noData: {
                position: {
                    align: 'center',
                    verticalAlign: 'middle',
                    x: 0,
                    y: 0
                },
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#333333'
                }
            }
        });    </script>

</html>
@endsection
