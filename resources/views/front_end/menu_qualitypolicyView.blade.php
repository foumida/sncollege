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
                                <h3 class="breadcrumb__title">QUALITY POLICY</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>QUALITY POLICY</span>
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
                                    <div class="col-xxl-12"> 
									  <div class="row">
										  <div class="col-lg-12 abtmestext">
											<h4>QUALITY POLICY</h4>
											
											
												<div class="col-lg-12  pb-10">
										            <img src="{{asset('front_end/assets/img/about-us/qualitypolicy.jpg')}}" alt="" class="img-fluid" />
                                                 </div>
                                                 <h6>We at MES ASMABI COLLEGE are committed to acheive excellence through :<h6>
                                                 
                                                <div class="row"> 
                                                    <div class="col-lg-6">
    													<ul class="blog-details-list">
    														<li>Improvement in academic performance</li>
    														<li>Systematic curricular and extra-curricular uplift of students</li>
    														<li>Continuos proffesional development of faculty</li>
    													 </ul>
    												</div>
    												<div class="col-lg-6">
    													<ul class="blog-details-list">
    														<li>Updating infrastructure facilities.</li>
    														<li>Advancement in quality quotient</li>
    														<li>Commitment to society</li>
    													 </ul>
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
            <!-- about area end -->

@endsection