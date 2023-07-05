@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">CRITERION 7</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>IQAC</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->


            <!-- featured-courses -->
            <!-- blog-area -->
       <section class="blog-area gray-bg pt-80 pb-80 ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                    <h4 >Criterion7 - Institutional Values and Best Practices</h4><br>
                                    <h5>7.1 Institutional Values and Social Responsibilities</h5>
                                    <ul class="blog-details-list">
                                        <li>7.1.5 Policy Document on Green Campus</li>
                                        <li> 7.1.5 Policy on Entry of Vehicles</li>
                                        <li>7.1.7 Policy Document on Differently abled and Information Brochure</li>
                                        <li>7.1.10 Code of Professional Ethics and Conduct</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



<style>
.blog-content h5{
   color:#000 ;
}
.blog-content h5:hover{
   color:#002d58;
}

</style>
@endsection