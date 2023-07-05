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
                                <h3 class="breadcrumb__title">Workshops &amp; Seminars</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Workshops &amp; Seminars</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- about area start -->
            <div class="tp-about__section-2 pt-100 pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4>WORKSHOP AND SEMINARS</h4>
                                            <ul class="blog-details-list">
                                                <li>
                                                    <a href="aqar-2019-20.html"
                                                        >AQUACULTURE- Entrepreneurial Opportunities in Fisheries Sector
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html"
                                                        >B VOC LMT- Webinar on Logistics How is it a good career choice for
                                                        you
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html">CHEMISTRY- Materials in Medicine </a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html"
                                                        >B VOC LMT- Webinar on COMMERSE AIDED - Consumer Behaviour
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html"
                                                        >COMMERSE AIDED- Filing international patent application
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html">ECONOMICS- A talk on India farm Act 2020</a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html"
                                                        >ECONOMICS- Behavioural responses to Pandemic
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html"
                                                        >ECONOMICS- Impact of Covid 19 on Global ecosystem
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html"
                                                        >ECONOMICS- Introduction to Research Process</a
                                                    >
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html">MALAYALAM- Trade and Urban formation </a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html"
                                                        >PHYSICS- X ray and its Research Applications
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="aqar-2019-20.html"
                                                        >PSYCHOLOGY- Webinar on Research Methodology
                                                    </a>
                                                </li>
                                                <br />
                                            </ul>
                                        </div>
                                    </div>

                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection