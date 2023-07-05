@extends('layouts.front_end.default')
@section('content')

<section
                class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">NIRF</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>NIRF</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- about area start -->
            <div class="tp-about__section-2 pt-50 pb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                    <h4>NODAL OFFICER: Dr. T R. MuraliKrishnan (Associate Professor & H.O.D., Dept.of English)</h4><br>
									<div class="row pt-10">
										<div class="col-lg-6">		
											<ul class="blog-details-list">
												<li><a href="aqar-2019-20.html">NIRF 2022 – OVERALL DATA</a></li>
												<li><a href="aqar-2019-20.html">NIRF 2021 – OVERALL DATA </a></li>
												<li><a href="aqar-2019-20.html">NIRF 2020 – OVERALL DATA1 </a></li>
												<li><a href="aqar-2019-20.html">NIRF 2020 – OVERALL DATA2 </a></li>
												<li><a href="aqar-2019-20.html"> NIRF 2019 – OVERALL DATA </a></li>
											 </ul>
										 </div>
										 <div class="col-lg-6">		
											<ul class="blog-details-list">
												<li><a href="aqar-2019-20.html">NIRF 2019 – COLLEGE DATA </a></li>
												<li><a href="aqar-2019-20.html">NIRF 2018 COLLEGE DETAILS </a></li>
												<li><a href="aqar-2019-20.html">NIRF 2018 OVERALL DETAILS</a></li>
												<li><a href="aqar-2019-20.html">NIRF PUBLICATION RATING</a></li>
												<li><a href="aqar-2019-20.html">NIRF RANK 2018</a></li>
											</ul>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection