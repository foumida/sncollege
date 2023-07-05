@extends('layouts.front_end.default')
@section('content')

<!-- breadcrumb area start -->

            <section
                class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">Research Projects</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Research Projects</span>
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
                                        <h4>RESEARCH PROJECTS</h4>

                                        <p>
                                            Minor Research Project</p>

                                        
                                    </div>
                                   
                                    <ul>
                                   
                                    
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about area end -->
            <!-- about area end -->

@endsection