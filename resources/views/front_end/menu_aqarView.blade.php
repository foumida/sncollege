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
                                <h3 class="breadcrumb__title">AQAR</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>AQAR</span>
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
								<h4>ANNUAL QUALITY ASSURANCE REPORT (AQAR)</h4>
								<br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="blog-details-list">
                                                <li><a href="aqar-2019-20.html">AQAR 2019-2020 </a></li>
                                                <li><a href="aqar-2019-20.html">AQAR 2018-2019 </a></li>
                                                <li><a href="aqar-2019-20.html">AQAR 2017-2018 </a></li>
                                                <li><a href="aqar-2019-20.html">AQAR 2016-2017 </a></li>
											</ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul class="blog-details-list">	
                                                <li><a href="aqar-2019-20.html">AQAR 2015-2016 </a></li>
                                                <li><a href="aqar-2019-20.html">AQAR 2014-2015 </a></li>
                                                <li><a href="aqar-2019-20.html">AQAR 2013-2014 </a></li>
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