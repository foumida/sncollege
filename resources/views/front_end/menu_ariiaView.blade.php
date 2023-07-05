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
                                <h3 class="breadcrumb__title">ARIIA</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>ARIIA</span>
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
                                        <div class="col-lg-6">
                                            
                                            <p class="text-justify">
                                                Atal Ranking of Institutions on Innovation Achievements (ARIIA) is an
                                                initiative of the Ministry of Education (MoE), Govt. of India to
                                                systematically rank all major higher educational institutions and
                                                universities in India on indicators related to “Innovation and
                                                Entrepreneurship Development” amongst the students and faculties.
                                            </p>
											<a class="mb-10"
                                                href="assets/img/iqac/ARI-C-8215ariiacertificate29-12-2021.pdf"
                                                target="_blank"
                                                ><i class="fas fa-caret-right"> </i> ARIIA CERTIFICATE 2021</a
                                            >
                                            <hr />
                                            <a class="mb-10"
                                                href="assets/img/iqac/ARIIAreport2021_ARI-C-8215fo websit updation.pdf"
                                                target="_blank"
                                                ><i class="fas fa-caret-right">  </i> ARIIA REport 2021</a
                                            >
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="{{asset('front_end/assets/img/iqac/banner.png')}}" width="100%" />
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