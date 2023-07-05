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
                                <h3 class="breadcrumb__title">Minutes and ATR</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Minutes and ATR</span>
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
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4>MINUTES OF IQAC MEETINGS</h4>
                                            <ul class="blog-details-list">
                                                <li><a href="aqar-2019-20.html">2013-2014 </a></li>
                                                <li><a href="aqar-2019-20.html">2014-2015</a></li>
                                                <li><a href="aqar-2019-20.html">2015-2016</a></li>
                                                <li><a href="aqar-2019-20.html">2016-2017 </a></li>
                                                <li><a href="aqar-2019-20.html"> 2017-2018</a></li>
                                                <li><a href="aqar-2019-20.html">2018-2019 </a></li>
                                            </ul>
                                        </div>
                                    
                                        <div class="col-lg-6">
                                            <h4>ACTION TAKEN REPORTS</h4>
											<ul class="blog-details-list">
                                                <li><a href="aqar-2019-20.html">ATR 2013-2014 </a></li>
                                                <li><a href="aqar-2019-20.html">ATR 2014-2015</a></li>
                                                <li><a href="aqar-2019-20.html">ATR 2015-2016</a></li>
                                                <li><a href="aqar-2019-20.html">ATR 2016-2017 </a></li>
                                                <li><a href="aqar-2019-20.html">ATR 2017-2018</a></li>
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